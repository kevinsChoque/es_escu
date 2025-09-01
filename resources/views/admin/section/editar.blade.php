<div class="modal fade" id="mEditar" tabindex="-1" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
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
                <div class="row">
                    {{-- @include('form.section.p0') --}}
                    @include('form.section.p1')
                    @include('form.section.p2')
                    @include('form.section.p3')
                    @include('form.section.p4')
                    @include('form.section.p5')
                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="buscar()">Buscar</button>
            </div>
        </div>
    </div>
</div>
