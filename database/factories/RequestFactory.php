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
            'account_id' => $this->faker->numberBetween(1, 43),
            'embassy_id' => $this->faker->numberBetween(1, 43), // Assuming you have 10 embassies
            'member_id' => $this->faker->numberBetween(1, 95),
            'country_id' => $this->faker->numberBetween(1, 25),
            'type' => $this->faker->randomElement(['Diaspora', 'Domestic']),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed', 'Cancelled']),
            'tracking_number' => $this->faker->numberBetween(10000000,99999999),
            'is_approved' => $this->faker->boolean(),
            'is_paid' => $this->faker->boolean(),
            'total_cost' => $this->faker->randomFloat(2, 50, 1000),
            'sent_status' => $this->faker->randomElement(['sent', 'failed']),
        ];
    }
}
