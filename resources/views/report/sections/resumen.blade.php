<div class="row" id="resumen-conexiones">

    <!-- Conexiones registradas -->
    <div class="col-lg-6 mt-1">
        <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
            <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1">
                <i class="fa fa-edit"></i>
            </span>
            <div class="flex-grow-1">
                <span class="d-block text-muted text-uppercase small fw-bold">Conexiones registradas</span>
                <span id="registradas" class="d-block fs-4 fw-bold text-center">0</span>
            </div>
        </div>
    </div>

    <!-- Conexiones observadas -->
    <div class="col-lg-6 mt-1">
        <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
            <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1">
                <i class="fa fa-edit"></i>
            </span>
            <div class="flex-grow-1">
                <span class="d-block text-muted text-uppercase small fw-bold">Conexiones observadas</span>
                <span id="observadas" class="d-block fs-4 fw-bold text-center">0</span>
            </div>
        </div>
    </div>
    <!-- Tarifa doméstica -->
    <div class="col-lg-2 mt-1">
        <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
            <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1"><i class="fa fa-home"></i></span>
            <div class="flex-grow-1">
                <span class="d-block text-muted text-uppercase small fw-bold">Tarifa doméstica 17</span>
                <span id="tarifa_domestica_17" class="d-block fs-4 fw-bold text-center">0</span>
            </div>
        </div>
    </div>
    <!-- Tarifa doméstica -->
    <div class="col-lg-2 mt-1">
        <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
            <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1"><i class="fa fa-home"></i></span>
            <div class="flex-grow-1">
                <span class="d-block text-muted text-uppercase small fw-bold">Tarifa doméstica 18</span>
                <span id="tarifa_domestica_18" class="d-block fs-4 fw-bold text-center">0</span>
            </div>
        </div>
    </div>
    <!-- Tarifa comercial -->
    <div class="col-lg-2 mt-1">
        <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
            <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1"><i class="fa fa-store"></i></span>
            <div class="flex-grow-1">
                <span class="d-block text-muted text-uppercase small fw-bold">Tarifa comercial</span>
                <span id="tarifa_comercial" class="d-block fs-4 fw-bold text-center">0</span>
            </div>
        </div>
    </div>
    <!-- Tarifa industrial -->
    <div class="col-lg-2 mt-1">
        <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
            <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1"><i class="fa fa-industry"></i></span>
            <div class="flex-grow-1">
                <span class="d-block text-muted text-uppercase small fw-bold">Tarifa industrial</span>
                <span id="tarifa_industrial" class="d-block fs-4 fw-bold text-center">0</span>
            </div>
        </div>
    </div>
    <!-- Tarifa estatal -->
    <div class="col-lg-2 mt-1">
        <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
            <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1"><i class="fa fa-landmark"></i></span>
            <div class="flex-grow-1">
                <span class="d-block text-muted text-uppercase small fw-bold">Tarifa estatal</span>
                <span id="tarifa_estatal" class="d-block fs-4 fw-bold text-center">0</span>
            </div>
        </div>
    </div>
    <!-- Tarifa social -->
    <div class="col-lg-2 mt-1">
        <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
            <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1"><i class="fa fa-hand-holding-heart"></i></span>
            <div class="flex-grow-1">
                <span class="d-block text-muted text-uppercase small fw-bold">Tarifa social</span>
                <span id="tarifa_social" class="d-block fs-4 fw-bold text-center">0</span>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    function cargarResumen() {
        $.ajax({
            url: "{{ url('report/resumen') }}",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#registradas').text(data.registradas);
                $('#observadas').text(data.observadas);
                $('#tarifa_domestica_17').text(data.tarifa_domestica_17);
                $('#tarifa_domestica_18').text(data.tarifa_domestica_18);
                $('#tarifa_comercial').text(data.tarifa_comercial);
                $('#tarifa_industrial').text(data.tarifa_industrial);
                $('#tarifa_estatal').text(data.tarifa_estatal);
                $('#tarifa_social').text(data.tarifa_social);
            },
            error: function() {
                console.error('Error al cargar los datos.');
            }
        });
    }

    // Cargar al iniciar la vista
    cargarResumen();

    // Opcional: recargar cada 30 segundos
    // setInterval(cargarResumen, 30000);
});
</script>
