<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Embassy;
use League\Csv\Reader;
use Illuminate\Support\Str;

class EmbassySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $request = [
            "name" => "Ministry of Foreign Affairs And East African Cooperation",
            "country_id" => 172,
            "type" => "Embassy",
        ];

        $embassy = Embassy::create($request);

        $embassy->account()->save(\App\Models\Account::create([
            'name' => $request['name'],
            'has_depertment' => false,
        ]));

        print('stsrting');

        // Load CSV file
        $csv = Reader::createFromPath(base_path('database/seeders/data/missions.csv'), 'r');

        $csv->setHeaderOffset(0);

        // Embassy::factory()->count(3)->create();
        foreach ($csv as $record) {
            $countryName = Str::of($record['name'])->afterLast(', ');
          
            $country = \App\Models\Country::where('name', $countryName)->first();
            $embassy = Embassy::create([
                'name' => $record['name'],
                'type' => 'Embassy',
                'country_id' => $country?->id,
            ]);

            $embassy->account()->save(\App\Models\Account::factory()->create([
                'name' => $embassy->name
            ]));

            $country?->update([
                'embassy_id' => $embassy->id,
            ]);
        }
    }


}