<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => '2022-01-02 17:04:58',
                'created_at' => now(),
            ]);
        }

        // Example: Add sample data for requests and related tables
       // \App\Models\Account::factory()->count(43)->create();
        \App\Models\Embassy::factory()->count(43)->create()->each(function ($embassy) {
            $embassy->account()->save(\App\Models\Account::factory()->create());
        });
        \App\Models\Member::factory()->count(95)->create();

        // Only call Service::factory() if your services table has an account_id column!
        // \App\Models\Service::factory()->count(2)->create();

        // Only call ServiceProvider::factory() if your service_providers table has the correct columns!
        // \App\Models\ServiceProvider::factory()->count(2)->create();

        // Only call Country::factory() if your countries table has the correct columns!
        // \App\Models\Country::factory()->count(2)->create();

        \App\Models\Request::factory()->count(100)->create();

        // Seed related tables first
        $this->call([
            //AccountSeeder::class,
            //EmbassySeeder::class,
            // ServiceSeeder::class,
            ServiceProviderSeeder::class,
            //MemberSeeder::class,
            //CountrySeeder::class,
            //RequestSeeder::class, // Requests last!
        ]);
    }
}
