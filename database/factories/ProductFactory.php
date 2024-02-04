<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 12),
            'name' => fake()->sentence(2),
            'description' => fake()->paragraphs(2, true),
            'price' => fake()->numberBetween(100000, 1000000),
            'sales' => fake()->numberBetween(0, 100),
            'is_new' => fake()->boolean() ? 1 : 0,
            'new_until' => fake()->dateTimeBetween('-1 week', '+1 week'),
        ];
    }
}
