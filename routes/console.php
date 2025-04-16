<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Artisan::command('play', function () {

    $http = app(\App\Services\PaymentGateway\Asaas\AsaasService::class)->payPix(\App\Services\PaymentGateway\Asaas\Enums\PixKeyTypeEnum::EMAIl,2);
    dd($http->json());

});
