<?php

use App\Models\Address;
use App\Models\Freight;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\actingAs;

it('should return an encoded polyline',function (){
   Http::fake([
       'https://routes.googleapis.com/directions/v2:computeRoutes' => Http::response([
           [
               "routes" => [
                   [
                       "distanceMeters" => 6930,
                       "duration" => "1119s",
                       "polyline" => [
                           "encodedPolyline" => "bpdoCjre{G{@@BaCIw[A_FPGmCgF}@wALSCSMMYC}AaDwB}DnJgGvc@qYtBoA`@GT@vAXl@?\GXKtAw@vAe@bOwHlZmO`TyKvU{LdEsBd[aPzDqBp\{PBJpDiB`@~BBl@NNXBTIDGo@wB@YH[RSjDeBtAs@`Cw@|@QNClE`BfDvATAnEjB|EhBfARj@H"
                       ]
                   ]
               ]
           ],
   ])]);


   $admin = \App\Models\User::factory()->admin()->create();
   Address::factory()->for($admin)->create();
   actingAs($admin);
   $freight = Freight::factory()->createOne();
   $response =  \Pest\Laravel\post(route('generate.map.admin',$freight),[
      'to' => $admin->id
   ]);

  $response->assertJsonFragment([  "routes" => [
      [
          "distanceMeters" => 6930,
          "duration" => "1119s",
          "polyline" => [
              "encodedPolyline" => "bpdoCjre{G{@@BaCIw[A_FPGmCgF}@wALSCSMMYC}AaDwB}DnJgGvc@qYtBoA`@GT@vAXl@?\GXKtAw@vAe@bOwHlZmO`TyKvU{LdEsBd[aPzDqBp\{PBJpDiB`@~BBl@NNXBTIDGo@wB@YH[RSjDeBtAs@`Cw@|@QNClE`BfDvATAnEjB|EhBfARj@H"
          ]
      ]
  ]]);

});

it('should return error 500', function () {
    Http::fake([
        'https://routes.googleapis.com/directions/v2:computeRoutes' => Http::response([
            'error' => 'Erro ao obter a rota'
        ],500)
    ]);
    $admin = \App\Models\User::factory()->admin()->create();
    Address::factory()->for($admin)->create();
    actingAs($admin);
    $freight = Freight::factory()->createOne();
    $response =  \Pest\Laravel\post(route('generate.map.admin',$freight),[
        'to' => $admin->id
    ]);

    $response->assertJsonFragment(['error' => 'Erro ao obter a rota']);
    $response->assertStatus(500);
});
