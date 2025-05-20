<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Account;

class MemberSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Member::factory()->count(95)->create();
    }
}
