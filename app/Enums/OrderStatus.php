<?php

namespace App\Enums;

enum OrderStatus:string
{
    case PENDING = "PENDING";
    case PAYED = "PAYED";
    case CANCELED = "CANCELED";
}
