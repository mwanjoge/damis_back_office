<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Embassy;



class AccountSearchFilter extends Component
{ 


    public $search = '';
    public $embassy_id = '';

    public function updating($field)
    {
        if (in_array($field, ['search', 'embassy_id'])) {
            $this->resetPage();
        }
    }

    public function updated($property)
    {
        $this->emit('requestFilterChanged', [
            'search' => $this->search,
            'embassy_id' => $this->embassy_id,
        ]);
    }

    public function render()
    {
        $query = Embassy::query()
            ->with(['embassy']);

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        if ($this->embassy_id) {
            $query->where('embassy_id', $this->embassy_id);
        }


        return view('livewire.account-search-filter', [
            'embassies' => Embassy::all(),
        ]);
    }
}
