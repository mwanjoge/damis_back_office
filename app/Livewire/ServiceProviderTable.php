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

    public function updated($propertyName): void
    {
        //dd($propertyName);
        $this->validateOnly($propertyName, $this->rules());
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            if ($this->editingId) {
                $serviceProvider = ServiceProvider::findOrFail($this->editingId);
                $serviceProvider->update(['name' => $this->name]);
                $serviceProvider->services()->sync($this->selectedServices);
                $message = 'Service Provider updated successfully!';
            } else {
                $serviceProvider = ServiceProvider::create(['name' => $this->name]);
                $serviceProvider->services()->attach($this->selectedServices);
                event(new EmbassyCreated($serviceProvider));
                $message = 'Service Provider created successfully!';
            }

            DB::commit();
            
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => $message
            ]);

            $this->reset(['editingId', 'name', 'selectedServices']);
            $this->loadData();
            $this->dispatch('close-modal');
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteConfirm($id)
    {
        try {
            DB::beginTransaction();
            
            $serviceProvider = ServiceProvider::findOrFail($id);
            $serviceProvider->delete();
            
            DB::commit();
            
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => 'Service Provider deleted successfully'
            ]);
            
            // Reload data after successful deletion
            $this->loadData();
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Failed to delete Service Provider: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.service-provider-table', [
            'serviceProviders' => $this->serviceProviders,
            'services' => $this->services
        ]);
    }
}
