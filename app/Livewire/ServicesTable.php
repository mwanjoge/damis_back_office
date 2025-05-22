<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Exception;

class ServicesTable extends Component
{
    public $services = [];
    public $serviceProviders = [];
    public $editingId = null;
    public $name = '';
    public $selectedProvider = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'selectedProvider' => 'required|exists:service_providers,id',
    ];

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

    public function resetForm()
    {
        $this->reset(['editingId', 'name', 'selectedProvider']);
        $this->resetValidation();
    }

    // public function save()
    // {
    //     $this->validate();

    //     try {
    //         DB::beginTransaction();

    //         $data = [
    //             'name' => $this->name,
    //             'service_provider_id' => $this->selectedProvider
    //         ];

    //         if ($this->editingId) {
    //             Service::findOrFail($this->editingId)->update($data);
    //             $message = 'Service updated successfully!';
    //         } else {
    //             Service::create($data);
    //             $message = 'Service created successfully!';
    //         }

    //         DB::commit();
            
    //         $this->dispatch('showAlert', [
    //             'type' => 'success',
    //             'message' => $message
    //         ]);
            
    //         $this->loadData();
    //         $this->resetForm();
    //         $this->dispatch('close-modal');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         $this->dispatch('showAlert', [
    //             'type' => 'error',
    //             'message' => 'Error: ' . $e->getMessage()
    //         ]);
    //     }
    // }

    // public function deleteConfirm($id)
    // {
    //     try {
    //         DB::beginTransaction();
            
    //         $service = Service::findOrFail($id);
    //         $service->delete();
            
    //         DB::commit();
            
    //         $this->dispatch('showAlert', [
    //             'type' => 'success',
    //             'message' => 'Service deleted successfully'
    //         ]);
            
    //         // Reload data after successful deletion
    //         $this->loadData();
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         $this->dispatch('showAlert', [
    //             'type' => 'error',
    //             'message' => 'Failed to delete service: ' . $e->getMessage()
    //         ]);
    //     }
    // }
    
    public function render()
    {
        return view('livewire.services-table', [
            'services' => $this->services,
            'serviceProviders' => $this->serviceProviders
        ]);
    }
}
