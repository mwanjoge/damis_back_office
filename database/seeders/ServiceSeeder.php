<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Account;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $accountIds = Account::pluck('id');
        foreach ($accountIds as $accountId) {
            Service::factory()->count(2)->create(['account_id' => $accountId]);
        }
    }
}
