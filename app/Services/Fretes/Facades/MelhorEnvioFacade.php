<?php

namespace App\Services\Fretes\Facades;

use App\Services\Fretes\MelhorEnvio\MelhorEnvioService;
use Illuminate\Support\Facades\Facade;

class MelhorEnvioFacade extends Facade
{
    protected static function getFacadeAccessor():string
    {
       return  MelhorEnvioService::class;
    }
}
