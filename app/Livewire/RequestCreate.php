<?php

namespace App\Http\Livewire;

use App\Livewire\EmbassiesTable;
use Livewire\Component;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\Request;
use App\Models\RequestItem;
use Illuminate\Support\Str;

class RequestCreate extends Component
{
    public $account_id;
    public $embassy_id;
    public $member_id;
    public $country_id;
    public $type = 'Diaspora';
    public $total_cost = 0;
    public $selectedEmmmbassy;

    public function updatedCountryId($value)
    {
        $country = \App\Models\Country::find($value);
        if ($country) {
            $this->selectedEmmmbassy = $country?->embassy;
            $this->emit('countrySelected', $this->selectedEmmmbassy?->name);
        } else {
            $this->selectedEmmmbassy = null;
            $this->embassy_id = null;
        }
    }


    public function removeRequestItem($index)
    {
        unset($this->request_items[$index]);
        $this->request_items = array_values($this->request_items);
    }

    public function updatedRequestItems()
    {
        $this->total_cost = array_sum(array_column($this->request_items, 'amount'));
    }

    public function submit()
    {
        $this->validate([
            'account_id' => 'required|exists:accounts,id',
            'embassy_id' => 'required|exists:embassies,id',
            'member_id' => 'required|exists:members,id',
            'country_id' => 'required|exists:countries,id',
            'request_items.*.service_id' => 'required|exists:services,id',
            'request_items.*.service_provider_id' => 'required|exists:service_providers,id',
            'request_items.*.amount' => 'required|numeric|min:0',
            'request_items.*.certificate_holder_name' => 'required|string',
            'request_items.*.certificate_index_number' => 'nullable|string',
            'request_items.*.attachment' => 'nullable|string',
        ]);

        $request = Request::create([
            'account_id' => $this->account_id,
            'embassy_id' => $this->embassy_id,
            'member_id' => $this->member_id,
            'country_id' => $this->country_id,
            'type' => $this->type,
            'status' => $this->status,
            'tracking_number' => Str::ulid(),
            'is_approved' => $this->is_approved,
            'is_paid' => $this->is_paid,
            'total_cost' => array_sum(array_column($this->request_items, 'amount')),
            'sent_status' => $this->sent_status,
        ]);

        foreach ($this->request_items as $item) {
            RequestItem::create([
                'account_id' => $this->account_id,
                'request_id' => $request->id,
                'service_id' => $item['service_id'],
                'certificate_holder_name' => $item['certificate_holder_name'],
                'certificate_index_number' => $item['certificate_index_number'],
                'attachment' => $item['attachment'],
                // If you want to store service_provider_id and amount, adjust your model/migration accordingly
            ]);
            // Save amount and service_provider_id in related tables if needed
        }

        session()->flash('success', 'Request created successfully!');
        return redirect()->route('requests.index');
    }

    public function render()
    {
        return view('livewire.request-create', [
            'services' => Service::all(),
            'serviceProviders' => ServiceProvider::all(),
        ]);
    }
}
