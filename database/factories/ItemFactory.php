<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(10000, 500000),
            'category_id' => \App\Models\Category::factory(), 
        ];
    }
}