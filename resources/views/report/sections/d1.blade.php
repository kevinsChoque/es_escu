{{-- <div class="col-lg-3 mt-1">
    <div class="card">
        <div class="card-body">
            <h2>Registro de fichas X cuadrillas</h2>
            <canvas id="miDona"></canvas>
        </div>
    </div>
</div> --}}
{{-- <div class="container-fluid">
    <div class="row"> --}}
<div class="col-lg-3 mt-2">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-center text-primary fw-bold">Registro de Fichas X cuadrilla</h5>
            <div id="loadingSpinner" class="text-center my-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <p class="text-muted mt-2">Cargando datos...</p>
            </div>
            <div class="position-relative" style="height: 300px;">
                <canvas id="miDona" class="w-100 h-100"></canvas>
            </div>
            <div id="totalEncuestas" class="text-center mt-3 fw-semibold text-secondary"></div>
        </div>
    </div>
</div>
<script>
    let donaChart = null;

    $(document).ready(function() {
        cargarDatosDona();
    });

    function cargarDatosDona() {
        $('#loadingSpinner').show();
        $('#miDona').css('opacity', '0.3');

        $.ajax({
            url: '{{ url("report/d1") }}',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#loadingSpinner').hide();
                $('#miDona').css('opacity', '1');
                if (response.success) {
                    const datos = response.data;
                    crearOActualizarDona(datos);
                    $('#totalEncuestas').html(
                        `<strong>Total de encuestas:</strong> ${response.total_encuestas}`
                    );
                } else {
                    mostrarError(response.message || 'No se encontraron datos.');
                }
            },
            error: function(xhr, status, error) {
                $('#loadingSpinner').hide();
                mostrarError('Error al cargar los datos: ' + error);
            }
        });
    }

    function crearOActualizarDona(datos) {
        const ctx = document.getElementById('miDona').getContext('2d');
        if (donaChart) {
            donaChart.destroy();
        }

        donaChart = new Chart(ctx, {
            type: 'doughnut',
            data: datos,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 12 },
                            padding: 10,
                            boxWidth: 14
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    }

    function mostrarError(mensaje) {
        const canvasContainer = document.getElementById('miDona').parentNode;
        canvasContainer.innerHTML = `
            <div class="alert alert-danger text-center mt-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> ${mensaje}
            </div>
        `;
    }
</script>
<style>
    #miDona {
        transition: opacity 0.3s ease;
    }
</style>
