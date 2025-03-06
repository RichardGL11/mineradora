<?php

use App\Livewire\Product\CreateProduct;
use App\Services\Fretes\Facades\MelhorEnvioFacade;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
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
     ->set('weight',10.5)
     ->assertset('weight',10.5)
     ->set('height',6.00)
     ->assertSet('height',6.00)
     ->set('length',30.00)
     ->assertSet('length',30.00)
     ->set('width',15.50)
     ->assertSet('width',15.50)
     ->call('save')
     ->assertHasNoErrors();

 assertDatabaseCount(Product::class, 1);
 assertDatabaseHas(Product::class, [
     'name'         => 'product',
     'description'  => 'description',
     'price'        => 100,
     'height'       => 6.00,
     'length'       => 30,
     'weight'       => 10.5,
     'width'        => 15.5,
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
    test('height field', function ($rule,$value){
        $image =  UploadedFile::fake()->image('image.jpg',100,100);
        Livewire::actingAs(User::factory()->create())
            ->test(CreateProduct::class)
            ->set('name','name')
            ->assertSet('name','name')
            ->set('description','description')
            ->assertSet('description','description')
            ->set('price', 100)
            ->set('image',$image)
            ->set('height',$value)
            ->call('save')
            ->assertHasErrors(['height' => $rule]);
    })->with([
        'required'          => ['required', ''],
        'numeric'           => ['numeric','aa'],
        'greater than 0'    => ['gt:0',-1],
    ]);
    test('length field', function ($rule,$value){
        $image =  UploadedFile::fake()->image('image.jpg',100,100);
        Livewire::actingAs(User::factory()->create())
            ->test(CreateProduct::class)
            ->set('name','name')
            ->assertSet('name','name')
            ->set('description','description')
            ->assertSet('description','description')
            ->set('price', 100)
            ->set('image',$image)
            ->set('height',50)
            ->set('length',$value)
            ->call('save')
            ->assertHasErrors(['length' => $rule]);
    })->with([
        'required'          => ['required', ''],
        'numeric'           => ['numeric','aa'],
        'greater than 0'    => ['gt:0',-1],
    ]);

    test('Width field', function ($rule,$value){
        $image =  UploadedFile::fake()->image('image.jpg',100,100);
        Livewire::actingAs(User::factory()->create())
            ->test(CreateProduct::class)
            ->set('name','name')
            ->assertSet('name','name')
            ->set('description','description')
            ->assertSet('description','description')
            ->set('price', 100)
            ->set('image',$image)
            ->set('height',50)
            ->set('length',198)
            ->set('width',$value)
            ->call('save')
            ->assertHasErrors(['width' => $rule]);
    })->with([
        'required'          => ['required', ''],
        'numeric'           => ['numeric','aa'],
        'greater than 0'    => ['gt:0',-1],
    ]);
test('weight field', function ($rule,$value){
        $image =  UploadedFile::fake()->image('image.jpg',100,100);
        Livewire::actingAs(User::factory()->create())
            ->test(CreateProduct::class)
            ->set('name','name')
            ->assertSet('name','name')
            ->set('description','description')
            ->assertSet('description','description')
            ->set('price', 100)
            ->set('image',$image)
            ->set('height',50)
            ->set('length',198)
            ->set('width',100)
            ->set('weight',$value)
            ->call('save')
            ->assertHasErrors(['weight' => $rule]);
    })->with([
        'required'          => ['required', ''],
        'numeric'           => ['numeric','aa'],
        'greater than 0'    => ['gt:0',-1],
    ]);

});
