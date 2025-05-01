<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Embassy;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Controllers\CountryController;
use App\Http\Requests\UpdateCountryRequest;

class CountriesTable extends Component
{
    public $countries = [];
    public $embassies = [];

    public $editingId = null;
    public $name;
    public $code;
    public $phone_code;
    public $embassy_id;

    protected $listeners = ['refreshCountries' => '$refresh'];

    public function mount()
    {
        $this->embassies = Embassy::all()->toArray();
        $this->countries = Country::with('embassy')->get()->toArray();
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

    public function save()
    {
        $data = [
            'name' => $this->name,
            'code' => $this->code,
            'phone_code' => $this->phone_code,
            'embassy_id' => $this->embassy_id,
        ];


        $request = new StoreCountryRequest($data);


        $countryController = app(CountryController::class);


        if ($this->editingId) {
            $data['id'] = $this->editingId;
            $request = new UpdateCountryRequest($data);
        }

        $countryController->store($request);
        $this->reset(['editingId', 'name', 'code', 'phone_code', 'embassy_id']);
        $this->mount(); 
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        app()->call([CountryController::class, 'destroy'], ['id' => $id]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.countries-table');
    }
}
