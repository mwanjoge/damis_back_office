<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Request;

class RequestTable extends Component
{
    public $status = 'Pending';

    public function mount()
    {
        $this->status = 'Pending';
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getFilteredRequestsProperty()
    {
        return Request::where('status', $this->status)->get();
    }

    public function render()
    {
        return view('livewire.request-table');
    }
}
