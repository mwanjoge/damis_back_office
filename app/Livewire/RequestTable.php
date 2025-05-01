<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Request;

class RequestTable extends Component
{
    public $requests;

    public function mount()
    {
        $this->requests = Request::all();
    }

    public function render()
    {
        return view('livewire.request-table');
    }
}
