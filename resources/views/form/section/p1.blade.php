<div class="form-group col-lg-12">
    <div class="alert alert-primary py-1">
        <p class="m-0">1.- DATOS DE CONEXION:</p>
    </div>
</div>
<div class="form-group col-lg-4">
    <label class="m-0">Tipo de cliente catastro: <span class="text text-info small font-weight-bold tipoCliente"></span>       </label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <select class="form-control sel" id="u1" name="u1">
            <option value="0" disabled selected>Seleccione...</option>
            <option value="ANTIGUO">ANTIGUO</option>
            <option value="NUEVO">NUEVO</option>
        </select>
    </div>
</div>
<div class="form-group col-lg-4">
    <label class="m-0">Situacion de la conexion:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <select class="form-control sel" id="u2" name="u2">
            <option value="0" disabled selected>Seleccione...</option>
            <option value="ACTIVO">ACTIVO</option>
            <option value="INACTIVO">INACTIVO</option>
            <option value="CORTADO">CORTADO</option>
            <option value="CONEXION DIRECTA">CONEXION DIRECTA</option>
        </select>
    </div>
</div>
<div class="form-group col-lg-4">
    <label class="m-0">Condicion de la conexion:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <select class="form-control" id="u3" name="u3">
            <option value="0" disabled>Seleccione...</option>
            <option value="ACTIVO" selected>ACTIVO</option>
        </select>
    </div>
</div>
<div class="form-group col-lg-4">
    <label class="m-0">Nª de inscripcion:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <input type="text" id="u4" name="u4" class="form-control onlyNumbers input" maxlength="8" minlength="8">
    </div>
</div>
<div class="form-group col-lg-4">
    <label class="m-0">Manzana:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <input type="text" class="form-control input" id="u5" name="u5">
    </div>
</div>
<div class="form-group col-lg-4">
    <label class="m-0">Lote:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <input type="text" class="form-control input" id="u6" name="u6">
    </div>
</div>
