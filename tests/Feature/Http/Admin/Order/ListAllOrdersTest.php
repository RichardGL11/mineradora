<?php

use function Pest\Laravel\actingAs;

test('normal users cant see all the orders that have been placed', function () {

    actingAs(\App\Models\User::factory()->create());
    $request = \Pest\Laravel\get(route('orders.list.admin'));
    $request->assertStatus(403);
});

test('only administrators can see all the orders that have been placed', function () {

    actingAs(\App\Models\User::factory()->admin()->create());
    $request = \Pest\Laravel\get(route('orders.list.admin'));
    $request->assertStatus(200);

});
