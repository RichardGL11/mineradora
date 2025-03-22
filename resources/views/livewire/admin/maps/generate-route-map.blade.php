<div>
    <h1>Rota de Carro</h1>

    <!-- Formulário para inserir as coordenadas -->
    <div id="controls">
        <label for="origin">Origem (Latitude, Longitude):</label><br>
        <input type="text" id="origin" wire:model="origin" placeholder="Ex: 37.419734,-122.0827784"><br><br>
        <label for="destination">Destino (Latitude, Longitude):</label><br>
        <input type="text" id="destination" wire:model="destination" placeholder="Ex: 37.417670,-122.079595"><br><br>
        <button wire:click="computeRoute">Calcular Rota</button>
    </div>

    <!-- Exibe as informações da rota -->
    @if($routeData)
        <div>
            <p><strong>Distância:</strong> {{ $routeData['distance'] }} metros</p>
            <p><strong>Duração:</strong> {{ $routeData['duration'] }} segundos</p>
        </div>

        <!-- Mapa -->
        <div id="map" style="height: 500px; width: 100%;"></div>

        <!-- Script para inicializar o mapa -->
        <script>
            // Função initMap para inicializar o mapa
            window.initMap = function() {
                console.log("initMap foi chamado!");
                const mapElement = document.getElementById("map");
                const routeData = @json($routeData); // Passa a rota para o JS

                // Inicializa o mapa
                const map = new google.maps.Map(mapElement, {
                    zoom: 14,
                    center: { lat: 37.419734, lng: -122.0827784 }, // Posição inicial
                });

                // Configuração do DirectionsRenderer
                const directionsRenderer = new google.maps.DirectionsRenderer({
                    map: map,
                });

                // Serviço de direções
                const directionsService = new google.maps.DirectionsService();

                // Decodificando a polyline
                const encodedPolyline = routeData.encodedPolyline;
                const route = decodePolyline(encodedPolyline);

                const routePath = new google.maps.Polyline({
                    path: route,
                    geodesic: true,
                    strokeColor: "#FF0000",
                    strokeOpacity: 1.0,
                    strokeWeight: 2,
                });

                routePath.setMap(map);
                map.setCenter(route[0]); // Centraliza no ponto inicial da rota
            };

            // Função para decodificar a polyline
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

            // Função que carrega o script do Google Maps e chama initMap
            function loadGoogleMapsScript() {
                const script = document.createElement("script");
                script.src = "https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=places&callback=initMap";
                script.async = true;
                script.defer = true;
                document.body.appendChild(script);
            }

            // Carregar o Google Maps
            window.onload = loadGoogleMapsScript;
        </script>
    @endif
</div>
