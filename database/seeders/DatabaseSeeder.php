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

        // Seed related tables first
        $this->call([
            AccountSeeder::class,
            EmbassySeeder::class,
            ServiceSeeder::class,
            ServiceProviderSeeder::class,
            MemberSeeder::class,
            CountrySeeder::class,
            RequestSeeder::class, // Requests last!
        ]);
    }
}
