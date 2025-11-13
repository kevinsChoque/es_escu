<div class="col-lg-3 mt-2">
    <div class="card shadow-sm">
        <div class="card-body">
            {{-- <h5 class="card-title text-center mb-3">Tipo de Construcción por Tipo de Servicio</h5> --}}
            <h5 class="card-title text-center text-primary fw-bold">Tipos de servicio X construccion</h5>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label for="tipoConstruccion" class="form-label fw-bold m-0">Selecciona Tipo:</label>
                    <select id="tipoConstruccion" class="form-select">
                        <option value="">Todos</option>
                        <option value="CASA (EDIFICADO)">CASA (EDIFICADO)</option>
                        <option value="EDIFICIO">EDIFICIO</option>
                        <option value="LOTE BALDIO">LOTE BALDIO</option>
                        <option value="LOTE CERCADO">LOTE CERCADO</option>
                        <option value="EN CONSTRUCCION">EN CONSTRUCCION</option>
                    </select>
                </div>
            </div>
            <div class="text-center mb-3">
                <div id="loadingBar" class="spinner-border text-primary" role="status" style="display:none;">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>
            <canvas id="chartMultiPie" height="300"></canvas>
        </div>
    </div>
</div>

<script>
let chartMultiPie;
var ds, da;

function crearGraficoMultiPie(servicio, almacenamiento) {
    const ctx = document.getElementById('chartMultiPie').getContext('2d');

    if (chartMultiPie) chartMultiPie.destroy();

    // Etiquetas combinadas
    const labels = [...new Set([
        ...servicio.map(d => d.categoria),
        ...almacenamiento.map(d => d.categoria)
    ])];
    // var servicio = [
    // { categoria: 'AGUA', total: 12 },
    // { categoria: 'ALCANTARILLADO', total: 8 },
    // { categoria: 'AGUA Y ALCANTARILLADO', total: 5 }
    // ];

    // var almacenamiento = [
    // { categoria: 'TANQUE ALTO', total: 10 },
    // { categoria: 'TANQUE BAJO', total: 15 }
    // ];
console.log(labels)
    // Crear datasets
    const datasetServicio = {
        label: 'Tipo de Servicio',
        data: labels.map(l => {
            const item = servicio.find(d => d.categoria === l);
            return item ? item.total : 0;
        }),
        backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0'],
    };
ds=datasetServicio
    const datasetAlmacenamiento = {
        label: 'Tipo de Almacenamiento',
        data: labels.map(l => {
            const item = almacenamiento.find(d => d.categoria === l);
            return item ? item.total : 0;
        }),
        backgroundColor: ['#9966FF', '#FF9F40', '#4BC0C0', '#FFCE56'],
    };
da=datasetAlmacenamiento
    // Crear gráfico tipo "doughnut" múltiple
    chartMultiPie = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [datasetServicio, datasetAlmacenamiento]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Tipo de Servicio y Tipo de Almacenamiento'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.dataset.label || '';
                            const value = context.raw || 0;
                            return `${label}: ${value}`;
                        }
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
}

function cargarDatos(tipoConstruccion = '') {
    $('#loadingBar').show();

    $.ajax({
        url: '{{ url("report/barapi1") }}',
        method: 'GET',
        data: { tipo_construccion: tipoConstruccion },
        dataType: 'json',
        success: function(response) {
            $('#loadingBar').hide();

            if (response.success) {
                crearGraficoMultiPie(response.servicio, response.almacenamiento);
            } else {
                alert('No se encontraron datos.');
            }
        },
        error: function() {
            $('#loadingBar').hide();
            alert('Error al cargar los datos.');
        }
    });
}

$(document).ready(function() {
    cargarDatos();
    $('#tipoConstruccion').change(function() {
        cargarDatos($(this).val());
    });
});
</script>
