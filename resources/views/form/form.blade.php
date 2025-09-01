<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EMUSAP</title>
    <!-- icono de la pagina -->
    <link rel="icon" href="{{asset('img/emusap_logo.png')}}" type="image/x-icon">
    <!-- jQuery -->
    <script src="{{asset('adminlte3/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    {{-- <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}"> --}}
    <!-- estilos del tema -->
    <link rel="stylesheet" href="{{asset('adminlte3/dist/css/adminlte.min.css')}}">
    <!-- estilos de spinner -->
    <link rel="stylesheet" href="{{asset('css/spinersAdmin.css')}}">
    <!-- alertas sweetalert2 -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <script src="{{asset('adminlte3/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- estilos de datatable -->
    <!-- <link rel="stylesheet" href="{{asset('cdn/jquery.dataTables.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css"> -->
    <link rel="stylesheet" href="{{asset('datatable/css/dataTables.dataTables.css')}}">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"> -->
    <link rel="stylesheet" href="{{asset('datatable/css/buttons.dataTables.css')}}">
    <!-- para estilos de hora -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- libreria para fechas -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/daterangepicker/daterangepicker.css')}}">
    {{-- ------------------------------------------------------------ --}}
    {{-- ------------------------------------------------------------ --}}
    {{-- ------------------------------------------------------------ --}}
       <!-- Flatpickr CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css"> --}}

    <!-- Flatpickr JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script> --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script> --}}

    {{-- ---------------------------- --}}
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

<!-- Development -->
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<style>
    #map {
      height: 400px;
      width: 100%;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
    {{-- -------------------------- --}}
    {{-- -------------------------- --}}
    {{-- -------------------------- --}}
    {{-- <h3>Tu ubicación actual</h3>
    <div id="map" class="mb-3"></div>

    <div class="form-group">
      <label>Latitud:</label>
      <input type="text" id="lat" class="form-control mb-2" readonly>
      <label>Longitud:</label>
      <input type="text" id="lng" class="form-control mb-2" readonly>
      <button id="update-location" class="btn btn-primary">Actualizar coordenadas</button>
    </div>

    <script>
      let map, marker;

      function setPosition(pos) {
        map.setCenter(pos);
        marker.setPosition(pos);
        document.getElementById("lat").value = pos.lat;
        document.getElementById("lng").value = pos.lng;
      }

      function getCurrentLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            function (position) {
              const userPos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              setPosition(userPos);
            },
            function (error) {
              alert("Error al obtener ubicación: " + error.message);
            },
            {
              enableHighAccuracy: true,
              timeout: 10000,
              maximumAge: 0
            }
          );
        } else {
          alert("Tu navegador no soporta geolocalización.");
        }
      }

      function initMap() {
        const defaultPos = { lat: -13.6364, lng: -72.8814 };

        map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: defaultPos,
        });

        marker = new google.maps.Marker({
          position: defaultPos,
          map: map,
          draggable: true
        });

        // Inicial
        getCurrentLocation();

        // Click en mapa para mover marcador
        map.addListener("click", function (event) {
          const pos = {
            lat: event.latLng.lat(),
            lng: event.latLng.lng()
          };
          setPosition(pos);
        });

        // Botón para actualizar coordenadas
        document.getElementById("update-location").addEventListener("click", function () {
          getCurrentLocation();
        });
      }

      window.addEventListener("load", () => {
        const waitForGoogle = setInterval(() => {
          if (typeof google !== "undefined" && google.maps) {
            clearInterval(waitForGoogle);
            initMap();
          }
        }, 100);
      });
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ0viuHmIAeGXvs_lOzDehjp895fw9MRk" async defer></script> --}}

    {{-- -------------------------- --}}
    {{-- -------------------------- --}}
    {{-- -------------------------- --}}

    <div class="overlayAllPage">
        <div class="overlay-content">
            {{-- <h2>Este es el overlay</h2>
            <p>Puedes añadir aquí cualquier contenido.</p> --}}
            {{-- <button onclick="closeOverlay()">Cerrar</button> --}}
            <div class="loadingio-spinner-spin-i3d1hxbhik m-auto">
                <div class="ldio-onxyanc9oyh">
                    <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-white py-2 px-3 rounded shadow"
        style="background: linear-gradient(90deg, #28a745, #007bff);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;position: fixed;
            top: 0;
            left: 0;width: 100%;z-index: 1050;"
            >

        <img src="{{ asset('img/emusap_logo.png') }}" alt="EMUSAP Logo" style="width: 40px; height: 40px; margin-right: 12px;">

        <h5 class="mb-0" style="font-weight: bold; font-style: italic; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
            EMUSAP <span style="font-weight: 900;">ABANCAY S.A.</span> <br> <span class="badge badge-warning tipoFormulario">Nuevo</span>
        </h5>

    </div>
    {{-- <div class="alert alert-danger text-center m-0" style="font-weight: bold; font-style: italic; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Nuevo registro</div> --}}
    {{-- <div class="alert alert-danger text-center m-0"
     style="font-weight: bold;
            font-style: italic;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1050;">
    Nuevo registro
</div> --}}

    <div class="modal fade" id="modalBuscarInscripcion" tabindex="-1" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white py-1">
                    <h5 class="modal-title" id="modalLabelBuscar">Buscar Inscripción</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="numeroInscripcion">Número de Inscripción</label>
                        <input type="text" class="form-control" id="numeroInscripcion" name="numeroInscripcion" placeholder="Ej. 12345678" required>
                    </div>
                </div>
                <div class="modal-footer py-1">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" onclick="buscar()">Buscar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-3 mt-5" style="background-image: url('{{asset('img/bgg.jpg')}}')">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="overlay overlayForm">
                        <div class="spinner"></div>
                    </div>
                    <div class="card-body">
                        <style>
                            .fab-container {
                                position: fixed;
                                bottom: 20px;
                                left: 20px;
                                z-index: 999;
                            }
                            .fab-main, .fab-option {
                                width: 56px;
                                height: 56px;
                                border-radius: 50%;
                                background: linear-gradient(135deg, #1e90ff, #00c853);
                                color: white;
                                border: none;
                                box-shadow: 0 3px 6px rgba(0,0,0,0.3);
                                font-size: 24px;
                                cursor: pointer;
                                transition: transform 0.3s ease, opacity 0.3s ease;
                            }
                            .fab-option {
                                position: absolute;
                                left: 0;
                                opacity: 0;
                                pointer-events: none;
                            }
                            .fab-container.open .fab-option {
                                opacity: 1;
                                pointer-events: auto;
                            }
                            .fab-search {bottom: 70px;}
                            .fab-save {bottom: 140px;}
                        </style>
                        <div class="fab-container" id="fabContainer">
                            <button class="fab-main" onclick="toggleFab()">+</button>
                            {{-- <button class="fab-option fab-search" onclick="buscar()">🔍</button> --}}
                            <button class="fab-option fab-search" data-toggle="modal" data-target="#modalBuscarInscripcion" style="background:#bfcedd;">🔍</button>
                            <button class="fab-option fab-save saveFicha" style="background:#bfcedd;">💾</button>
                        </div>
                        <script>
                            function toggleFab() {document.getElementById('fabContainer').classList.toggle('open');}
                            function buscar()
                            {
                                const nro = $('#numeroInscripcion').val().trim();
                                if (!nro)
                                {Swal.fire('Ingrese un número de inscripción válido', '', 'warning');return;}
                                Swal.fire({
                                title: '¿Estás seguro?',
                                text: 'Se eliminarán los datos ingresados si continúas',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Sí, buscar',
                                cancelButtonText: 'Cancelar'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire({
                                    title: 'Buscando...',
                                    text: 'Por favor espera',
                                    icon: 'info',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                        $.ajax({
                                            url: '{{ url("catastro/buscar") }}',
                                            type: 'get',
                                            data: {inscripcion: nro},
                                            success: function (r) {
                                                // console.log(r)
                                                console.table(r.data);
                                                Swal.close();
                                                if (r.success)
                                                {
                                                    limpiar();
                                                    loadDatos(r);Swal.fire('Encontrado', r.message, 'success');
                                                }
                                                else
                                                {Swal.fire('No encontrado', r.message, 'error');}
                                                $('#numeroInscripcion').val('')
                                                $('#modalBuscarInscripcion').modal('hide')
                                            },
                                            error: function () {
                                                Swal.fire('Error', 'Ocurrió un error en el servidor.', 'error');
                                                $('#modalBuscarInscripcion').modal('hide')
                                            }
                                        });
                                    }
                                    });
                                }
                                });
                            }
var test;
const tarifas = {
    17: "17-DOMESTICO",
    18: "18-SOCIAL-DOMESTICO",
    25: "25-COMERCIAL",
    43: "43-INDUSTRIAL",
    64: "64-ESTATAL"
};

                            function loadDatos(r)
                            {
                                test=r
                                if(r.origen=='bd')
                                {
                                    $('#nombreEnc').val(r.data.nombreEnc)
                                    $('#ficha').val(r.data.ficha)
                                    for (let i = 1; i <= 6; i++) {
                                        $('#u' + i).val(r.data['u' + i]);
                                    }
                                    for (let i = 1; i <= 12; i++) {
                                        $('#d' + i).val(r.data['d' + i]);
                                    }
                                    for (let i = 1; i <= 13; i++) {
                                        $('#t' + i).val(r.data['t' + i]);
                                    }
                                    for (let i = 1; i <= 8; i++) {
                                        $('#c' + i).val(r.data['c' + i]);
                                    }
                                    for (let i = 1; i <= 3; i++) {
                                        $('#ci' + i).val(r.data['ci' + i]);
                                    }
                                    if(r.data['ci3']=='OTRO')
                                    {
                                        $('#ci4').val(r.data['ci4']);
                                        $('#ci4').parent().parent().css('display','block')
                                    }
                                    if(r.data['d8']=='OTRO')
                                    {
                                        $('#d13').val(r.data['d13']);
                                        $('#d13').parent().parent().css('display','block')
                                    }
                                    $('.tipoCliente').html("(F.I.A: "+ r.data.t1+")");
                                    $('.tipoFormulario').html('Actualizando')
                                }
                                else
                                {
                                    $('#u4').val(r.data.InscriNro)
                                    $('#u5').val(r.data.PreMzn)
                                    $('#u6').val(r.data.PreLote)
                                    $('#d1').val(r.data.CliNombre)
                                    $('#d3').val(r.data.PreMuni)
                                    $('#t1').val(r.data.Confiax.date.split(' ')[0]);
                                    $('.tipoCliente').html("(F.I.A: "+ r.data.Confiax.date.split(' ')[0]+")");
                                    $('#t5').val(r.data.MedNrox)
                                    $('#c1').val(r.data.Confidx.date.split(' ')[0]);
                                    $('#ci1').val(tarifas[r.data.Tarifx.match(/\d+/)[0]]);// obtiene el primer número encontrado
                                    $('.tipoFormulario').html('Nuevo')
                                }
                            }
                            function guardar()
                            {
                                Swal.fire('Guardando...', '', 'success');
                            }
                        </script>

                        <form id="fvcatastro">
                            <div class="row">
                                @include('form.section.p0')
                                @include('form.section.p1')
                                @include('form.section.p2')
                                @include('form.section.p3')
                                @include('form.section.p4')
                                @include('form.section.p5')
                            </div>
                        </form>
                    </div>
                    {{-- <div class="card-footer py-1 border-transparent">
                        <button type="button" class="btn btn-success float-right saveFicha ml-2 w-100 validate"><i class="fa fa-save"></i> Guardar ficha</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script> --}}

{{-- --------------------------------------------------------------------------------------------------------- --}}


<!-- jQuery -->
<script src="{{asset('adminlte3/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('adminlte3/dist/js/adminlte.js')}}"></script>
<!-- jquery validate -->
<script src="{{asset('adminlte3/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- transJQV -->
<script src="{{asset('js/translateValidate.js')}}"></script>
<!-- helpers -->
<script src="{{asset('js/helper.js')}}"></script>
<!-- datatable -->
<!-- <script src="{{asset('cdn/jquery.dataTables.min.js')}}"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->

<!-- <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script> -->
<script src="{{asset('datatable/js/dataTables.js')}}"></script>
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script> -->
<script src="{{asset('datatable/js/dataTables.buttons.js')}}"></script>
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script> -->
<script src="{{asset('datatable/js/buttons.dataTables.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> -->
<script src="{{asset('datatable/js/jszip.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script> -->
<script src="{{asset('datatable/js/pdfmake.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> -->
<script src="{{asset('datatable/js/vfs_fonts.js')}}"></script>
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script> -->
<script src="{{asset('datatable/js/buttons.html5.min.js')}}"></script>
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script> -->
<script src="{{asset('datatable/js/buttons.print.min.js')}}"></script>
<!-- estilos de select2 -->
{{-- C:\xampp\htdocs\esrc2\public\plugins\select2 --}}
<link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<!-- trabaja con datapicker -->
<script src="{{asset('adminlte3/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('adminlte3/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<style>
    .flatpickr-day.flatpickr-disabled {
    /* background-color: red !important; */
    background-color: rgba(255,0,0,.5) !important;
    color: white !important;
    opacity: 0.8;
}
</style>
<script>
    var guardarFicha;
    $(document).ready( function () {
        $('.overlayAllPage').css("display","none");
        $('.overlayForm').css("display","none");
        // console.log('csacasc')
        guardarFicha="{{ url('catastro/save') }}"
        // console.log(guardarFicha)
        // console.log('csacasc')
    });
    $('.saveFicha').on('click',function(){
        var formData = new FormData($("#fvcatastro")[0]);
        // for (let [key, value] of formData.entries()) {
        //     console.log(key, value);
        // }
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax({
            url: guardarFicha,
            method: 'post',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                console.log(r)
                let texto = "La información fue registrada correctamente.";
                // Si hay imágenes procesadas, agregamos más info
                if ((r.imagenes_guardadas && r.imagenes_guardadas.length > 0) ||
                    (r.imagenes_fallidas && r.imagenes_fallidas.length > 0))
                {
                    texto = "";
                    if (r.imagenes_guardadas.length > 0)
                        texto += "✅ Imágenes guardadas: <br>" + r.imagenes_guardadas.join("<br>") + "<br><br>";
                    if (r.imagenes_fallidas.length > 0)
                        texto += "❌ Imágenes fallidas: <br>" + r.imagenes_fallidas.join("<br>");
                }
                if(r.success){limpiar();}
                Swal.fire({
                    title: r.success ? "Éxito" : "Ocurrió un error",
                    html: texto, // usamos `html` para permitir saltos de línea
                    icon: r.success ? "success" : "error",
                });
                $('.overlayAllPage').css("display","none");
            },
            error: function (xhr, status, error) {
                msgImportantShow('Algo salio mal, porfavor contactese con el Administrador.','-','error')
                console.log(error)
                $('.overlayForm').css("display","none");
                $('.overlayAllPage').css("display","none");
            }
        });
    })
    function limpiar()
    {
        $('.sel').val(0)
        $('.input').val('')
        limpiarFrontis()
        limpiarAgua()
        limpiarAlc()
        limpiarUbicacion()
        $('.tipoCliente').html('')
        $('#ci4').parent().parent().css('display','none')
    }
</script>
<script src="{{asset('js/form.js')}}"></script>
</body>
</html>
