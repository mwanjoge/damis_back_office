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
            $this->editingId = $id;
            $this->name = $service->name;
            $this->selectedProvider = $service->service_provider_id;
        } else {
            $this->resetForm();
        }
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
