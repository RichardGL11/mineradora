<?php

use App\Livewire\Driver\CreateDriver;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseHas;

it('should be able to register as a Driver', function () {

    Livewire::test(CreateDriver::class)
        ->set('name', 'Test User')
        ->assertSet('name', 'Test User')
        ->set('email', 'test@example.com')
        ->assertSet('email', 'test@example.com')
        ->set('cpf', '68089226086')
        ->assertSet('cpf', '68089226086')
        ->set('phone', '11111111111')
        ->assertSet('phone', '11111111111')
        ->set('password', 'password')
        ->assertSet('password', 'password')
        ->set('password_confirmation', 'password')
        ->assertSet('password_confirmation', 'password')
        ->call('register')
        ->assertHasNoErrors();
    assertDatabaseHas(\App\Models\User::class,[
        'name'      => 'Test User',
        'email'     => 'test@example.com',
        'cpf'       => '68089226086',
        'phone'     => '11111111111',
        'user_type' => \App\Enums\UserType::DRIVER
    ]);

    $this->assertAuthenticated();
});
