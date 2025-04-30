<?php

namespace App\Livewire;

use App\Http\Controllers\CountryController;
use Livewire\Component;

class SettingsPage extends Component
{
    public $embassies;
    public $countries;
    public $serviceProviders;
    public $services;

    public function mount()
    {
        // Sample embassies
        $this->embassies = [
            ['id' => 1, 'name' => 'Embassy 1', 'type' => 'embassy', 'is_active' => "active"],
            ['id' => 2, 'name' => 'Embassy 2', 'type' => 'permanent mission', 'is_active' => "active"],
        ];

        // Sample countries linked to embassies
        $this->countries = [
            ['id' => 1, 'name' => 'Country 1', 'embassy_name' => "Embassy 1", 'code' => 'C1', 'phone_code' => '+102'],
            ['id' => 2, 'name' => 'Country 2', 'embassy_name' => "Embassy 2", 'code' => 'C2', 'phone_code' => '+203'],
            ['id' => 3, 'name' => 'Country 3', 'embassy_name' => "Embassy 3", 'code' => 'C3', 'phone_code' => '+344'],
        ];

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

    
//     public function addCountry()
// {
//     $request = Request::create('/country', 'POST', [
//         'name' => $this->name,
//         'code' => $this->code,
//         'phone_code' => $this->phone_code,
//         'embassy_id' => $this->embassy_id,
//     ]);

//     app()->call([CountryController::class, 'store'], ['request' => $request]);

//     $this->reset(['name', 'code', 'phone_code', 'embassy_id']);
// }
   

    public function render()
    {
        return view('livewire.settings-page', [
            'embassies' => $this->embassies,
            'countries' => $this->countries,
            'serviceProviders' => $this->serviceProviders,
            'services' => $this->services,
        ]);
    }
}
