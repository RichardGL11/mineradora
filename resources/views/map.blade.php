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
<h1>Rota de Carro</h1>

<div id="controls" class="flex items-end justify-between px-4 py-2 bg-gray-900">
    <button class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none" onclick="computeRoute()">Calcular Rota</button>
    @if(auth()->user()->isDriver() === true and is_null($freight->driver_id))
            <a href="{{route('accept.freight',$freight)}}">
            <button class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none">Accept Freight</button>
            </a>
    @endif
</div>

<div id="map"></div>

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
