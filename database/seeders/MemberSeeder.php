<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Account;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $accountIds = Account::pluck('id');
        foreach ($accountIds as $accountId) {
            Member::factory()->count(2)->create(['account_id' => $accountId]);
        }

        Member::factory()->count(6)->create();
    }
}
