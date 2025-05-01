<?php

namespace App\Livewire;

use Livewire\Component;

class ServiceProviderForm extends Component
{
    public $services = ['']; // Initial empty service
    

    


    public function removeService($index)
    {
        unset($this->services[$index]); // Remove a service field by its index
        $this->services = array_values($this->services); // Reindex the array after removal
    }

    public function render()
    {
        return view('livewire.service-provider-form');
    }
}
