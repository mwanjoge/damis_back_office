<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Request;

class RequestTable extends Component
{
    public $requests;
    public $search = '';
    public $status = '';
    public $embassy_id = '';
    public $country_id = '';

    protected $listeners = ['requestFilterChanged' => 'applyFilters'];

    public function mount($requests = null)
    {
        $this->status = 'Pending';
        $this->requests = $requests ?? Request::all();
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function applyFilters($filters)
    {
        $this->search = $filters['search'] ?? '';
        $this->status = $filters['status'] ?? '';
        $this->embassy_id = $filters['embassy_id'] ?? '';
        $this->country_id = $filters['country_id'] ?? '';
        $this->resetPage();
    }

    public function getFilteredRequestsProperty()
    {
        return $this->requests->where('status', $this->status);
    }

    public function render()
    {
        $query = Request::query()->with(['embassy', 'country']);

        if ($this->search) {
            $query->where('tracking_number', 'like', "%{$this->search}%");
        }
        if ($this->status) {
            $query->where('status', $this->status);
        }
        if ($this->embassy_id) {
            $query->where('embassy_id', $this->embassy_id);
        }
        if ($this->country_id) {
            $query->where('country_id', $this->country_id);
        }

        return view('livewire.request-table', [
            'requests' => $query->paginate(10),
        ]);
    }
}
