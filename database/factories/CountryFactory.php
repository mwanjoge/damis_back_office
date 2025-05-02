<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->country(),
            'code' => $this->faker->countryCode(),
            'phone_code' => $this->faker->numerify('+###'),
            'embassy_id' => $this->faker->numberBetween(1, 43),
            'currency' => $this->faker->currencyCode(),
            'currency_code' => $this->faker->currencyCode(),
            'synced' => $this->faker->boolean(),
        ];
    }
}
