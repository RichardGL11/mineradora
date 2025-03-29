<?php

use App\Models\Freight;
use App\Models\Wallet;
use Illuminate\Support\Facades\Event;
use function Pest\Laravel\actingAs;

test('after a client confirm that he received the order, the drivers wallet amount should be updated', function () {
    $costumer = \App\Models\User::factory()->createOne();
    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    $wallet = Wallet::factory()->create([
        'driver_id' => $driver->id,
        'amount' => 0
    ]);
    $freight = Freight::factory()->create([
        'user_id' => $costumer->id,
        'driver_id' => $driver->id
    ]);
    actingAs($costumer);
    \Pest\Laravel\get(route('freights.finish.confirmation',$freight))
    ->assertRedirect('/dashboard');

    $wallet->refresh();
    expect((int)$wallet->amount)->toBe($freight->price);

});
