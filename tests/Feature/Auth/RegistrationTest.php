<?php

namespace Tests\Feature\Auth;

use Livewire\Volt\Volt;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response
        ->assertOk()
        ->assertSeeVolt('pages.auth.register');
});

test('new users can register', function () {
    $component = Volt::test('pages.auth.register')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('cpf', '68089226086')
        ->set('phone', '11111111111')
        ->set('password', 'password')
        ->set('password_confirmation', 'password');

    $component->call('register');

    $component->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});
test('validation cpf field', function ($rule, $value) {
    $component = Volt::test('pages.auth.register')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('cpf', $value)
        ->set('phone', '11111111111')
        ->set('password', 'password')
        ->set('password_confirmation', 'password');

    $component->call('register');
    $component->assertHasErrors(['cpf' =>$rule ]);
})->with([
    'CPF min'    => ['O CPF informado é inválido precisa ter exatos 11 caracteres.', 123],
    'CPF repeat' => ['O CPF informado é inválido seus números não podem ser todos iguais.','99999999999'],
    'CPF valid' =>  ['O CPF informado é inválido.','99991233459'],
]);
