<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
{{-- <style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    #map { height: 600px; width: 100%; }
    h3 { text-align: center; padding: 10px; background: #007BFF; color: white; margin: 0; }
</style> --}}
<style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        #map { height: 600px; width: 100%; }
        h3 {
            text-align: center;
            background: #007BFF;
            color: white;
            padding: 10px;
            margin: 0;
            font-size: 20px;
        }
    </style>
{{-- <h3>Mapa de Conexiones Activas por Manzana</h3>
<div id="map"></div> --}}
{{-- <div class="col-lg-4 mt-2">
    <h3>Mapa de Conexiones Activas por Manzana</h3>
    <div id="map"></div>
</div> --}}
<div class="col-lg-12 mt-2">
    <div class="card shadow-sm">
        <div class="card-body">
            {{-- <h3>Mapa de Conexiones Activas por Manzana</h3> --}}
            <h5 class="card-title text-center text-primary fw-bold">Mapa de Conexiones Activas por Manzana</h5>
            <div id="map"></div>
        </div>
    </div>
</div>

{{--
<script>
    // Inicializar el mapa en Abancay
    var map = L.map('map').setView([-13.636, -72.881], 14);

    // Agregar capa base de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Recibir datos desde Laravel (controlador)
    let data = @json($data);

    // Mostrar puntos por cada manzana
    data.forEach(item => {
        // Si no tienes coordenadas, esto genera una ubicación aleatoria
        let lat = -13.636 + Math.random() * 0.01;
        let lon = -72.881 + Math.random() * 0.01;

        L.circleMarker([lat, lon], {
            radius: 8,
            fillColor: "#007BFF",
            color: "#000",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.7
        })
        .bindPopup(`<b>Manzana:</b> ${item.u5}<br><b>Conexiones activas:</b> ${item.total}`)
        .addTo(map);
    });
</script> --}}
<script>
    // Inicializar el mapa centrado en Abancay
    var map = L.map('map').setView([-13.637, -72.881], 15);

    // Capa base
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Datos simulados enviados desde Laravel
    const dataCoordenadas = @json($data);

    // Dibujar los puntos en el mapa
    dataCoordenadas.forEach(item => {
        L.circleMarker([item.latitud, item.longitud], {
            radius: 8 + (item.total / 5),
            fillColor: "#007BFF",
            color: "#000",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        })
        .bindPopup(`
            <b>Manzana:</b> ${item.manzana}<br>
            <b>Conexiones activas:</b> ${item.total}<br>
            <b>Lat:</b> ${item.latitud}<br>
            <b>Lon:</b> ${item.longitud}
        `)
        .addTo(map);
    });
</script>
