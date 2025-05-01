<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => \App\Models\Account::factory(),
            'embassy_id' => \App\Models\Embassy::factory(),
            'service_id' => \App\Models\Service::factory(),
            'service_provider_id' => \App\Models\ServiceProvider::factory(),
            'member_id' => \App\Models\Member::factory(),
            'country_id' => \App\Models\Country::factory(),
            'type' => $this->faker->randomElement(['Diaspora', 'Domestic']),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed', 'Cancelled']),
            'tracking_number' => $this->faker->unique()->uuid(),
            'is_approved' => $this->faker->boolean(),
            'is_paid' => $this->faker->boolean(),
            'total_cost' => $this->faker->randomFloat(2, 50, 1000),
            'sent_status' => $this->faker->randomElement(['sent', 'failed']),
        ];
    }
}
