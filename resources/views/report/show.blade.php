@extends('layout.layout')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <div class="container-fluid mt-1">
        <div class="card shadow bg-light">
            <div class="card-header">
                <h6 class="m-0"><i class="fa fa-list"></i> Fichas</h6>
            </div>
            <div class="d-none justify-content-center containerSpinner"
                style="background: rgb(199 206 213 / 50%);height: 100%; position: absolute;width: 100%;z-index: 1000000;">
                <div class="spinner-border m-auto text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row m-3">
        <div class="col-lg-3 mt-1">
            <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
                <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1">
                    <i class="fa fa-edit"></i>
                </span>
                <div class="flex-grow-1">
                    <span class="d-block text-muted text-uppercase small fw-bold">Conexiones registradas</span>
                    <span class="d-block fs-4 fw-bold text-center">10</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mt-1">
            <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
                <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1">
                    <i class="fa fa-edit"></i>
                </span>
                <div class="flex-grow-1">
                    <span class="d-block text-muted text-uppercase small fw-bold">Conexiones registradas</span>
                    <span class="d-block fs-4 fw-bold text-center">10</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mt-1">
            <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
                <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1">
                    <i class="fa fa-edit"></i>
                </span>
                <div class="flex-grow-1">
                    <span class="d-block text-muted text-uppercase small fw-bold">Conexiones registradas</span>
                    <span class="d-block fs-4 fw-bold text-center">10</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mt-1">
            <div class="d-flex align-items-center p-2 bg-white border rounded shadow-sm">
                <span class="flex-shrink-0 p-2 bg-primary text-white rounded me-1">
                    <i class="fa fa-edit"></i>
                </span>
                <div class="flex-grow-1">
                    <span class="d-block text-muted text-uppercase small fw-bold">Conexiones registradas</span>
                    <span class="d-block fs-4 fw-bold text-center">10</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-1">
            <div class="card">
                <div class="card-body">
                    <h2>Reporte de Reclamos por Mes</h2>
                    <canvas id="reporteBarras"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.overlayPage').css("display", "none");
        });
    const ctx = document.getElementById('reporteBarras').getContext('2d');

    const data = {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
      datasets: [{
        label: 'Cantidad de Reclamos',
        data: [12, 19, 7, 15, 10],
        backgroundColor: [
          'rgba(54, 162, 235, 0.7)',
          'rgba(255, 99, 132, 0.7)',
          'rgba(255, 206, 86, 0.7)',
          'rgba(75, 192, 192, 0.7)',
          'rgba(153, 102, 255, 0.7)'
        ],
        borderColor: [
          'rgba(54, 162, 235, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)'
        ],
        borderWidth: 1
      }]
    };

    const options = {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Número de Reclamos'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Mes'
          }
        }
      },
      plugins: {
        legend: {
          position: 'top'
        },
        title: {
          display: true,
          text: 'Estadísticas de Reclamos (2025)'
        }
      }
    };

    new Chart(ctx, {
      type: 'bar',
      data: data,
      options: options
    });
  </script>
    <script src="{{ asset('plugins/datatables/dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.dataTables.js') }}"></script>
@endsection
