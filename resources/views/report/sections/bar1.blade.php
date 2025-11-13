
<div class="col-lg-6 mt-1">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center text-primary fw-bold">📊 Reporte de Fichas Registradas por Fecha</h5>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="inicio" class="form-label m-0">Desde</label>
                    <input type="date" id="inicio" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="fin" class="form-label  m-0">Hasta</label>
                    <input type="date" id="fin" class="form-control">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button id="btnFiltrar" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </div>
            <canvas id="graficoFichas" height="100"></canvas>
        </div>
    </div>
</div>
<script>
let chart; // referencia global del gráfico
$(document).ready(function() {
    cargarGrafico();
});
$('#btnFiltrar').click(function() {
    const inicio = $('#inicio').val();
    const fin = $('#fin').val();
    cargarGrafico(inicio, fin);
});
function cargarGrafico(inicio = '', fin = '') {
    $.ajax({
        url: "{{ url('report/bar1') }}",
        data: {inicio, fin},
        success: function(data) {
            const labels = data.map(d => d.fecha);
            const values = data.map(d => d.total);
            const ctx = document.getElementById('graficoFichas').getContext('2d');
            if (chart) chart.destroy();
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Fichas registradas',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Fichas catastrales registradas por día'
                        }
                    }
                }
            });
        }
    });
}
</script>
