<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Request;

class RequestTable extends Component
{
    public $status = 'Pending';
    public $requests = [];
    public $search = '';

    public function mount()
    {
        $this->loadRequests();
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->loadRequests();
    }

    public function updatedSearch()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        $query = Request::where('status', $this->status);

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->whereHas('embassy', function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('country', function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhere('tracking_number', 'like', '%' . $this->search . '%')
                ->orWhere('type', 'like', '%' . $this->search . '%');
            });
        }

        $this->requests = $query->get();
    }

    public function render()
    {
        return view('livewire.request-table');
    }
}
