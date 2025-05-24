<?php

namespace App\Services;

use App\Mail\InvoiceMail;
use App\Models\GeneralLineItem;
use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;
use App\Models\Request;
use App\Models\Embassy;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Database\Eloquent\Model;
use App\Mail\RequestNotificationMail;

class RequestService
{

    public $accountId;

    public function createRequest(array $data)
    {
    //    dd($data);
        $country = $this->getCountry($data['country_id']);
        $totalCost = 0;
        foreach ($data['request_items'] as $item) {
            $totalCost += $item['price'] ?? $data['price'];
        }
        return Request::create([
            'account_id' => $country->embassy_id,
            'embassy_id' => $country->embassy_id,
            'member_id' => $data['member_id'],
            'country_id' => $data['country_id'],
            'type' => $data['type'],
            'tracking_number' => \Illuminate\Support\Str::ulid(),
            'total_cost' => $totalCost,
        ]);
    }


    public function addRequestedItems(Model|HttpRequest $request, array $requestedItems, $price)
    {

        // dd($price);
        foreach ($requestedItems as $item) {
            $filePath = null;

            if (!empty($item['attachment']) && $item['attachment'] instanceof \Illuminate\Http\UploadedFile) {
                if ($item['attachment']->isValid()) {
                    $filePath = $item['attachment']->store('documents', 'public');
                }
            }

            \App\Models\RequestItem::create([
                'account_id' => $this->getAccountId(),
                'request_id' => $request->id,
                'service_id' => $item['service_id'],
                'service_provider_id' => $item['service_provider_id'],
                'certificate_holder_name' => $item['certificate_holder_name'],
                'certificate_index_number' => $item['certificate_index_number'] ?? null,
                'price' => $item['price'] ?? $price,
                'attachment' => $filePath,
            ]);
        }
    }


    public function addInvoiceItems(Model|Invoice $invoice, $requestedItems)
    {
        //dd($requestedItems);
        foreach ($requestedItems as $item) {
            $invoice->generalLineItems()->create([
                'account_id' => $this->getAccountId(),
                'service_id' => $item->service_id,
                'service_provider_id' => $item->service_provider_id,
                'request_item_id' => $item->id,
                'price' => $item->price,
                'currency' => $invoice->currency ?? 'TZS',
            ]);
        }
    }

    public function createInvoice(Model|Request $request, array $requestedItems = [])
    {
        $invoice = new Invoice();
        $invoice->account_id = $this->getAccountId();
        $invoice->amount = $request->total_cost;
        $invoice->payable_amount = $request->total_cost;
        $invoice->paid_amount = $request->total_cost;
        $invoice->balance = $request->total_cost;
        $invoice->status = $request->status ?? 'pending';
        $invoice->invoice_date = now();
        $invoice->ref_no = \Illuminate\Support\Str::random(8);
        $invoice->member_id = $request->member_id;

        return $request->invoice()->save($invoice);
    }

    public function notifyMember($invoice, $request)
    {
        $this->sendInvoiceNotification($invoice);
        $this->sendRequestNotification($request);
    }

    public function sendInvoiceNotification($invoice)
    {
        // Logic to send invoice to the user
        Mail::to($invoice->member->email)->send(new InvoiceMail($invoice));
    }

    public function sendRequestNotification($request)
    {
        // Logic to send request notification
        Mail::to($request->member->email)->send(new RequestNotificationMail($request));
    }

    public function getInvoice($id)
    {
        return Invoice::find($id);
    }

    public function removeInvoiceLineItem($invoice, $lineItemId)
    {
        $lineItem = GeneralLineItem::find($lineItemId);
        if ($lineItem && $lineItem->invoice_id == $invoice->id) {
            $lineItem->delete();
        }
    }

    public function getCountry(int $countryId)
    {
        return \App\Models\Country::find($countryId);
    }

    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }
    public function getAccountId()
    {
        return Embassy::where('country_id', $this->accountId)->first()->id;
    }
}
