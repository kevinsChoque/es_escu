<div class="form-group col-lg-12">
    <div class="alert alert-primary py-1">
        <p class="m-0">5.- UNIDADES DE USO:</p>
    </div>
</div>
<div class="form-group col-lg-4">
    <label class="m-0">Tarifa:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <select class="form-control sel" id="ci1" name="ci1">
            <option value="0" disabled selected>Seleccione...</option>
            <option value="17-DOMESTICO">17-DOMESTICO</option>
            <option value="18-DOMESTICO">18-DOMESTICO</option>
            <option value="25-COMERCIAL">25-COMERCIAL</option>
            <option value="43-INDUSTRIAL">43-INDUSTRIAL</option>
            <option value="64-ESTATAL">64-ESTATAL</option>
            <option value="1-SOCIAL">1-SOCIAL</option>
        </select>
    </div>
</div>
<div class="form-group col-lg-4">
    <label class="m-0">Nª de usos:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <select class="form-control sel" id="ci2" name="ci2">
            <option value="0" disabled selected>Seleccione...</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
    </div>
</div>
<div class="form-group col-lg-4">
    <label class="m-0">Actividad:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <select class="form-control sel" id="ci3" name="ci3">
            <option value="0" disabled selected>Seleccione...</option>
            <option value="VIVIENDA">VIVIENDA</option>
            <option value="OTRO">OTRO</option>
        </select>
    </div>
</div>
<div class="form-group col-lg-4" style="display: none;">
    <label class="m-0">(OTRO) Ingrese actividad:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
        </div>
        <input type="text" class="form-control input" id="ci4" name="ci4">
    </div>
</div>
<div class="form-group col-lg-12">
    <div class="alert alert-primary py-1">
        <p class="m-0">6.- PANEL FOTOGRAFICO:</p>
    </div>
</div>
<style>
    .limpiar{cursor: pointer;}
</style>
<div class="col-lg-6">
    <div class="form-group">
        <label>Imagen de frontis: <span class="fas fa-broom text-info limpiar" onclick="limpiarFrontis()"></span></label>
        <input type="file" class="form-control-file" id="frontis" name="frontis" accept="image/*">
    </div>
    <div id="previewFrontis" class="mt-3 row"></div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Imagen de conexion de agua: <span class="fas fa-broom text-info limpiar" onclick="limpiarAgua()"></span></label>
        <input type="file" class="form-control-file" id="agua" name="agua" accept="image/*">
    </div>
    <div id="previewAgua" class="mt-3 row"></div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Image de conexion de alcantarillado: <span class="fas fa-broom text-info limpiar" onclick="limpiarAlc()"></span></label>
        <input type="file" class="form-control-file" id="alc" name="alc" accept="image/*">
    </div>
    <div id="previewAlc" class="mt-3 row"></div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Imagen de croquis de ubicacion: <span class="fas fa-broom text-info limpiar" onclick="limpiarUbicacion()"></span></label>
        <input type="file" class="form-control-file" id="ubicacion" name="ubicacion" accept="image/*">
    </div>
    <div id="previewUbi" class="mt-3 row"></div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function limpiarFrontis()
    {$('#frontis').val('');$('#previewFrontis').html('');}
    function limpiarAgua()
    {$('#agua').val('');$('#previewAgua').html('');}
    function limpiarAlc()
    {$('#alc').val('');$('#previewAlc').html('');}
    function limpiarUbicacion()
    {$('#ubicacion').val('');$('#previewUbi').html('');}

    $('#frontis').on('change', function () {
        $('#previewFrontis').html('');
        const files = this.files;
        if (files) {
            [].forEach.call(files, function(file) {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail m-2').css({
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
    $('#agua').on('change', function () {
        $('#previewAgua').html('');
        const files = this.files;
        if (files) {
            [].forEach.call(files, function(file) {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail m-2').css({
                        width: '150px',
                        height: '150px',
                        objectFit: 'cover'
                    });
                    $('#previewAgua').append(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });
    $('#alc').on('change', function () {
        $('#previewAlc').html('');
        const files = this.files;
        if (files) {
            [].forEach.call(files, function(file) {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail m-2').css({
                        width: '150px',
                        height: '150px',
                        objectFit: 'cover'
                    });
                    $('#previewAlc').append(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });
    $('#ubicacion').on('change', function () {
        $('#previewUbi').html('');
        const files = this.files;
        if (files) {
            [].forEach.call(files, function(file) {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail m-2').css({
                        width: '150px',
                        height: '150px',
                        objectFit: 'cover'
                    });
                    $('#previewUbi').append(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });
    $('#ci3').on('change',function(){
        if($(this).val()=='OTRO')
            $('#ci4').parent().parent().css('display','block')
        else
            $('#ci4').parent().parent().css('display','none')
    })
</script>

