<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Seed related tables first
        $this->call([
            CountrySeeder::class,
            EmbassySeeder::class,
            DepartmentSeeder::class,
            EmployeeSeeder::class,
            ServiceProviderSeeder::class,
            BillableItemSeeder::class,
            MemberSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            RequestSeeder::class, 
        ]);
    }
}
