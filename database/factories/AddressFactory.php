<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'user_id'    => User::factory(),
                'CEP'        => '09070400',
                'neighborhood' => $this->faker->city(),
                'street'     => $this->faker->streetName(),
                'number'     => $this->faker->buildingNumber(),
                'city'       => $this->faker->city(),
                'state'      => 'MG',
                'complement' => 'casa 1',
        ];
    }
}
