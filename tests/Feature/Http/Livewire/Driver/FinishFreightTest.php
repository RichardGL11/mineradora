<?php

use App\Enums\FreightStatus;
use App\Models\Freight;
use App\Notifications\OrderDelivered;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\from;

test('driver should be able to finish a freight',function (){
    Queue::fake();
    Notification::fake();

    $costumer = \App\Models\User::factory()->create();
    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    $freight = Freight::factory()->create([
        'user_id' => $costumer->id,
        'driver_id' => $driver->id
    ]);
    actingAs($driver);
    from(route('freight.map',$freight))
    ->get(route('freights.driver.finish',$freight));

    $freight->refresh();
    expect($freight)
        ->status->toBe(FreightStatus::DONE);

    Notification::assertSentTo([$costumer], OrderDelivered::class);
    Notification::assertSentTo([$costumer], function (OrderDelivered $notification) use ($costumer,$freight) {
        return $notification->toMail($costumer)->subject == "Order number: {$freight->order->id}";
    });
});
