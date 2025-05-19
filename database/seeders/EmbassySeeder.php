<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Embassy;
use League\Csv\Reader;

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

        // Load CSV file
        $csv = Reader::createFromPath(base_path('database/seeders/data/missions.csv'), 'r');

        $csv->setHeaderOffset(0);

        // Embassy::factory()->count(3)->create();
        foreach ($csv as $record) {
            $embassy = Embassy::create([
                'name' => $record['name'],
                'type' => $record['type'],
            ]);
            $embassy->account()->save(\App\Models\Account::factory()->create());
        }
    }
}