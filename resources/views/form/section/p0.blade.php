<div class="form-group col-lg-4">
    <label class="m-0">Fecha de encuesta:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <input type="date" name="fechaEnc" id="fechaEnc" class="form-control" value="{{ $fechaActual->toDateString() }}" disabled>
    </div>
</div>
<div class="form-group col-lg-4">
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
<div class="form-group col-lg-4">
    <label class="m-0">Nª de ficha tecnica:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <input type="text" name="ficha" id="ficha" class="form-control onlyNumbers input">
    </div>
</div>

<script>

</script>
