<?php

namespace App\Services\PaymentGateway\Facades;

use App\Services\PaymentGateway\AbacatePay\AbacatePayService;
use Illuminate\Support\Facades\Facade;

class AbacatePayFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
       return AbacatePayService::class;
    }
}
