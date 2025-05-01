<?php

namespace App\Livewire;

use App\Http\Controllers\CountryController;
use Livewire\Component;
use App\Models\Country;
use App\Models\Embassy;
use Livewire\WithPagination;

class SettingsPage extends Component
{
    use WithPagination;

    //   public $embassies;
     
    // public $countries;
    public $serviceProviders;
    public $services;

    public $count = 1;

    
    public function addService()
    {
        $this->count++; // Add a new empty service field
    }

    public function mount()
    {
        // ini_set('memory_limit', '2048M');

        // Sample embassies
        // $this->embassies = Embassy::paginate(30);

        // $this->countries = Country::paginate(30);
        
        // Sample service providers
        $this->serviceProviders = [
            ['id' => 1, 'name' => 'RITA'],
            ['id' => 2, 'name' => 'NECTA'],
        ];

        // Sample services linked to service providers
        $this->services = [
            ['id' => 1, 'name' => 'Service 1', 'service_provider' => 'RITA'],
            ['id' => 2, 'name' => 'Service 2', 'service_provider' => 'RITA'],
            ['id' => 3, 'name' => 'Service 3', 'service_provider' => 'NECTA'],
        ];
    }

   

    public function render()
    {
        return view('livewire.settings-page', [
            'embassies' => Embassy::all(),
            'countries' => Country::paginate(30),
            // 'embassies' => collect([]),
            // 'countries' => collect([]),
            'serviceProviders' => $this->serviceProviders,
            'services' => $this->services,
        ]);
    }
}
