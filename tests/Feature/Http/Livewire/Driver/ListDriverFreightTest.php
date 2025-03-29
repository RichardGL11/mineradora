<?php

use App\Livewire\Driver\ListDriverFreigths;
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

test('driver can not see freights that does not belong to himself', function () {
    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    $freights = Freight::factory(10)->create(['driver_id' => $driver->id]);
    $anotherDriver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);

    $component =Livewire::actingAs($anotherDriver)
        ->test(ListDriverFreigths::class)
        ->assertHasNoErrors();

    $freights->each(function ($freight) use ($component) {
        $component->assertDontSeeHtml("Freight id: {{$freight->id}}");
        $component->assertDontSee($freight->price);
        $component->assertDontSee($freight->products_price);
        $component->assertDontSee($freight->status);
    });
});
