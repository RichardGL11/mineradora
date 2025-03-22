<?php

namespace Database\Factories;

use App\Enums\FreightStatus;
use App\Models\Freight;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Freight>
 */
class FreightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'        => User::factory(),
            'order_id'       => Order::factory(),
            'products_price' => 0,
            'price'          => rand(1,1000),
            'status'         => FreightStatus::TRANSIT->value,
        ];
    }

    public function configure():self
    {
        return $this->afterCreating(function (Freight $freight) {
            $freight->products_price = $freight->order->price;
            $freight->save();
        });
    }
}
