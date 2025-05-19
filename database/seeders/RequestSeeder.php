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
use App\Models\Invoice;

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

        $amount = 20000;
        foreach (range(1, 10) as $i) {
            $request = Request::factory()->create([
                'account_id' => $accounts->random(),
                'embassy_id' => $embassies->random(),
                'service_id' => $services->random(),
                'service_provider_id' => $serviceProviders->random(),
                'member_id' => $members->random(),
                'country_id' => $countries->random(),
                'total_cost' => $amount
            ]);
            
            $request->invoice()->create([
                'account_id' => $request->account_id,
                'request_id' => $request->id,
                'member_id' => $request->member_id,
                'amount'  => $amount,
                'payable_amount' => $amount,
                'balance' => $amount
            ]);
        }
    }
}
