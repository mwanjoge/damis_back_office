<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Embassy;

class EmbassySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Embassy::factory()->count(3)->create();
    }
}
