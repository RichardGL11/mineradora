<?php

namespace Database\Factories;

use App\Enums\UserType;
use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'cpf' => $this->getCPF(),
            'phone' => $this->getPhone(),
            'user_type' => UserType::USER->value,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => UserType::ADMIN->value,
        ]);
    }
    public function getCPF()
    {
        $this->fakerBr = \Faker\Factory::create('pt_br');
        return $this->fakerBr->cpf();
    }

    public function getPhone()
    {
        $this->fakerBr = \Faker\Factory::create('pt_br');
        return $this->fakerBr->phoneNumber();
    }
    public function configure(): self
    {
        return $this->afterCreating(function (User $user) {
            Address::factory()->for($user)->create();
        });
    }
}
