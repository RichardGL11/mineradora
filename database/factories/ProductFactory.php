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
            'price' => $this->faker->randomFloat(2, 1),
            'image' => $this->faker->imageUrl(),
            'height' => $this->faker->randomFloat(2, 1),
            'width' => $this->faker->randomFloat(2, 1),
            'length' => $this->faker->randomFloat(2, 1),
            'weight' => $this->faker->randomFloat(2, 1),
        ];
    }
}
