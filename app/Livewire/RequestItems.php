<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\ServiceProvider;
use Livewire\Component;

class RequestItems extends Component
{
    public $inputs = [['service_provider_id' => '', 'service_id' => '', 'price' => '', 'certificate_holder_name' => '', 'certificate_index_number' => '', 'attachment' => '']];


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


    public function render()
    {
        return view(
            'livewire.request-items',
            [
                'providers' => ServiceProvider::query()->get(),
                'services' => Service::query()->get()
            ]
        );

    }
}
