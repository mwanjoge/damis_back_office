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
<<<<<<< HEAD
        $this->inputs[] =[ ['service_provider_id' => '', 'service_id' => '', 'price' => '', 'certificate_holder_name' => '', 'certificate_index_number' => '', 'attachment' => '']];
    }
=======
        $this->inputs[] = [['service_provider_id' => '', 'service_id' => '', 'price' => '', 'certificate_holder_name' => '', 'certificate_index_number' => '', 'attachment' => '']];
    }

>>>>>>> 701fd51ddf4f8694b3c941a2466a9f682904f9d3

    public function removeInput($index)
    {
        unset(
            $this->inputs[$index]
        );

        $this->inputs = array_values($this->inputs);
    }

<<<<<<< HEAD
    public function getServices($key){
=======
    public function getServices($key)
    {
>>>>>>> 701fd51ddf4f8694b3c941a2466a9f682904f9d3
        $this->services = Service::query()->where('service_provider_id', $this->inputs[$key]['service_provider_id'])->get();
        $this->servicesInputs[] = $this->services;
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
