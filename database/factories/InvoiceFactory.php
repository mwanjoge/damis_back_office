<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
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
            'request_id' => \App\Models\Request::factory(),
            'member_id' => \App\Models\Member::factory(),
            'invoice_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'customer_name' => $this->faker->name(),
            'ref_no' => $this->faker->unique()->numerify('INV-####'),
            'status' => $this->faker->randomElement(['pending','paid','cancelled','overdue']),
            'sent_status' => $this->faker->randomElement(['sent','failed']),
            'is_paid' => $this->faker->boolean(),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'payable_amount' => $this->faker->randomFloat(2, 100, 5000),
            'balance' => $this->faker->randomFloat(2, 0, 1000),
            'paid' => $this->faker->randomFloat(2, 0, 5000),
        ];
    }
}
