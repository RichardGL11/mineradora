<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function create(User $user): Response
    {
        return $user->address()->exists()? Response::allow(): Response::deny(message: 'You need to register an address');
    }
}
