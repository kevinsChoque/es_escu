@extends('layout.layout')
@section('content')

<div class="container-fluid mt-1">
    <div class="card shadow bg-light">
        <div class="card-header">
            <h6 class="m-0"><i class="fa fa-list"></i> Lista</h6>
        </div>
        <div class="d-none justify-content-center containerSpinner" style="background: rgb(199 206 213 / 50%);height: 100%;
        position: absolute;width: 100%;z-index: 1000000;">
            <div class="spinner-border m-auto text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table id="tableCat" class="w-100 table table-hover table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" data-priority="1">#</th>
                                <th class="text-center" data-priority="1">Codigo</th>
                                <th class="text-center" data-priority="2">Encuestador</th>
                                <th class="text-center" data-priority="2">Ficha</th>
                                <th class="text-center" data-priority="2">Direccion</th>
                                <th class="text-center" data-priority="2">Provincia</th>
                                <th class="text-center" data-priority="3">Fecha de instlacion</th>
                                <th class="text-center" data-priority="3">Tarifa</th>
                                <th class="text-center" data-priority="3">Frontis</th>
                                <th class="text-center" data-priority="3">Agua</th>
                                <th class="text-center" data-priority="3">Alcantarrillado</th>
                                <th class="text-center" data-priority="3">Ubicacion</th>
                                <th class="text-center" data-priority="1">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="recordsAssign">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<style>
    button i {
    transition: transform 0.2s ease-in-out;
}
button:hover i {
    transform: scale(1.2);
}

</style>
@include('admin.section.editar')
<script>
    localStorage.setItem('nba',2)
$(document).ready( function ()
{
    $('.overlayPage').css("display","none");
    // fillRecords();
    // ---
});
$(document).ready(function () {
    $('#tableCat').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('catastro/list') }}",
            type: 'GET'
        },
        columns: [
            { data: 'idCat' },
            { data: 'u4' },
            { data: 'nombreEnc' },
            { data: 'ficha' },
            { data: 'd2' },
            { data: 'd7' },
            { data: 't1' },
            { data: 'ci1' },
            {
                data: 'frontis',
                render: function (data) {
                    return imgFro(data);
                }
            },
            {
                data: 'agua',
                render: function (data) {
                    return imgAgu(data);
                }
            },
            {
                data: 'alc',
                render: function (data) {
                    return imgAlc(data);
                }
            },
            {
                data: 'ubicacion',
                render: function (data) {
                    return imgUbi(data);
                }
            },
            {
                data: 'idCat',
                render: function (data) {
                    // <button class="btn btn-primary" onclick="edit(${data})"><i class="fa fa-edit"></i></button>
                    // <button class="btn btn-danger btn-delete" onclick="deleteRecords(${data})"><i class="fa fa-trash"></i></button>
                    // <button class="btn btn-info btn-delete" onclick="showFile(${data})"><i class="fa-solid fa-folder-open"></i></button>
                    return `

                        <!-- Botón Editar -->
                        <button class="btn btn-light shadow-sm rounded-circle me-2" onclick="edit(${data})" title="Editar">
                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                        </button>
                        <!-- Botón Eliminar -->
                        <button class="btn btn-light shadow-sm rounded-circle me-2" onclick="deleteRecords(${data})" title="Eliminar">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </button>
                        <!-- Botón Ficha Catastral -->
                        <button class="btn btn-light shadow-sm rounded-circle" onclick="showFile(${data})" title="Ficha Catastral">
                            <i class="fa-solid fa-folder-tree text-success"></i>
                        </button>
                    `;
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
        },
        pageLength: 3
    });
});
function showFile_eliminar(idCat)
{
    $(".containerSpinner").removeClass("d-none");
    $(".containerSpinner").addClass("d-flex");
    jQuery.ajax({
        url: "{{ url('catastro/showFile') }}",
        method: 'post',
        data: {idCat: idCat},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");
        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");
        }
    });
}
function showFile(idCat) {
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "{{ url('catastro/showFile') }}";
    form.target = "_blank"; // 👉 abre en nueva pestaña

    const inputId = document.createElement("input");
    inputId.type = "hidden";
    inputId.name = "idCat";
    inputId.value = idCat;
    form.appendChild(inputId);

    const inputCsrf = document.createElement("input");
    inputCsrf.type = "hidden";
    inputCsrf.name = "_token";
    inputCsrf.value = "{{ csrf_token() }}";
    form.appendChild(inputCsrf);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

function deleteRecords(idCat)
{
    // alert('eliminando')
    // return;
    event.preventDefault();
    Swal.fire({
    title: "ESTA SEGURO DE ELIMINAR EL REGISTRO?",
    text: "Confirme la accion ¿DESEA CONTINUAR?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, confirmar"
    }).then((result) => {
        if (result.isConfirmed)
        {
            $(".containerSpinner").removeClass("d-none");
            $(".containerSpinner").addClass("d-flex");
            jQuery.ajax({
                url: "{{ url('catastro/deleteReg') }}",
                method: 'post',
                data: {idCat: idCat},
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                success: function (r) {
                    console.log(r)
                    Swal.fire({
                        title: r.message,
                        icon: r.success ? "success" : "error",
                        timer: 2000
                    });
                    if (r.success)
                    {$('#tableCat').DataTable().ajax.reload(null, false);}
                    $(".containerSpinner").removeClass("d-flex");
                    $(".containerSpinner").addClass("d-none");
                },
                error: function (xhr, status, error) {
                    alert("Algo salio mal, porfavor contactese con el Administrador.");
                    $(".containerSpinner").removeClass("d-flex");
                    $(".containerSpinner").addClass("d-none");
                }
            });

        }
        else
            $(ele).prop('checked', false);
    });
}
function imgFro(img)
{return img===null?'-':'<img src="'+"{{asset('storage')}}/"+img+'" width="100">'}
function imgAgu(img)
{return img===null?'-':'<img src="'+"{{asset('storage')}}/"+img+'" width="100">'}
function imgAlc(img)
{return img===null?'-':'<img src="'+"{{asset('storage')}}/"+img+'" width="100">'}
function imgUbi(img)
{return img===null?'-':'<img src="'+"{{asset('storage')}}/"+img+'" width="100">'}
function fillRecords()
{
    $(".containerSpinner").removeClass("d-none").addClass("d-flex");
    jQuery.ajax({
        url: "{{ url('catastro/list') }}",
        method: 'get',
        success: function (r) {
            if(r.state)
            {
                $('#recordsAssign').html('');
                let html = '';
                let month='';
                for (var i = 0; i < r.data.length; i++)
                {
                    html += '<tr>' +
                        '<td class="align-middle text-center">' + i + '</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].u4) + '</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].nombreEnc) + '</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].ficha) + '</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].d2) + '</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].d7) + '</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].t1) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].ci1) + '</td>'+
                        '<td class="align-middle text-center">' + imgFro(r.data[i].frontis)+'</td>'+
                        '<td class="align-middle text-center">' + imgAgu(r.data[i].agua)+'</td>'+
                        '<td class="align-middle text-center">' + imgAlc(r.data[i].alc)+'</td>'+
                        '<td class="align-middle text-center">' + imgUbi(r.data[i].ubicacion)+'</td>'+
                        '<td class="align-middle text-center">' +
                            '<button class="btn btn-primary" onclick="edit('+r.data[i].idCat+')"><i class="fa fa-edit"></i></button>'+
                            '<button class="btn btn-danger btn-delete" onclick="deleteRecords('+r.data[i].idCat+')"><i class="fa fa-trash"></i></button>'+
                        '</td>' +
                    '</tr>';
                }
                initDatatable('tableCat')
                $('#recordsAssign').html(html);
                tippy('.btn-delete', {
                    content: 'Eliminar asignacion',
                    placement: 'top'
                });
            }
            else
                alert(r.message);
            $(".containerSpinner").removeClass("d-flex").addClass("d-none");
            // $('.overlayPage').css("display","none");
        },
        error: function (xhr, status, error) {
            console.log("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });
}
function edit(id)
{
    $('#mEditar').modal('show')
}
</script>
<script src="{{asset('plugins/datatables/dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.responsive.js')}}"></script>
<script src="{{asset('plugins/datatables/responsive.dataTables.js')}}"></script>
@endsection
