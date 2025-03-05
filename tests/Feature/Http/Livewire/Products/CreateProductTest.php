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

describe('validation tests', function () {
    test('name field', function ($rule,$value){
        $image =  UploadedFile::fake()->image('image.jpg',100,100);
        Livewire::actingAs(User::factory()->create())
            ->test(CreateProduct::class)
            ->set('name',$value)
            ->set('description','description')
            ->assertSet('description','description')
            ->set('price', '100.00')
            ->assertSet('price', '100.00')
            ->set('image',$image)
            ->call('save')
            ->assertHasErrors(['name' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min'      => ['min:3','aa'],
        'max'      => ['max:255',str_repeat('a',256)],
    ]);
    test('description field', function ($rule,$value){
        $image =  UploadedFile::fake()->image('image.jpg',100,100);
        Livewire::actingAs(User::factory()->create())
            ->test(CreateProduct::class)
            ->set('name','name')
            ->assertSet('name','name')
            ->set('description',$value)
            ->set('price', '100.00')
            ->assertSet('price', '100.00')
            ->set('image',$image)
            ->call('save')
            ->assertHasErrors(['description' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min'      => ['min:3','aa'],
        'max'      => ['max:255',str_repeat('a',256)],
    ]);

    test('price field', function ($rule,$value){
        $image =  UploadedFile::fake()->image('image.jpg',100,100);
        Livewire::actingAs(User::factory()->create())
            ->test(CreateProduct::class)
            ->set('name','name')
            ->assertSet('name','name')
            ->set('description','description')
            ->assertSet('description','description')
            ->set('price', $value)
            ->set('image',$image)
            ->call('save')
            ->assertHasErrors(['price' => $rule]);
    })->with([
        'required'          => ['required', ''],
        'numeric'           => ['numeric','aa'],
        'greater than 0'    => ['gt:0',-1],
    ]);

    test('image field', function ($rule,$value){
        Livewire::actingAs(User::factory()->create())
            ->test(CreateProduct::class)
            ->set('name','name')
            ->assertSet('name','name')
            ->set('description','description')
            ->assertSet('description','description')
            ->set('price', '100.00')
            ->assertSet('price', '100.00')
            ->set('image',$value)
            ->call('save')
            ->assertHasErrors(['image' => $rule]);
    })->with([
        'file'       => ['file', 'notafile'],
        'mimes'      => ['mimes','something.svg'],
    ]);
});
