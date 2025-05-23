<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Embassy;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Controllers\CountryController;
use App\Http\Requests\UpdateCountryRequest;

class CountriesTable extends Component
{
    use WithPagination;

    // public $countries = [];
    public $embassies = [];

    public $editingId = null;
    public $name;
    public $code;
    public $phone_code;
    public $embassy_id;

    protected $listeners = ['refreshCountries' => '$refresh'];

    public function mount()
    {
        $this->embassies = Embassy::query()->get();
        // $this->countries = Country::with('embassy')->get();
    }

    public function openForm($id = null)
    {
        if ($id) {
            $country = Country::findOrFail($id);
            $this->editingId = $country->id;
            $this->name = $country->name;
            $this->code = $country->code;
            $this->phone_code = $country->phone_code;
            $this->embassy_id = $country->embassy_id;
        } else {
            $this->reset(['editingId', 'name', 'code', 'phone_code', 'embassy_id']);
        }
    }

    public function render()
    {
        return view('livewire.countries-table', [
            'countries' => Country::with('embassy')->paginate(10)
        ]);
    }
}
