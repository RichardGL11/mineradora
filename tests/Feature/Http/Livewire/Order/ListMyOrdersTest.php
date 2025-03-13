<?php

use App\Livewire\Orders\ListOrders;
use Livewire\Livewire;

it('should list all my orders', function () {
    $me = \App\Models\User::factory()->createOne();
    $another_user = \App\Models\User::factory()->createOne();
    $myOrders = \App\Models\Order::factory(10)->for($me)->create();
    $otherOrders = \App\Models\Order::factory(10)->for($another_user)->create();
   $livewire = Livewire::actingAs($me)
        ->test(ListOrders::class)
        ->assertHasNoErrors();

    $myOrders->each(function ($order) use ($livewire) {
        $livewire->assertSee($order->id);
        $livewire->assertSee($order->status);
        $livewire->assertSee($order->total);
        $livewire->assertSee(\Carbon\Carbon::make($order->created_at)->format('d/m/y H:m:s'));

    });

    $otherOrders->each(function ($order) use ($livewire) {
        $livewire->assertDontSee($order->id);
    });

});
test('if there is no orders then should see the text You dont have orders yet',function (){
    $livewire = Livewire::actingAs(\App\Models\User::factory()->createOne())
        ->test(ListOrders::class)
        ->assertHasNoErrors();
    $livewire->assertSee("You dont have orders yet");
});
