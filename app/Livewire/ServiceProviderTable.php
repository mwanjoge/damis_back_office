<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceProvider;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\ServiceProviderController;

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
        $this->services = Service::all()->toArray();
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
            'services' => $this->selectedServices,
        ];

        $request = Request::create(
            '/fake',
            $this->editingId ? 'PUT' : 'POST',
            array_merge($data, ['id' => $this->editingId])
        );

        app()->call([ServiceProviderController::class, 'storeOrUpdate'], ['request' => $request]);

        $this->reset(['editingId', 'name', 'selectedServices']);
        $this->mount(); // reload data
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        app()->call([ServiceProviderController::class, 'destroy'], ['id' => $id]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.service-provider-table');
    }
}
