<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Country;
use App\Models\Embassy;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\Employee;
use App\Models\Member;
use App\Models\Department;
use App\Models\Designation;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create(['name' => 'admin','email' => 'admin@gmail.com','password' => Hash::make('12345678'),'email_verified_at'=>'2022-01-02 17:04:58','created_at' => now(),]);
    
        // Create Embassies
        $embassies = Embassy::factory()->count(3)->create();

        // Create Countries
        foreach ($embassies as $embassy) {
            Country::factory()->count(2)->create([
                'embassy_id' => $embassy->id
            ]);
        }

        // Create Accounts
        foreach ($embassies as $embassy) {
            $account = Account::factory()->create([
                'name' => 'Account ' . Str::random(5),
                'embassy_id' => $embassy->id,
                'has_depertment' => true,
            ]);

            // Create Service Providers for each Account
            ServiceProvider::factory()->count(2)->create([
                'account_id' => $account->id
            ]);

            // Create Services for each Account
            Service::factory()->count(3)->create([
                'account_id' => $account->id
            ]);

            // Create Depertments & Designations
            $department = Department::factory()->create([
                'account_id' => $account->id
            ]);

            $designation = Designation::factory()->create();

            // Create Employees
            Employee::factory()->count(2)->create([
                'account_id' => $account->id,
                'depertment_id' => $department->id,
                'designation_id' => $designation->id,
            ]);

            // Create Members
            Member::factory()->count(2)->create([
                'account_id' => $account->id
            ]);
        }
    }
}
