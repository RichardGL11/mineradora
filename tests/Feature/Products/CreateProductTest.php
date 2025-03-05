<?php

use App\Livewire\Product\CreateProduct;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use App\Models\User;
use App\Models\Product;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('should create a product', function () {
$image =  UploadedFile::fake()->image('image.jpg',100,100);
 Livewire::actingAs(User::factory()->create())
     ->test(CreateProduct::class)
     ->set('name','product')
     ->assertSet('name','product')
     ->set('description','description')
     ->assertSet('description','description')
     ->set('price', '100.00')
     ->assertSet('price', '100.00')
     ->set('image',$image)
     ->call('save')
     ->assertHasNoErrors();

 assertDatabaseCount(Product::class, 1);
 assertDatabaseHas(Product::class, [
     'name'         => 'product',
     'description'  => 'description',
     'price'        => 100,
 ]);

});

