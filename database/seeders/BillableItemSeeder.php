<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillableItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = \App\Models\Service::query()->get();
        $embassies = \App\Models\Embassy::query()->get();
        $fakery = Factory::create();

        foreach ($embassies as $embassy) {
            $price = $fakery->randomElement([20, 50, 1000, 2000, 3000, 4000, 5000, 20000]);
            foreach ($services as $service) {
                if(!is_null($embassy->country_id)){
                    $country = \App\Models\Country::where('id', $embassy->country_id)->first();
                    $service->billableItems()->create([
                        'embassy_id' => $embassy->id,
                        'country_id' => $embassy->country_id,
                        'account_id' => $embassy->account->id,
                        'currency' => $country->currency,
                        'currency_code' => $country->currency_code,
                        'price' => $price,
                    ]);
                }
            }
        }
    }
}
