<?php

use App\Livewire\Freight\ListDriverFreigths;
use App\Models\Freight;
use Livewire\Livewire;

it('should  list all the freights that a driver has',function () {

    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    $freights = Freight::factory(10)->create(['driver_id' => $driver->id]);

    $component =Livewire::actingAs($driver)
        ->test(ListDriverFreigths::class)
        ->assertHasNoErrors();

    $freights->each(function ($freight) use ($component) {
        $component->assertSee($freight->id);
        $component->assertSee($freight->price);
        $component->assertSee($freight->products_price);
        $component->assertSee($freight->status);
    });
});
