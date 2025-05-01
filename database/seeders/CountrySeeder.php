<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Embassy;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $embassyIds = Embassy::pluck('id');
        foreach ($embassyIds as $embassyId) {
            Country::factory()->count(2)->create(['embassy_id' => $embassyId]);
        }
    }
}
