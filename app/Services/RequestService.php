<?php
namespace App\Services;

use App\Mail\InvoiceMail;
use App\Models\GeneralLineItem;
use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;
use App\Models\Request;
use Illuminate\Database\Eloquent\Model;

class RequestService{

    public function createRequest(array $data)
    {
        $accountId = \App\Models\Account::query()->where('embassy_id', $data['embassy_id'])->first()->id ?? null;
        if (!$accountId) {
            return redirect()->back()->withInput()->withErrors(['embassy_id' => 'Account not found for the specified embassy.']);
        }

        return \App\Models\Request::create([
            'account_id' => $accountId,
            'embassy_id' => $data['embassy_id'],
            'member_id' => $data['member_id'],
            'country_id' => $data['country_id'],
            'type' => $data['type'],
            'tracking_number' => \Illuminate\Support\Str::ulid(),
            'total_cost' => collect($data['request_items'] ?? [])->sum('price'),
        ]);

    }

    public function addRequestedItems(Model|Request $request, array $requestedItems, $accountId = null){
        foreach ($requestedItems as $item) {
            \App\Models\RequestItem::create([
                'account_id' => $accountId,
                'request_id' => $request->id,
                'service_id' => $item['service_id'],
                'service_provider_id' => $item['service_provider_id'],
                'certificate_holder_name' => $item['certificate_holder_name'],
                'certificate_index_number' => $item['certificate_index_number'] ?? null,
                'price' => $item['price'] ?? null,
                'attachment' => $item['attachment'] ?? null,
            ]);
        }
    }



    public function addInvoiceItems(Model|Invoice $invoice, array $requestedItems, $accountId = null){
        foreach ($requestedItems as $item) {
            $invoice->generalLineItems()->create([
                'account_id' => $accountId,
                'request_id' => $invoice->request_id,
                'service_id' => $item->service_id,
                'service_provider_id' => $item->service_provider_id,
                'request_item_id' => $item->id,
                'price' => $item->price,
                'currency' => $invoice->currency
            ]);
        }
    }

    public function createInvoice(Model|Request $request, array $requestedItems = [])
    {
        $invoice = new Invoice();
        $invoice->account_id = $request->account_id;
        $invoice->amount = $request->total_cost;
        $invoice->payable_amount = $request->total_cost;
        $invoice->paid_amount = $request->total_cost;
        $invoice->balance = $request->total_cost;
        $invoice->status = $request->status;
        $invoice->invoice_date = now();
        $invoice->ref_no = \Illuminate\Support\Str::random_int(8);
        $invoice->save();

        return $invoice;
    }
    public function sendInvoice($invoice)
    {
        // Logic to send invoice to the user
        Mail::to($invoice->account->email)->send(new InvoiceMail($invoice));
    }

    public function getInvoice($id)
    {
        return Invoice::find($id);
    }

    public function addInvoiceLineItems($invoice, $lineItems)
    {
        foreach ($lineItems as $item) {
            $lineItem = new GeneralLineItem();
            $lineItem->invoice_id = $invoice->id;
            $lineItem->description = $item['description'];
            $lineItem->amount = $item['amount'];
            $lineItem->save();
        }
    }

    public function removeInvoiceLineItem($invoice, $lineItemId)
    {
        $lineItem = GeneralLineItem::find($lineItemId);
        if ($lineItem && $lineItem->invoice_id == $invoice->id) {
            $lineItem->delete();
        }
    }

}