<?php

use App\Livewire\Freight\ListFreight;
use App\Models\Freight;
use App\Models\User;
use App\Enums\UserType;
use Livewire\Livewire;

test('As a Driver should be able to see Freight',function (){

   $freight = Freight::factory(10)->create();
   $component = Livewire::actingAs(User::factory()->create(['user_type' => UserType::DRIVER->value]))
        ->test(ListFreight::class);

   $freight->each(function ($freight) use ($component){
       $component->assertSee($freight->id);
       $component->assertSee($freight->price);
       $component->assertSee($freight->products_price);
       $component->assertSee($freight->status);
   });
});
