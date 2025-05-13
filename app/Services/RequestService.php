<?php
namespace App\Services;

use App\Mail\InvoiceMail;
use App\Models\GeneralLineItem;
use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;
use App\Models\Request;
use Illuminate\Database\Eloquent\Model;

class RequestService{

    public $accountId;

    public function createRequest(array $data)
    {
        
        $country = $this->getCountry($data['country_id']);

        return Request::create([
            'account_id' => $this->getAccountId(),
            'embassy_id' => $country->embassy_id,
            'member_id' => $data['member_id'],
            'country_id' => $data['country_id'],
            'type' => $data['type'],
            'tracking_number' => \Illuminate\Support\Str::ulid(),
            'total_cost' =>  collect($data['request_items'] ?? [])->sum('price'),
        ]);

    }

    public function addRequestedItems(Model|Request $request, array $requestedItems){
        // $requestedItems=$request->all()['requestedItems'] ?? [];
        foreach ($requestedItems as $index => $item) {
            // if ($requestedItems->hasFile("requestedItems.$index.attachment")) { 
            //     $file = $request ->file("requestedItems.$index.attachment");
            //     $path= $file -> store('attachment','public');
            // } else{
            //     $path = null;
            // }
            //dd($item);
            \App\Models\RequestItem::create([
                'account_id' => $this->getAccountId(),
                'request_id' => $request->id,
                'service_id' => $item['service_id'],
                'service_provider_id' => $item['service_provider_id'],
                'certificate_holder_name' => $item['certificate_holder_name'],
                'certificate_index_number' => $item['certificate_index_number'] ?? null,
                'price' => $item['price'] ,
                'attachment' =>$item['attachment'],
            ]);
        }
    }

    public function addInvoiceItems(Model|Invoice $invoice, $requestedItems){
        //dd($requestedItems);
        foreach ($requestedItems as $item) {
            $invoice->generalLineItems()->create([
                'account_id' => $this->getAccountId(),
                'service_id' => $item->service_id,
                'service_provider_id' => $item->service_provider_id,
                'request_item_id' => $item->id,
                'price' => $item->price,
                'currency' => $invoice->currency?? 'TZS',
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
        $invoice->status = $request->status?? 'pending';
        $invoice->invoice_date = now();
        $invoice->ref_no = \Illuminate\Support\Str::random(8);
        $invoice->member_id = $request->member_id;

        return $request->invoice()->save($invoice);
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
        return $this->accountId;
    }

}