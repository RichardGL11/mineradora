<?php

namespace App\Livewire\Admin\Maps;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

class GenerateRouteMap extends Component
{
    public $origin = '';
    public $destination = '';
    public $routeData = null;
    public $error = null;

    // Função para calcular a rota
    public function computeRoute()
    {
        $apikey = env('GOOGLE_API_KEY');
        $this->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
        ]);

        // Pega as coordenadas de origem e destino
        $origin = $this->origin;
        $destination = $this->destination;

        // Fazendo a requisição à API do Google Maps para calcular a rota
        $response = Http::withHeaders([
            'X-Goog-Api-Key' => $apikey,
            'X-Goog-FieldMask' => 'routes.duration,routes.distanceMeters,routes.polyline.encodedPolyline',
        ])->post('https://routes.googleapis.com/directions/v2:computeRoutes', [
            'origin' => [
                'location' => [
                    'latLng' => $this->parseCoordinates($origin),
                ],
            ],
            'destination' => [
                'location' => [
                    'latLng' => $this->parseCoordinates($destination),
                ],
            ],
            'travelMode' => 'DRIVE',
            'routingPreference' => 'TRAFFIC_AWARE',
        ]);

        // Verificando a resposta da API
        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['routes'][0]['polyline']['encodedPolyline'])) {
                $this->routeData = [
                    'encodedPolyline' => $data['routes'][0]['polyline']['encodedPolyline'],
                    'duration' => $data['routes'][0]['duration'],
                    'distance' => $data['routes'][0]['distanceMeters'],
                ];
                $this->error = null; // Limpa erros anteriores
            } else {
                $this->error = 'Não foi possível calcular a rota.';
            }
        } else {
            $this->error = 'Erro ao tentar calcular a rota.';
        }
    }

    // Função para transformar coordenadas de string para array
    private function parseCoordinates($coordinates)
    {
        $coords = explode(',', $coordinates);
        return [
            'latitude' => floatval(trim($coords[0])),
            'longitude' => floatval(trim($coords[1])),
        ];
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.maps.generate-route-map');
    }
}
