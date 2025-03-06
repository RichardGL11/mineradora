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


test('fake test', function () {


//    MelhorEnvioFacade::setPostalCodes('96020360','01018020')
//        ->setProduct(Product::factory(10)->create(['price' => 5]))
//        ->generateFrete()
//    ;

   $http =  \Illuminate\Support\Facades\Http::withHeaders([
        'Content-Type'       => 'application/json',
        'Accept'             => 'application/json',
        'Authorization'      => 'Bearer '.env('MELHOR_ENVIO_KEY'),
        'User-Agent'         => env('MELHOR_ENVIO_USER_AGENT')
    ])
    ->post('https://www.melhorenvio.com.br/api/v2/me/shipment/calculate',[
            "from" => [
                "postal_code" => "96020360"
            ],
            "to" => [
                "postal_code" => "01018020"
            ],
            "products" => [
                [
                    "id" => "1",
                    "width" => 11,
                    "height" => 17,
                    "length" => 11,
                    "weight" => 0.3,
                    "insurance_value" => 10.1,
                    "quantity" => 1
                ],
                [
                    "id" => "2",
                    "width" => 16,
                    "height" => 25,
                    "length" => 11,
                    "weight" => 0.3,
                    "insurance_value" => 55.05,
                    "quantity" => 2
                ],
                [
                    "id" => "3",
                    "width" => 22,
                    "height" => 30,
                    "length" => 11,
                    "weight" => 1,
                    "insurance_value" => 30,
                    "quantity" => 1
                ]
            ]
        ])->json();
   dd($http);
});
