<?php

use App\Livewire\Address\CreateAddress;
use App\Models\Address;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('should be able to create an address for the user', function (){
    Http::fake([
        "https://viacep.com.br/ws/09070400/json/" => Http::response([
              "cep"          => "09070-400",
              "logradouro"   => "Travessa das Palmeiras",
              "complemento"  => "",
              "unidade"      => "",
              "bairro"       => "Campestre",
              "localidade"   => "Santo André",
              "uf"           => "SP",
              "estado"       => "São Paulo",
              "regiao"       => "Sudeste",
              "ibge"         => "3547809",
              "gia"          => "6269",
              "ddd"          => "11",
              "siafi"        => "7057",
        ])
    ]);

    $user= \App\Models\User::factory()->create();
    Livewire::actingAs($user)
        ->test(CreateAddress::class)
        ->set('cep','09070400')
        ->set('number','100')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseCount(Address::class,1);
    assertDatabaseHas(Address::class,[
        'cep' => '09070400',
        'street' => 'Travessa das Palmeiras',
        'neighborhood' => 'Campestre',
        'city' => 'Santo André',
        'state' => 'SP',
        'number' => 100,
        'user_id' => $user->getKey()
    ]);
});
