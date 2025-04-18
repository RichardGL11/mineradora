<?php

use App\Models\Freight;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\from;

test('a Driver can take a Freight', function () {
    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    $freight = Freight::factory()->create();
    actingAs($driver);
    from(route('freight.map',$freight))
    ->get(route('accept.freight',$freight))
    ->assertRedirect(route('freights.driver'));

    assertDatabaseHas(Freight::class, [
        'order_id' => $freight->order_id,
        'driver_id'=> $driver->id,
    ]);
    $freight->refresh();
    expect($freight->driver->id)->toBe($driver->id);
});

test('after a driver was assigned to the freight, nobody cant see the accept button anymore', function () {
    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    $freight = Freight::factory()->create();
    actingAs($driver);
    from(route('freight.map',$freight))
        ->get(route('accept.freight',$freight))
        ->assertRedirect(route('freights.driver'));

    assertDatabaseHas(Freight::class, [
        'order_id' => $freight->order_id,
        'driver_id'=> $driver->id,
    ]);
    $freight->refresh();
    expect($freight->driver->id)->toBe($driver->id);

  $freightMap = \Pest\Laravel\get(route('freight.map',$freight));
  $freightMap->assertDontSee('Accept Freight');
});
test('if a driver has an active freight he cannot accept another one ', function () {
    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    $Activefreight = Freight::factory()->create(['driver_id' => $driver->id]);
    $freight  = Freight::factory()->create();
    actingAs($driver);
    from(route('freight.map',$freight))
        ->get(route('accept.freight',$freight))
        ->assertRedirect(route('freights.driver'));

    assertDatabaseMissing(Freight::class, [
        'order_id' => $freight->order_id,
        'driver_id'=> $driver->id,
    ]);
    expect($freight->driver)->toBeNull();
});
