<center><?php if (isset($error)) echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; ?></center>
<form class="form-horizontal" id="addClasificacion" action="<?php echo base_url(); ?>administrador/add_clasificacion" method="post">
    <div class="form-group">
        <label for="id_clasificacion" class="col-sm-3 control-label">Id Clasificación</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="id_clasificacion" maxlength="13" placeholder="Escriba el Id Clasificación" value="<?php if(isset($id_clasificacion)){echo $id_clasificacion;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="clasificacion" class="col-sm-3 control-label">Clasificación </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="clasificacion" maxlength="50" placeholder="Escriba la Clasificación" value="<?php if(isset($clasificacion)){echo $clasificacion;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="descripcion" class="col-sm-3 control-label">Descripción </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="descripcion" maxlength="50" placeholder="Escriba la Descripción" value="<?php if(isset($descripcion)){echo $descripcion;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="actividad" class="col-sm-3 control-label">Actividad </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="actividad" maxlength="50" placeholder="Escriba la Actividad" value="<?php if(isset($actividad)){echo $actividad;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Ingresar Datos</button>
        </div>
    </div>

</form>

