<?php

namespace App\Http\Controllers;

use App\Services\Maps\GoogleMapsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __construct(protected GoogleMapsService $googleMapsService)
    {}

    public function generateRoute(Request $request): JsonResponse
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');

       return  $this->googleMapsService->generateRoute($origin, $destination);
    }

    public function show()
    {
        return view('map');
    }

}
