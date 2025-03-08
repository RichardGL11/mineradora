<?php

namespace App\Services\PaymentGateway\AbacatePay;

use App\Models\Product;
use App\Services\PaymentGateway\Contracts\PaymentGatewayInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class AbacatePayService implements PaymentGatewayInterface
{
    private PendingRequest $http;
    private Collection|Product $products;

    public function __construct()
    {
        $this->http = Http::withToken(config('services.abacatePay.key'));
    }

    public function generatePix()
    {
        $http = $this->http
           ->post(config('services.abacatePay.url'),
               $this->generatePixBody()
           );
        return $http;
    }

    public function generatePixBody(): array
    {
        $productDetails = [];
        $this->products->each(function($product) use (&$productDetails) {
            $productDetails[] = [
                'externalId' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'quantity' => $product->quantity,
                'price' => (int)$product->price,
            ];

        });
        return [
            'frequency' => 'ONE_TIME',
            'methods' => ['PIX'],
            'products' => $productDetails,
            'returnUrl' => 'http://127.0.0.1:8000/rota',
            'completionUrl' => 'http://127.0.0.1:8000/deucerto',
            'customer' => [
                'name' => auth()->user()->name,
                'cellphone' => '1111111111',
                'email' => auth()->user()->email,
                'taxId' => '946.853.490-16',
            ],
        ];
    }

    public function setProduct(Collection|Product $product):self
    {
        $this->products = $product;

        return $this;
    }

}
