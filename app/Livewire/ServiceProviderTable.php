<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\ServiceProvider;

class ServiceProviderTable extends Component
{
    public $serviceProviders = [];
    public $services = [];

    public $editingId = null;
    public $name;
    public $selectedServices = [];

    protected $listeners = ['refreshServiceProviders' => '$refresh'];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->services = Service::all();
        $this->serviceProviders = ServiceProvider::with('services')->get()->toArray();
    }

    public function openForm($id = null)
    {
        if ($id) {
            $provider = ServiceProvider::with('services')->findOrFail($id);
            $this->editingId = $provider->id;
            $this->name = $provider->name;
            $this->selectedServices = $provider->services->pluck('id')->toArray();
        } else {
            $this->reset(['editingId', 'name', 'selectedServices']);
        }
    }

    public function save()
    {
        $data = [
            'name' => $this->name,
            'inputs' => $this->selectedServices,
        ];


        $this->reset(['editingId', 'name', 'selectedServices']);
        $this->mount(); // Reload data
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.service-provider-table');
    }
}
