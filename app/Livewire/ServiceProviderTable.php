<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Events\EmbassyCreated;
use Exception;

class ServiceProviderTable extends Component
{
    public $serviceProviders = [];
    public $services = [];

    public $editingId = null;
    public $name;
    public $selectedServices = [];

    protected $listeners = ['refreshServiceProviders' => '$refresh'];

    protected function rules()
    {
        return [
            'name' => 'required|max:5|string|unique:service_providers,name'
        ];
    }

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->services = Service::all();
        $this->serviceProviders = ServiceProvider::with('services')->get()->map(function ($provider) {
            return [
                'id' => $provider->id,
                'name' => $provider->name,
                'services' => $provider->services->pluck('id')->toArray(),
            ];
        })->toArray();
    }


    public function openForm($id = null)
    {
        // dd($id);
        if ($id) {
            $provider = ServiceProvider::with('services')->findOrFail($id);
            $this->editingId = $provider->id;
            $this->name = $provider->name;
            $this->selectedServices = $provider->services->pluck('id')->toArray();
        } else {
            $this->reset(['editingId', 'name', 'selectedServices']);
        }
    }

    public function refreshServiceProvidersExternally()
    {
        $this->loadData();
    }


    public function updated($propertyName): void
    {
        //dd($propertyName);
        $this->validateOnly($propertyName, $this->rules());
    }

    public function render()
    {
        return view('livewire.service-provider-table', [
            'serviceProviders' => $this->serviceProviders,
            'services' => $this->services
        ]);
    }
}
