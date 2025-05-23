<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = \App\Models\Employee::create([
            'account_id' => 1,
            'department_id' => 1,
            'first_name' => 'John Doe',
            'last_name' => 'Doe',
            'email' => 'admin@gmail.com']);

        if (!User::where('email', 'admin@gmail.com')->exists()) {
            $employee->user()->create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => '2022-01-02 17:04:58',
                'created_at' => now(),
            ]);
        }
    }
}
