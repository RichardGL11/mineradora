<?php

namespace App\Services\Fretes\MelhorEnvio;

use App\Models\Product;
use App\Services\Fretes\Contracts\MelhorEnvioInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class MelhorEnvioService implements MelhorEnvioInterface
{
    private PendingRequest $http;
    private Collection|Product $products;

    private array $postalCodes;


    public function __construct()
    {
        $this->http = Http::withHeaders([
           'Content-Type'       => 'application/json',
           'Accept'             => 'application/json',
           'Authorization'      => 'Bearer '.env('MELHOR_ENVIO_KEY'),
           'User-Agent'         => 'Application '.  env('MELHOR_ENVIO_USER_AGENT')
        ]);
    }
    public function generateFrete()
    {
      $http =   $this->http
            ->post('https://www.melhorenvio.com.br/api/v2/me/shipment/calculate',
               $this->generateFreteBody()
            );

       $http->throw();
       return $http->json();

    }

    public function generateFreteBody():array
    {
        $productDetails = [];

        $this->products->each(function ($product) use (&$productDetails) {
            $productDetails[] = [
                "id" => $product->id,
                "width" => $product->width,
                "height" => $product->height,
                "length" => $product->length,
                "weight" => $product->weight,
                "insurance_value" => $product->price,
                "quantity" => 2
            ];
        });


        return [
            'from' => [
                'postal_code' => $this->postalCodes['from']['postal_code'],
            ],
            'to' => [
                'postal_code' => $this->postalCodes['to']['postal_code'],
            ],
            'products' => $productDetails,
        ];
    }
    public function setProduct(Collection|Product $product):self
    {
        $this->products = $product;
        return $this;
    }

    public function setPostalCodes(string $from, string $to):self
    {
        $this->postalCodes = [
            "from" => [
                "postal_code" => $from
        ],
            "to" => [
                "postal_code" => $to
            ],
        ];

        return $this;
    }
}
