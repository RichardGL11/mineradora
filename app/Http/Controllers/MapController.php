<?php

namespace App\Http\Controllers;

use App\Models\Freight;
use App\Services\Maps\GoogleMapsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __construct(protected GoogleMapsService $googleMapsService)
    {}

    public function generateRoute(Request $request): JsonResponse
    {
        $origin ='Fatec São Caetano do Sul';
        $destination = $request->input('destination');

       return  $this->googleMapsService->generateRoute($origin, $destination);
    }

    public function show(Freight $freight)
    {
        return view('map',['freight' => $freight]);
    }

}
