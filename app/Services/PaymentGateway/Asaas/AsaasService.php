<?php

namespace App\Services\PaymentGateway\Asaas;

use App\Models\Wallet;
use App\Services\PaymentGateway\Asaas\Enums\PixKeyTypeEnum;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class AsaasService
{
    private readonly PendingRequest $http;
    private readonly PixKeyTypeEnum $pixType;
    public function __construct()
    {
        $this->http = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Access_token' => '$aact_hmlg_000MzkwODA2MWY2OGM3MWRlMDU2NWM3MzJlNzZmNGZhZGY6OjdmMmE0NGY5LWFlMjctNDhlZi1iYzQ4LTA4OTY1Y2Y0MGMxNTo6JGFhY2hfZWRhMWQwMjYtY2JhOC00NGZjLThiZmItZmI4NGE4MGFiZDA2'
        ]);
    }

    public function payPix(PixKeyTypeEnum $pixType,int $value, Wallet $wallet, mixed $key): PromiseInterface|Response
    {
        $this->setPixType(pixType: $pixType);
        $url = 'https://api-sandbox.asaas.com/v3/transfers';

          return  $this->http->post($url, [
                "value" => $value,
                "pixAddressKey" => $key,
                "pixAddressKeyType" => $this->pixType,
                "externalReference" => "Wallet_id: {$wallet->id}"
            ])->throw();
    }
    private function setPixType(PixKeyTypeEnum $pixType): void
    {
        $this->pixType = $pixType;
    }
}
