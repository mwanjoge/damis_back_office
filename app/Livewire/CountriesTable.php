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

    public function deleteCountry($id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->delete();
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => 'Country deleted successfully!'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Failed to delete country: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteConfirm($id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->delete();
            
            session()->flash('message', 'Country deleted successfully.');
            $this->dispatch('showDeleteSuccess');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting country: ' . $e->getMessage());
            $this->dispatch('showDeleteError');
        }
    }

    public function render()
    {
        return view('livewire.countries-table', [
            'countries' => Country::with('embassy')->get(),
        ]);
    }
}
