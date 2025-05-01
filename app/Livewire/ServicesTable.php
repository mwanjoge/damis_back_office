<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\ServiceProvider;

class ServicesTable extends Component
{
    public $services = [];
    public $serviceProviders = [];

    public $editingId = null;
    public $name = '';
    public $selectedProvider = '';

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->services = Service::with('serviceProvider')->get();
        $this->serviceProviders = ServiceProvider::all();
    }

    public function openForm($id = null)
    {
        if ($id) {
            $service = Service::findOrFail($id);
            $this->editingId = $service->id;
            $this->name = $service->name;
            $this->selectedProvider = $service->service_provider_id;
        } else {
            $this->reset(['editingId', 'name', 'selectedProvider']);
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'selectedProvider' => 'required|exists:service_providers,id',
        ]);

        Service::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name' => $this->name,
                'service_provider_id' => $this->selectedProvider,
            ]
        );

        $this->reset(['editingId', 'name', 'selectedProvider']);
        $this->loadData();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        Service::findOrFail($id)->delete();
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.services-table');
    }
}
