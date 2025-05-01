<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class ServiceFieldContainer extends Component
{
    public $inputs = [''];

    public function addInput()
    {
        $this->inputs[] = ''; // Add empty string for new input
    }

    public function removeInput($index)
    {
        unset($this->inputs[$index]);
        $this->inputs = array_values($this->inputs); // Reindex to avoid holes in the array
    }

    public function render()
    {
        return view('livewire.service-field-container');
    }
}
