<?php

namespace App\Services\Maps;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class GoogleMapsService
{
    protected PendingRequest $http;

    public function __construct()
    {
        $this->http =  $response = Http::withHeaders([
            'X-Goog-Api-Key' =>config('services.googleMaps.key'),
            'X-Goog-FieldMask' => 'routes.distanceMeters,routes.duration,routes.polyline.encodedPolyline',
            'Content-Type' => 'application/json',
        ]);
    }

    public function generateRoute(string $origin,string $destination): JsonResponse
    {
        $body = $this->generateBody($origin, $destination);

        $response = $this->http->post('https://routes.googleapis.com/directions/v2:computeRoutes', $body);
        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        }
        return response()->json(['error' => 'Erro ao obter a rota'], 500);
    }

    public function generateBody(string $origin,string $destination):array
    {
      return [
            'origin' => [
                'address'=>$origin,
            ],
            'destination' => [
                'address'=>$destination,
            ],
            'travelMode' => 'DRIVE',
            'routingPreference' => 'TRAFFIC_AWARE',
            'languageCode' => 'pt-BR',
            'units' => 'METRIC',
        ];
    }
}
