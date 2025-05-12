<?php

namespace App\Livewire;

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
    $this->inputs[] =[ ['service_provider_id' => '', 'service_id' => '', 'price' => '', 'certificate_holder_name' => '', 'certificate_index_number' => '', 'attachment' => '']];
}


    public function removeInput($index)
    {
        unset(
            $this->inputs[$index]
        );

        $this->inputs = array_values($this->inputs);
    }

    public function getServices($key){
        // Log::info("providerId ".$this->inputs[$key]['service_provider_id']);
        $this->services = Service::query()->where('service_provider_id', $this->inputs[$key]['service_provider_id'])->get();
        $this->servicesInputs[] = $this->services;
    }


    public function render()
    {
        Log::info('working');
        //Log::debug("inputs on render ".json_encode($this->inputs));
        return view(
            'livewire.request-items',
            [
                'providers' => ServiceProvider::query()->get(),
                'services' => $this->services
            ]
        );

    }
}
