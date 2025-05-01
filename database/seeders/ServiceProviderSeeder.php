<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceProvider;
use App\Models\Account;

class ServiceProviderSeeder extends Seeder
{
    public function run()
    {
        $accountIds = Account::pluck('id');
        foreach ($accountIds as $accountId) {
            ServiceProvider::factory()->count(2)->create(['account_id' => $accountId]);
        }
    }
}
