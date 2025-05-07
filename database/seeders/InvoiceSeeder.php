<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('invoices')->truncate();

        // Ensure related records exist
        $account = \App\Models\Account::first() ?? \App\Models\Account::factory()->create();
        $member = \App\Models\Member::first() ?? \App\Models\Member::factory()->create();
        $request = \App\Models\Request::first() ?? \App\Models\Request::factory()->create([
            'account_id' => $account->id,
            'member_id' => $member->id,
        ]);

        // Create sample invoices with valid foreign keys using factory
        Invoice::factory()->count(5)->create([
            'account_id' => $account->id,
            'request_id' => $request->id,
            'member_id' => $member->id,
        ]);
    }
}
