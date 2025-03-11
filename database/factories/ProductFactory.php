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
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => rand(1, 20),
            'image' => $this->faker->imageUrl(),
            'height' => rand(1, 3),
            'width' => rand(1, 3),
            'length' => rand(1, 3),
            'weight' => rand(1, 3),
        ];
    }
}
