<?php

namespace App\Services\PaymentGateway\Asaas\Enums;

enum PixKeyTypeEnum:string
{
    case CPF = 'CPF';
    case CNPJ = 'CNPJ';
    case EMAIl = 'EMAIL';
    case PHONE = 'PHONE';
    case EVP = 'EVP';
}
