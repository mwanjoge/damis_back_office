<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Embassy;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;

class CountrySeeder extends Seeder
{
    public function run()
    {
        // $embassyIds = Embassy::pluck('id');
        // foreach ($embassyIds as $embassyId) {
        //     Country::factory()->count(2)->create(['embassy_id' => $embassyId]);
        // }

        // Load CSV file
        $csv = Reader::createFromPath(base_path('database/seeders/data/countries.csv'), 'r');
        $csv->setHeaderOffset(0);

        // Iterate through each row
        foreach ($csv as $record) {
            Country::create([
                'name' => $record['name'],
                'phone_code' => $record['telephone'],
                'embassy_id' => empty($record['embassy_id']) ? null : (int) $record['embassy_id'],
                'code' => $record['code'],
            ]);
        }
        \App\Models\Member::factory()->count(95)->create();
        \App\Models\Request::factory()->count(100)->create();
    }
}
