<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request;
use App\Models\Account;
use App\Models\Embassy;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\Member;
use App\Models\Country;

class RequestSeeder extends Seeder
{
    public function run()
    {
        $accounts = Account::pluck('id');
        $embassies = Embassy::pluck('id');
        $services = Service::pluck('id');
        $serviceProviders = ServiceProvider::pluck('id');
        $members = Member::pluck('id');
        $countries = Country::pluck('id');

        foreach (range(1, 10) as $i) {
            Request::factory()->create([
                'account_id' => $accounts->random(),
                'embassy_id' => $embassies->random(),
                'service_id' => $services->random(),
                'service_provider_id' => $serviceProviders->random(),
                'member_id' => $members->random(),
                'country_id' => $countries->random(),
            ]);
        }
    }
}
