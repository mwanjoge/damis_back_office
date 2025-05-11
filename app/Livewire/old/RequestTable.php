<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Request;

class RequestTable extends Component
{
    public $requests;
    public $status = 'Pending';

    public function mount($requests = null)
    {
        $this->status = 'Pending';
        $this->requests = $requests ?? Request::all();
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getFilteredRequestsProperty()
    {
        return $this->requests->where('status', $this->status);
    }

    public function render()
    {
        return view('livewire.request-table');
    }
}
