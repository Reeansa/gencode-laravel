<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'customer_id' => fake()->numberBetween(1, 10),
            // 'order_number' => fake()->unique()->numerify('LAR####'),
            // 'total_amount' => fake()->randomFloat(2, 50, 500),
            // 'payment_by' => fake()->randomElement(['bank transfer', 'negotiation']),
            // 'payment_status' => fake()->randomElement(['paid', 'unpaid']),
            // 'status' => fake()->randomElement(['pending', 'processing', 'completed', 'failed', 'canceled', 'refunded', 'negotiation']),
        ];
    }
}
