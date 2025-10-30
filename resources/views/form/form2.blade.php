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
    <div class="overlayAllPage">
        <div class="overlay-content">
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
    <div class="container-fluid pt-3 mt-5" style="background-image: url('{{asset('img/bgg.jpg')}}')">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="overlay overlayForm">
                        <div class="spinner"></div>
                    </div>
                    <div class="card-body">
                        <style>
                            .fab-container2 {
                                position: fixed;
                                bottom: 20px;
                                right: 20px;
                                z-index: 999;
                            }
                            .fab-main2 {
                                width: 56px;
                                height: 56px;
                                border-radius: 50%;
                                /* background: linear-gradient(135deg, #1e90ff, #00c853); */
                                background: linear-gradient(135deg, #4dc52f, #0c6128);

                                color: white;
                                border: none;
                                box-shadow: 0 3px 6px rgba(0,0,0,0.3);
                                font-size: 24px;
                                cursor: pointer;
                                transition: transform 0.3s ease, opacity 0.3s ease;
                            }
                            /* --- */
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
                            <button class="fab-main saveFicha">💾</button>
                            {{-- <button class="fab-option fab-search" data-toggle="modal" data-target="#modalBuscarInscripcion" style="background:#bfcedd;">🔍</button>
                            <button class="fab-option fab-save saveFicha" style="background:#bfcedd;">💾</button> --}}
                        </div>
                        <div class="fab-container2" id="fabContainer2">
                            <button class="fab-main2"><i class="fas fa-clipboard-list"></i></button>
                            {{-- <a href="{{ url('ct2/form2') }}" class="fab-main2"><i class="fas fa-clipboard-list"></i></a> --}}
                        </div>

                        <form id="fvcatastro">
                            <input type="hidden" id="idCao" name="idCao">
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label for="ins" class="m-0">Número de Inscripción</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="ins" name="ins" placeholder="Ej. 12345678" maxlength="8" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary font-weight-bold w-100 mb-3"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#collapseDg"
                                    aria-expanded="false"
                                    aria-controls="collapseDg">
                                Datos generales
                            </button>

                            <div class="collapse" id="collapseDg">
                                <div class="card card-body">
                                    <dl class="row mb-0">
                                        <dt class="col-6 col-sm-3">Código Catastral:</dt>
                                        <dd class="col-6 col-sm-3 vcodigo">-</dd>

                                        <dt class="col-6 col-sm-3">Inscripción:</dt>
                                        <dd class="col-6 col-sm-3 vins">-</dd>

                                        <dt class="col-6 col-sm-3">Nombre:</dt>
                                        <dd class="col-6 col-sm-3 vnombre">-</dd>

                                        <dt class="col-6 col-sm-3">Tarifa:</dt>
                                        <dd class="col-6 col-sm-3 vtarifa">-</dd>

                                        <dt class="col-6 col-sm-3">Situación Agua:</dt>
                                        <dd class="col-6 col-sm-3 vagu">-</dd>

                                        <dt class="col-6 col-sm-3">Dirección:</dt>
                                        <dd class="col-6 col-sm-3 vdireccion">-</dd>

                                        <dt class="col-6 col-sm-3">Medidor:</dt>
                                        <dd class="col-6 col-sm-3 vmedidor">-</dd>

                                        <dt class="col-6 col-sm-3">Situación Desagüe:</dt>
                                        <dd class="col-6 col-sm-3 vdes">-</dd>
                                    </dl>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label class="m-0">Nombre del encuestador:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                        </div>
                                        <select name="nombreEnc" id="nombreEnc" class="form-control sel">
                                            <option value="0" disabled selected>Seleccione...</option>
                                            <option value="CUADRILLA Nª 1 (YOSI, KAREN)">CUADRILLA Nª 1 (YOSI, KAREN)</option>
                                            <option value="CUADRILLA Nª 2 (FIO, PRISCILA)">CUADRILLA Nª 2 (FIO, PRISCILA)</option>
                                            <option value="CUADRILLA Nª 3 (DELIA, HABRAM)">CUADRILLA Nª 3 (DELIA, HABRAM)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 msjUpdate" style="display: none;">
                                    <div class="alert alert-warning py-2 mb-0 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <div class="font-weight-bold"> Las imágenes anteriores se eliminarán si sube nuevas imágenes.</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Cargar imagenes: <span class="fas fa-broom text-info limpiar" onclick="limpiarFrontis()"></span></label>
                                        <input type="file" class="form-control-file" id="frontis" name="frontis[]" accept="image/*" multiple>
                                    </div>
                                    <div id="previewFrontis" class="mt-3 row"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="m-0">Observaciones:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                        </div>
                                        <textarea name="obs" id="obs" class="form-control input" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
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
    var segun = 'new';
    $(document).ready( function () {
        $('.overlayAllPage').css("display","none");
        $('.overlayForm').css("display","none");
    });

    $('.saveFicha').on('click',function(){
        if(isEmpty($('#ins').val()))
        {msgImportantShow('Es necesario q ingrese un numero de inscripcion', 'Advertencia', 'error');return;}
        if(segun=='new')
            saveNuevo()
        else
            update()
    })
    function limpiarFrontis()
    {$('#frontis').val('');$('#previewFrontis').html('');}
    $('#frontis').on('change', function () {
        $('#previewFrontis').html('');
        const files = this.files;
        if (files.length > 6) {
            alert('Solo puedes subir un máximo de 6 fotos.');
            $('#frontis').val(''); // limpia el input
            return;
        }
        if (files && files.length > 0) {
            [].forEach.call(files, function(file) {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = $('<img>')
                        .attr('src', e.target.result)
                        .addClass('img-thumbnail m-2')
                        .css({
                            width: '150px',
                            height: '150px',
                            objectFit: 'cover'
                        });
                    $('#previewFrontis').append(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });
    $('#btnBuscar').on('click',function(){

        $('.overlayAllPage').css("display","flex");
        jQuery.ajax({
            url: "{{ url('ct2/showInfo') }}",
            method: 'GET',
            data:{ins:$('#ins').val()},
            dataType: 'json',
            beforeSend: function() {
                limpiar()
            },
            success: function (r) {
                loadDatos(r)
                $('.vcodigo').html(novDato(r.data.PreMzn+'-'+r.data.PreLote))
                $('.vins').html(novDato(r.data.InscriNro))
                $('.vnombre').html(novDato(r.data.Clinomx))
                $('.vtarifa').html(novDato(r.data.Tarifx))
                $('.vagu').html(novDato(r.data.ConEstado))
                $('.vdireccion').html(novDato(r.data.direccion))
                $('.vmedidor').html(novDato(r.data.MedNror))
                $('.vdes').html(novDato(r.data.ConDEstad))
                $('.overlayAllPage').css("display","none")
                $('#collapseDg').collapse('show');
            },
            error: function (xhr, status, error) {
                alert("Algo salió mal, por favor contacte con el Administrador.");
                $('.overlayAllPage').css("display","none")
            }
        });
    })
    function loadDatos(r)
    {
        if(r.origen=='update')
        {
            $('#idCao').val(r.catastroObs.idCao)
            console.log('ya lo registraron es update')
            $('#nombreEnc').val(r.catastroObs.nombreEnc)
            $('#obs').val(r.catastroObs.obs)
            let contenedor = $("#previewFrontis");
            contenedor.empty();
            if (r.imagenes && r.imagenes.length > 0) {
                r.imagenes.forEach(url => {
                    const img = $('<img>')
                        .attr('src', url)
                        .addClass('img-thumbnail m-2')
                        .css({
                            width: '150px',
                            height: '150px',
                            objectFit: 'cover'
                        });
                    contenedor.append(img);
                });
            } else {
                contenedor.append(`<p class="text-muted">No hay imágenes disponibles.</p>`);
            }
            $('.tipoFormulario').html('Actualizando')
            $('.msjUpdate').css('display','block')
            segun = 'update';
        }
        else
        {
            console.log('es nuevo')
            $('.tipoFormulario').html('Nuevo')
            $('.msjUpdate').css('display','none')
            segun = 'new';
        }
    }
    function update()
    {
        var formData = new FormData($("#fvcatastro")[0]);
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax({
            url: "{{ url('ct2/saveChanges') }}",
            method: 'post',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                console.log(r)
                // let texto = "La información fue registrada correctamente.";
                // // Si hay imágenes procesadas, agregamos más info
                // if ((r.imagenes_guardadas && r.imagenes_guardadas.length > 0) ||
                //     (r.imagenes_fallidas && r.imagenes_fallidas.length > 0))
                // {
                //     texto = "";
                //     if (r.imagenes_guardadas.length > 0)
                //         texto += "✅ Imágenes guardadas: <br>" + r.imagenes_guardadas.join("<br>") + "<br><br>";
                //     if (r.imagenes_fallidas.length > 0)
                //         texto += "❌ Imágenes fallidas: <br>" + r.imagenes_fallidas.join("<br>");
                // }
                if(r.success){limpiar();}
                Swal.fire({
                    title: r.success ? "Éxito" : "Ocurrió un error",
                    html: r.message, // usamos `html` para permitir saltos de línea
                    icon: r.success ? "success" : "error",
                });
                segun = 'new'
                $('#ins').val('')
                $('.tipoFormulario').html('Nuevo')
                $('.overlayAllPage').css("display","none")
            },
            error: function (xhr, status, error) {
                msgImportantShow('Algo salio mal, porfavor contactese con el Administrador.','-','error')
                console.log(error)
                $('.overlayForm').css("display","none");
                $('.overlayAllPage').css("display","none");
            }
        });
    }
    function saveNuevo()
    {
        if(isEmpty($('#ins').val()) || isEmpty($('#nombreEnc').val()))
        {
            Swal.fire({title: "Ocurrió un error",html: 'Ingrese todos los campos',icon: "warning",});
            return;
        }
        var formData = new FormData($("#fvcatastro")[0]);
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax({
            url: "{{ url('ct2/save') }}",
            method: 'post',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                console.log(r)
                console.log('entro aqui')
                $('.overlayAllPage').css("display","none");
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
                segun = 'new';
                $('.overlayAllPage').css("display","none");
            },
            error: function (xhr, status, error) {
                msgImportantShow(xhr.responseJSON.error || 'Algo salio mal, porfavor contactese con el Administrador.','-','error')
                $('.overlayForm').css("display","none");
                $('.overlayAllPage').css("display","none");
            }
        });
    }
    function limpiar()
    {
        $('.sel').val(0)
        $('.input').val('')
        limpiarFrontis()
        $('.vcodigo').html('-')
        $('.vins').html('-')
        $('.vnombre').html('-')
        $('.vtarifa').html('-')
        $('.vagu').html('-')
        $('.vdireccion').html('-')
        $('.vmedidor').html('-')
        $('.vdes').html('-')
        $('#collapseDg').collapse('hide')
    }
</script>
<script>
    $('#fabContainer2').on('click',function(){
        window.location.href = "{{ url('/') }}";
    })

</script>
<script src="{{asset('js/form.js')}}"></script>
</body>
</html>
