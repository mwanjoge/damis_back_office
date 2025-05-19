<?php

namespace App\Livewire;

use App\Models\BillableItem;
use App\Models\Service;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class RequestItems extends Component
{
    use WithFileUploads;
    public $inputs = [['service_provider_id' => '', 'service_id' => '', 'price' => '', 'certificate_holder_name' => '', 'certificate_index_number' => '', 'attachment' => '']];
    public $services;
    public $servicesInputs = [];

    public $test;

    public function addInput()
    {
        $this->inputs[] = ['service_provider_id' => '', 'service_id' => '', 'price' => '', 'certificate_holder_name' => '', 'certificate_index_number' => '', 'attachment' => ''];
    }


    public function removeInput($index)
    {
        unset(
            $this->inputs[$index]
        );

        $this->inputs = array_values($this->inputs);
    }

    public function getServices($key)
    {
        $this->services = Service::query()->where('service_provider_id', $this->inputs[$key]['service_provider_id'])->get();
        $this->servicesInputs[$key] = $this->services;
    }

    public function updatedInputsServiceId($value, $key)
    {
        // Extract the index from the key (format: "0.service_id")
        $index = explode('.', $key)[0];

        if (!empty($value)) {
            // Get the service
            $service = Service::find($value);

            if ($service) {
                // Set the price for this service
                $this->inputs[$index]['price'] = $service->price;
            }
        }
    }

    public function render()
    {
        return view(
            'livewire.request-items',
            [
                'providers' => ServiceProvider::query()->get(),
                'services' => $this->services
            ]
        );
    }
}
