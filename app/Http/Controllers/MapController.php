<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Freight;
use App\Services\Maps\GoogleMapsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MapController extends Controller
{
    public function __construct(protected GoogleMapsService $googleMapsService)
    {}

    public function generateRoute(Request $request): JsonResponse
    {
        $origin = env('originCEP');
        $address = Address::where('user_id','=', (int) $request->input('to'))->first();
       return  $this->googleMapsService->generateRoute((string)$origin,$address->CEP);
    }

    public function show(Freight $freight)
    {
        return view('map',['freight' => $freight]);
    }

}
