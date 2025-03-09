<?php

namespace App\Enums;

enum UserType:string
{
    case ADMIN = 'admin';
    case USER = 'user';
}
