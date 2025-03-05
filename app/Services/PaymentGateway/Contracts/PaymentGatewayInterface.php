<?php

namespace App\Services\PaymentGateway\Contracts;

interface PaymentGatewayInterface
{
    public function generatePix();
}
