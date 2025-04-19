<x-app-layout>
    <title>Rota no Mapa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=places&callback=initMap" async defer></script>
    <style>

        #map {
            height: 100vh;
            width: 100%;
        }


    </style>
    <main class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Coluna 1: Informações de Contato -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Informações de Contato</h2>
                    <div class="space-y-4">

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-800 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Endereço</h3>
                                <p class="text-gray-600">
                                   {{$freight->user->address->first()->street}}<br>
                                    {{$freight->user->address->first()->neighborhood}}<br>
                                    {{$freight->user->address->first()->city}} - {{$freight->user->address->first()->state}}<br>
                                    CEP: {{$freight->user->address->first()->CEP}}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-800 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Telefone</h3>
                                <p class="text-gray-600">{{$freight->user->phone}}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-800 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">E-mail</h3>
                                <p class="text-gray-600">{{$freight->user->email}}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                        </div>

                    </div>
                </div>
            </div>

            <!-- Coluna 2: Como Chegar + Controles -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">

                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800">Como Chegar</h2>
                    </div>

                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Calcule sua Rota</h3>
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="md:self-end">
                                <button onclick="computeRoute()" id="calcular-rota" class="w-full bg-accent bg-amber-600 text-white font-bold py-3 px-6 rounded-md transition duration-300 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                    Calcular Rota
                                </button>
                            </div>
                        </div>
                    </div>
                        @if(auth()->user()->isDriver() === true and is_null($freight->driver_id))
                            <a href="{{route('accept.freight',$freight)}}">
                                <button class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none">Accept Freight</button>
                            </a>
                        @endif

                        @if($freight->driver_id === auth()->user()->id)
                            <a href="{{route('freights.driver.finish',$freight)}}">
                                <button class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none">Mark as Done</button>
                            </a>
                        @endif

                    <div id="map"></div>
                </div>
            </div>

        </div>
    </main>



    <script>
    let map;
    let directionsRenderer;
    let directionsService;

    // Inicializar o mapa
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: { lat: -23.5503, lng:  -46.6339 }, // Posição de SP
        });

        directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
        });

        directionsService = new google.maps.DirectionsService();
    }

    function computeRoute() {
        const to = {{$freight->user->id}}
        fetch('/generate-map/{{$freight}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                to: to,
              }),
        })
            .then(response => response.json())
            .then(data => {

                if (data.routes && data.routes.length > 0) {
                    const route = data.routes[0];
                    const encodedPolyline = route.polyline.encodedPolyline;
                    const routePath = decodePolyline(encodedPolyline);

                    const polyline = new google.maps.Polyline({
                        path: routePath,
                        geodesic: true,
                        strokeColor: "#FF0000",
                        strokeOpacity: 1.0,
                        strokeWeight: 2,
                    });

                    polyline.setMap(map);
                    map.setCenter(routePath[0]);
                } else {
                    console.error('Nenhuma rota encontrada');
                }
            })
            .catch(error => {
                console.error('Erro ao obter a rota:', error);
            });
    }

    function decodePolyline(encoded) {
        let points = [];
        let index = 0;
        let lat = 0;
        let lng = 0;

        while (index < encoded.length) {
            let b, shift = 0, result = 0;
            do {
                b = encoded.charCodeAt(index++) - 63;
                result |= (b & 0x1f) << shift;
                shift += 5;
            } while (b >= 0x20);
            let deltaLat = ((result & 1) ? ~(result >> 1) : (result >> 1));
            lat += deltaLat;

            shift = 0;
            result = 0;
            do {
                b = encoded.charCodeAt(index++) - 63;
                result |= (b & 0x1f) << shift;
                shift += 5;
            } while (b >= 0x20);
            let deltaLng = ((result & 1) ? ~(result >> 1) : (result >> 1));
            lng += deltaLng;

            points.push(new google.maps.LatLng(lat / 1E5, lng / 1E5));
        }

        return points;
    }
</script>
</x-app-layout>
