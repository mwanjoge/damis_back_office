<?php

namespace App\Livewire;

use Livewire\Component;

class ServiceFieldContainer extends Component
{
    public $count = 0;

    public function addInput()
    {
        $this->count++;
    }
    public function render()
    {
        return view('livewire.service-field-container');
    }
}
