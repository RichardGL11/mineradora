<?php

namespace App\Actions\Driver;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateDriverAction
{
    public static function execute(string $name, string $email, string $password,string $phone,string $cpf):User
    {
        return User::query()->create([
            'name' => $name,
            'email' => $email,
            'user_type' => UserType::DRIVER->value,
            'password' => Hash::make($password),
            'phone' => $phone,
            'cpf' => $cpf,
        ]);
    }
}
