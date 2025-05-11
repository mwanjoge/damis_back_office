<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Request;
use App\Models\Embassy;
use App\Models\Country;

class RequestSearchFilter extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $embassy_id = '';
    public $country_id = '';

    public function updating($field)
    {
        if (in_array($field, ['search', 'status', 'embassy_id', 'country_id'])) {
            $this->resetPage();
        }
    }

    public function updated($property)
    {
        $this->emit('requestFilterChanged', [
            'search' => $this->search,
            'status' => $this->status,
            'embassy_id' => $this->embassy_id,
            'country_id' => $this->country_id,
        ]);
    }

    public function render()
    {
        $query = Request::query()
            ->with(['embassy', 'country']);

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

        return view('livewire.request-search-filter', [
            'requests' => $query->paginate(10),
            'embassies' => Embassy::all(),
            'countries' => Country::all(),
        ]);
    }
}
