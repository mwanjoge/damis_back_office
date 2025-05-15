<?php

namespace App\Livewire;

use App\Http\Requests\StoreEmbassyRequest;
use Livewire\Component;
use App\Models\Embassy;
use App\Models\Country;
use App\Http\Controllers\EmbassyController;

class EmbassiesTable extends Component
{
    public $countries = [];
    public $editingId = null;
    public $name;
    public $type;
    public $is_active = 1;
    public $states = [];

    public $currency_code;

    public $currency;

    public $country_id;


    protected $listeners = ['refreshEmbassies' => '$refresh'];

    public function mount()
    {
        $this->loadEmbassies();
    }

    public function loadEmbassies()
    {
        $this->countries = Country::pluck('name', 'id');
    }

    public function openForm($id = null)
    {

        if ($id) {
            $embassy = Embassy::findOrFail($id);
            $this->editingId = $embassy->id;
            $this->name = $embassy->name;
            $this->type = $embassy->type;
            $this->is_active = $embassy->is_active;
            $this->country_id = $embassy->countries->pluck('id')->toArray();
            $this->states = $embassy->countries->pluck('id')->toArray();
        } else {
            $this->reset(['editingId', 'name', 'type', 'is_active', 'states']);
        }
    }


    public function render()
    {
        return view('livewire.embassies-table', [
            'embassies' => Embassy::where('id', '>', 1)->get(),
            'countries' => $this->countries,
        ]);
    }
}
