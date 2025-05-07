<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestItem>
 */
class RequestItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'request_id' => \App\Models\Request::factory(),
            'service_id' => \App\Models\Service::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            // Add other fields as needed, e.g.:
            // 'description' => $this->faker->sentence(),
        ];
    }
}
