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

        // Load CSV file
        $csv = Reader::createFromPath(base_path('database/seeders/data/missions.csv'), 'r');

        $csv->setHeaderOffset(0);

        // Embassy::factory()->count(3)->create();
        foreach ($csv as $record) {
            $embassy = Embassy::create([
                'name' => $record['name'],
            ]);
            $embassy->account()->save(\App\Models\Account::factory()->create());
        }
    }
}
