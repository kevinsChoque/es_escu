@extends('layout.layout')
@section('content')
    <div class="container-fluid mt-1">
        <div class="card shadow bg-light">
            <div class="card-header">
                <h6 class="m-0"><i class="fa fa-list"></i> Lista</h6>
            </div>
            <div class="d-none justify-content-center containerSpinner"
                style="background: rgb(199 206 213 / 50%);height: 100%;
        position: absolute;width: 100%;z-index: 1000000;">
                <div class="spinner-border m-auto text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-primary w-100 fw-bold showRecords"><i class="fa fa-list"></i> Registros de
                            catastro</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-info w-100 fw-bold showObs"><i class="fa fa-list-ol"></i> Registros de
                            OBS</button>
                    </div>
                    <div class="col-lg-12 table-responsive mt-3 containerRecords">
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
                                    {{-- <th class="text-center" data-priority="3">Agua</th>
                                <th class="text-center" data-priority="3">Alcantarrillado</th>
                                <th class="text-center" data-priority="3">Ubicacion</th> --}}
                                    <th class="text-center" data-priority="1">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="recordsAssign">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 table-responsive mt-3 containerRecordsObs" style="display: none;">
                        <table id="tableCatObs" class="w-100 table table-hover table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center" data-priority="1">#</th>
                                    <th class="text-center" data-priority="1">Inscripcion</th>
                                    <th class="text-center" data-priority="2">Encuestador</th>
                                    <th class="text-center" data-priority="3">Obs</th>
                                    <th class="text-center" data-priority="3">Fecha</th>
                                    <th class="text-center" data-priority="3">Imagenes</th>
                                    <th class="text-center" data-priority="1">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="recordsObs">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Galería -->
    <div class="modal fade" id="modalGaleria" tabindex="-1" aria-labelledby="modalGaleriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-white text-center">
                <div class="modal-body position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    <!-- Imagen grande -->
                    <img id="imgGrande" src="" class="img-fluid rounded"
                        style="max-height: 70vh; object-fit: contain;">
                    <!-- Controles -->
                    <button id="btnPrev" class="btn btn-light position-absolute top-50 start-0 translate-middle-y"><i
                            class="fa-solid fa-chevron-left"></i></button>
                    <button id="btnNext" class="btn btn-light position-absolute top-50 end-0 translate-middle-y"><i
                            class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal visor de imágenes -->
    <div class="modal fade" id="imgModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-white text-center position-relative">
                <!-- Botón de cierre -->
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal" aria-label="Cerrar"></button>
                <!-- Imagen principal -->
                <div class="modal-body p-0"><img id="modalImage" src="" class="img-fluid rounded"
                        style="max-height: 70vh; object-fit: contain;"></div>
                <!-- Botones de navegación -->
                <button id="prevImg"
                    class="btn btn-light position-absolute top-50 start-0 translate-middle-y btn-nav-img"><i
                        class="fa-solid fa-chevron-left"></i></button>
                <button id="nextImg"
                    class="btn btn-light position-absolute top-50 end-0 translate-middle-y btn-nav-img"><i
                        class="fa-solid fa-chevron-right"></i></button>
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
        localStorage.setItem('nba', 2)
        $(document).ready(function() {
            $('.overlayPage').css("display", "none");
        });
        $(document).ready(function() {
            let table = $('#tableCat').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('catastro/list') }}",
                    type: 'GET'
                },
                columns: [
                    {data: 'idCat'},
                    {data: 'u4'},
                    {data: 'nombreEnc'},
                    {data: 'ficha'},
                    {data: 'd2'},
                    {data: 'd7'},
                    {data: 't1'},
                    {data: 'ci1'},
                    {
                        data: null,
                        render: function(data) {
                            let base = "{{ asset('storage') }}/";
                            let imgs = [];
                            if (data.frontis) imgs.push(base + data.frontis);
                            if (data.agua) imgs.push(base + data.agua);
                            if (data.alc) imgs.push(base + data.alc);
                            if (data.ubicacion) imgs.push(base + data.ubicacion);
                            if (imgs.length === 0)
                                return '<span class="text-muted">Sin imágenes</span>';
                            return imgs.map((img, i) =>
                                `<img src="${img}" class="img-thumbnail me-1" width="70" height="70"
                        style="cursor:pointer;" onclick='openImageModal(${JSON.stringify(imgs)}, ${i})'>`
                            ).join('');
                        }
                    },
                    {
                        data: 'idCat',
                        render: function(data) {
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
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
                },
                pageLength: 3,
                initComplete: function() {
                    // PERSONALIZAR BUSCADOR
                    let searchInput = $('.dt-search input');
                    searchInput
                        .addClass('form-control form-control-lg shadow-sm rounded-pill border-primary')
                        .attr('placeholder', '🔍 Buscar registro...')
                        .css({
                            width: '100%',
                            maxWidth: '100%',
                            boxShadow: '0 0 8px rgba(0,123,255,0.2)',
                            fontSize: '1rem'
                        });
                    $('.dt-search').addClass('w-100 mt-3').css({
                        display: 'flex',
                        justifyContent: 'center'
                    });
                    $('.dt-search label').remove();
                    // 🔹 PERSONALIZAR SELECT DE LONGITUD
                    let lengthSelect = $('select[name="tableCat_length"]');
                    lengthSelect
                        .addClass('form-select form-select-sm border-primary shadow-sm rounded-pill')
                        .css({
                            width: '100px',
                            display: 'inline-block',
                            marginLeft: '10px'
                        });
                    // 🔹 Opcional: ajustar la fila superior del DataTable
                    $('#tableCat_wrapper .row:first')
                        .addClass('d-flex justify-content-between align-items-center flex-wrap');
                    // 🔹 Personalizar el label contenedor
                    $('.dt-length label')
                        .addClass('fw-semibold')
                        .css({
                            fontSize: '1rem',
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center',
                            gap: '8px'
                        });
                }
            });
            // ✅ Personalizar el paginador dinámicamente en cada render
            table.on('draw', function() {
                let paginate = $('.dt-paging');
                let info = table.page.info();
                // Estilo general del contenedor
                paginate.addClass('d-flex justify-content-center mt-3 gap-2');
                // Aplicar estilos a los botones
                paginate.find('.dt-paging-button').each(function() {
                    $(this).addClass('btn btn-sm rounded-pill shadow-sm border-0 mx-1');
                    // Colores base y hover
                    if (!$(this).hasClass('disabled')) {
                        $(this).css({
                            background: '#f8f9fa',
                            color: '#007bff',
                            transition: 'all 0.3s ease'
                        }).hover(
                            function() {
                                $(this).css({
                                    background: '#007bff',
                                    color: '#fff'
                                });
                            },
                            function() {
                                $(this).css({
                                    background: '#f8f9fa',
                                    color: '#007bff'
                                });
                            }
                        );
                    }
                    // 🔹 Resaltar página activa
                    if ($(this).hasClass('current')) {
                        $(this).css({
                            background: '#007bff',
                            color: '#fff',
                            fontWeight: 'bold',
                            boxShadow: '0 0 10px rgba(0,123,255,0.3)'
                        });
                    }
                });
                // 🔹 Mostrar texto de página actual
                $('#page-info').remove();
                paginate.after(`
                    <div id="page-info" class="text-center mt-2 fw-semibold text-primary">
                        Página ${info.page + 1} de ${info.pages}
                    </div>
                `);
            });
        });
        $('.showRecords').on('click', function() {
            $('.containerRecords').css('display', 'block')
            $('.containerRecordsObs').css('display', 'none')
        })
        $('.showObs').on('click', function() {
            $('#tableCatObs').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: "{{ url('ct2/list') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'idCao'
                    },
                    {
                        data: 'ins'
                    },
                    {
                        data: 'nombreEnc'
                    },
                    {
                        data: 'obs'
                    },
                    {
                        data: 'fechaEnc'
                    },
                    {
                        data: 'imagenes',
                        render: function(data, type, row) {
                            if (!data || data.length === 0) {
                                return `
                            <div class="text-muted text-center">
                                <i class="fa-solid fa-image-slash"></i><br>
                                Sin imagen
                            </div>
                        `;
                            }
                            let html = '<div class="d-flex flex-wrap">';
                            data.forEach((img, index) => {
                                html += `
                            <img src="${img}"
                                data-index="${index}"
                                data-id="${row.idCao}"
                                class="img-thumb me-1 mb-1"
                                style="width:60px; height:60px; object-fit:cover; cursor:pointer;">
                        `;
                            });
                            html += '</div>';
                            return html;
                        }
                    },
                    {
                        data: 'idCat',
                        render: function(data) {
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
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
                },

                pageLength: 3
            });
            $('.containerRecordsObs').css('display', 'block')
            $('.containerRecords').css('display', 'none')
        });

        function showFile_eliminar(idCat) {
            $(".containerSpinner").removeClass("d-none");
            $(".containerSpinner").addClass("d-flex");
            jQuery.ajax({
                url: "{{ url('catastro/showFile') }}",
                method: 'post',
                data: {
                    idCat: idCat
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(r) {
                    $(".containerSpinner").removeClass("d-flex");
                    $(".containerSpinner").addClass("d-none");
                },
                error: function(xhr, status, error) {
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

        function deleteRecords(idCat) {
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
                if (result.isConfirmed) {
                    $(".containerSpinner").removeClass("d-none");
                    $(".containerSpinner").addClass("d-flex");
                    jQuery.ajax({
                        url: "{{ url('catastro/deleteReg') }}",
                        method: 'post',
                        data: {
                            idCat: idCat
                        },
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(r) {
                            console.log(r)
                            Swal.fire({
                                title: r.message,
                                icon: r.success ? "success" : "error",
                                timer: 2000
                            });
                            if (r.success) {
                                $('#tableCat').DataTable().ajax.reload(null, false);
                            }
                            $(".containerSpinner").removeClass("d-flex");
                            $(".containerSpinner").addClass("d-none");
                        },
                        error: function(xhr, status, error) {
                            alert("Algo salio mal, porfavor contactese con el Administrador.");
                            $(".containerSpinner").removeClass("d-flex");
                            $(".containerSpinner").addClass("d-none");
                        }
                    });
                } else
                    $(ele).prop('checked', false);
            });
        }

        function fillRecords() {
            $(".containerSpinner").removeClass("d-none").addClass("d-flex");
            jQuery.ajax({
                url: "{{ url('catastro/list') }}",
                method: 'get',
                success: function(r) {
                    if (r.state) {
                        $('#recordsAssign').html('');
                        let html = '';
                        let month = '';
                        for (var i = 0; i < r.data.length; i++) {
                            html += '<tr>' +
                                '<td class="align-middle text-center">' + i + '</td>' +
                                '<td class="align-middle text-center">' + novDato(r.data[i].u4) + '</td>' +
                                '<td class="align-middle text-center">' + novDato(r.data[i].nombreEnc) +
                                '</td>' +
                                '<td class="align-middle text-center">' + novDato(r.data[i].ficha) + '</td>' +
                                '<td class="align-middle text-center">' + novDato(r.data[i].d2) + '</td>' +
                                '<td class="align-middle text-center">' + novDato(r.data[i].d7) + '</td>' +
                                '<td class="align-middle text-center">' + novDato(r.data[i].t1) + '</td>' +
                                '<td class="align-middle text-center">' + novDato(r.data[i].ci1) + '</td>' +
                                '<td class="align-middle text-center">' + imgFro(r.data[i].frontis) + '</td>' +
                                '<td class="align-middle text-center">' + imgAgu(r.data[i].agua) + '</td>' +
                                '<td class="align-middle text-center">' + imgAlc(r.data[i].alc) + '</td>' +
                                '<td class="align-middle text-center">' + imgUbi(r.data[i].ubicacion) +
                                '</td>' +
                                '<td class="align-middle text-center">' +
                                '<button class="btn btn-primary" onclick="edit(' + r.data[i].idCat +
                                ')"><i class="fa fa-edit"></i></button>' +
                                '<button class="btn btn-danger btn-delete" onclick="deleteRecords(' + r.data[i]
                                .idCat + ')"><i class="fa fa-trash"></i></button>' +
                                '</td>' +
                                '</tr>';
                        }
                        initDatatable('tableCat')
                        $('#recordsAssign').html(html);
                        tippy('.btn-delete', {
                            content: 'Eliminar asignacion',
                            placement: 'top'
                        });
                    } else
                        alert(r.message);
                    $(".containerSpinner").removeClass("d-flex").addClass("d-none");
                },
                error: function(xhr, status, error) {
                    console.log("Algo salio mal, porfavor contactese con el Administrador.");
                }
            });
        }

        function edit(id) {
            $('#mEditar').modal('show')
        }
    </script>
    <script>
        let imagenesActuales = [];
        let indiceActual = 0;
        $(document).on('click', '.img-thumb', function() {
            const id = $(this).data('id');
            const index = $(this).data('index');
            // 🧠 Obtener los datos del registro desde la fila del DataTable
            const table = $('#tableCatObs').DataTable();
            const rowData = table.rows().data().toArray().find(r => r.idCao == id);
            if (!rowData || !rowData.imagenes) return;
            imagenesActuales = rowData.imagenes;
            indiceActual = index;
            // Mostrar imagen seleccionada
            $('#imgGrande').attr('src', imagenesActuales[indiceActual]);
            $('#modalGaleria').modal('show');
        });
        // Botones de navegación
        $('#btnPrev').on('click', function() {
            if (imagenesActuales.length > 0) {
                indiceActual = (indiceActual - 1 + imagenesActuales.length) % imagenesActuales.length;
                $('#imgGrande').attr('src', imagenesActuales[indiceActual]);
            }
        });
        $('#btnNext').on('click', function() {
            if (imagenesActuales.length > 0) {
                indiceActual = (indiceActual + 1) % imagenesActuales.length;
                $('#imgGrande').attr('src', imagenesActuales[indiceActual]);
            }
        });
    </script>
    <script>
        let currentImages = [];
        let currentIndex = 0;

        function openImageModal(images, index = 0) {
            currentImages = images; // array de rutas
            currentIndex = index; // índice actual
            $('#modalImage').attr('src', images[index]);
            $('#imgModal').modal('show');
        }
        // Botones de navegación
        $('#prevImg').click(function() {
            if (currentIndex > 0) {
                currentIndex--;
                $('#modalImage').attr('src', currentImages[currentIndex]);
            }
        });
        $('#nextImg').click(function() {
            if (currentIndex < currentImages.length - 1) {
                currentIndex++;
                $('#modalImage').attr('src', currentImages[currentIndex]);
            }
        });
    </script>
    <script>
        function imgFro(data) {
            if (data && data !== '') {
                let url = `/storage/${data}`;
                return `<img src="${url}" class="img-thumbnail" width="70" height="70"
                    style="cursor:pointer;" onclick="openImageModal(['${url}'],0)">`;
            }
            return '<span class="text-muted">Sin imagen</span>';
        }

        function imgAgu(data) {
            if (data && data !== '') {
                let url = `/storage/${data}`;
                return `<img src="${url}" class="img-thumbnail" width="70" height="70"
                    style="cursor:pointer;" onclick="openImageModal(['${url}'],0)">`;
            }
            return '<span class="text-muted">Sin imagen</span>';
        }

        function imgAlc(data) {
            if (data && data !== '') {
                let url = `/storage/${data}`;
                return `<img src="${url}" class="img-thumbnail" width="70" height="70"
                    style="cursor:pointer;" onclick="openImageModal(['${url}'],0)">`;
            }
            return '<span class="text-muted">Sin imagen</span>';
        }

        function imgUbi(data) {
            if (data && data !== '') {
                let url = `/storage/${data}`;
                return `<img src="${url}" class="img-thumbnail" width="70" height="70"
                    style="cursor:pointer;" onclick="openImageModal(['${url}'],0)">`;
            }
            return '<span class="text-muted">Sin imagen</span>';
        }
    </script>
    <script src="{{ asset('plugins/datatables/dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.dataTables.js') }}"></script>
@endsection
