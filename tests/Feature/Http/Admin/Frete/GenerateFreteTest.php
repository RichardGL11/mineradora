<?php

use App\Enums\FreightStatus;
use App\Livewire\Admin\Frete\GenerateFrete;
use App\Models\Freight;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use App\Models\Order;
use App\Models\Product;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    Http::fake([
        'https://www.melhorenvio.com.br/api/v2/me/shipment/calculate' => Http::response([
            '0' =>[
                "id" => 34,
                "name" => "Loggi Ponto",
                "price" => "180.86",
                "custom_price" => "180.86",
                "discount" => "0.00",
                "currency" => "R$",
                "delivery_time" => 4,
                "delivery_range" =>  [
                    "min" => 3,
                    "max" => 4
                ],
                "custom_delivery_time" => 4,
                "custom_delivery_range" => [
                    "min" => 3,
                    "max" => 4,
                ],
                "packages" => [
                    0 =>[
                        "price" => "132.48",
                        "discount" => "0.00",
                        "format" => "box",
                        "weight" => "30.00",
                        "insurance_value" => "858.20",
                        "products" =>[
                            0 =>[
                                "id" => "66",
                                "quantity" => 4
                            ],
                            1 =>[
                                "id" => "67",
                                "quantity" => 4
                            ],
                            2 =>[
                                "id" => "68",
                                "quantity" => 4
                            ],
                            3 =>[
                                "id" => "69",
                                "quantity" => 2
                            ]
                        ],
                        "dimensions" => [
                            "height" => 4,
                            "width" => 10,
                            "length" => 15
                        ]
                    ]
                ]
            ]
        ])]);
});

it('should see the freight options',function (){

    $order =  Order::factory()
        ->hasAttached(
            Product::factory()->count(5),
            ['quantity' => rand(1,20),]
        )
        ->create();
    $livewire = Livewire::actingAs(\App\Models\User::factory()->admin()->create())
        ->test(GenerateFrete::class, ['order' => $order])
        ->call('generateFrete');

    $livewire->assertSee('Loggi Ponto');
    $livewire->assertSee('Price R$:180.86');
    $livewire->assertSee('Price With Discount R$:0.00');

});

it('should be able to create a Freight for a Order', function () {
   $user = \App\Models\User::factory()->create();
    $order =  Order::factory()
        ->hasAttached(
            Product::factory()->count(5),
            ['quantity' => rand(1,20),]
        )
        ->create(['user_id'=>$user->id]);

    $livewire = Livewire::actingAs(\App\Models\User::factory()->admin()->create())
        ->test(GenerateFrete::class, ['order' => $order])
        ->call('generateFrete');

    $livewire->assertSee('Loggi Ponto');
    $livewire->assertSee('Price R$:180.86');
    $livewire->assertSee('Price With Discount R$:0.00');
    $livewire->call('createFreteOrder','180.86');

    assertDatabaseCount(Freight::class, 1);
    assertDatabaseHas(Freight::class, [
        'user_id'        => $user->id,
        'order_id'       => $order->id,
        'status'         => FreightStatus::TRANSIT,
        'price'          => '180.86',
        'products_price' =>$order->total
    ]);
});

