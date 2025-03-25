<?php

use App\Models\Freight;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\from;

test('a Driver can take a Freight', function () {
    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    $freight = Freight::factory()->create();
    actingAs($driver);
    from(route('freight.map',$freight))
    ->post(route('accept.freight',$freight))
    ->assertRedirect(route('freights.driver'));

    assertDatabaseHas(Freight::class, [
        'order_id' => $freight->order_id,
        'driver_id'=> $driver->id,
    ]);
    $freight->refresh();
    expect($freight->driver->id)->toBe($driver->id);
});
