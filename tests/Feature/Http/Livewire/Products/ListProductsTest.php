<?php

use function Pest\Laravel\actingAs;

it('should see all the products in the dashboard', function () {
    $products = \App\Models\Product::factory()->count(10)->create();
    actingAs(\App\Models\User::factory()->createOne());
    $response =  \Pest\Laravel\get('/dashboard');

    $response->assertStatus(200);
    $products->each(function ($product) use ($response) {
          $response->assertSee($product->name);
          $response->assertSee($product->price);
          $response->assertSee($product->description);
          $response->assertSee($product->image);
    });
});
