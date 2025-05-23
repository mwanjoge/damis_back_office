<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Embassy;
use Livewire\Component;

class CountriesTable extends Component
{
    public $embassies = [];

    public $editingId = null;
    public $name;
    public $code;
    public $phone_code;
    public $embassy_id;
    public $currency;
    public $currency_code;

    protected $listeners = ['refreshCountries' => '$refresh'];

    public function mount()
    {
        $this->embassies = Embassy::query()->get();
    }

    public function openForm($encodedId = null)
    {
        if ($encodedId) {
            // Decode the encoded ID
            $id = is_array($encodedId) ? (decode($encodedId)[0] ?? null) : (decode([$encodedId])[0] ?? null);
            if (!$id) {
                $this->resetForm();
                return;
            }
            $country = Country::findOrFail($id);
            $this->editingId = $encodedId;
            $this->name = $country->name;
            $this->code = $country->code;
            $this->phone_code = $country->phone_code;
            $this->currency = $country->currency;
            $this->currency_code = $country->currency_code;
            $this->embassy_id = $country->embassy_id;
        } else {
            $this->resetForm();
        }
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->name = null;
        $this->code = null;
        $this->phone_code = null;
        $this->currency = null;
        $this->currency_code = null;
        $this->embassy_id = null;
    }

    public function deleteConfirm($encodedId)
    {
        try {
            $id = is_array($encodedId) ? (decode($encodedId)[0] ?? null) : (decode([$encodedId])[0] ?? null);
            if (!$id) throw new \Exception('Invalid ID');
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
