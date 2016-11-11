<center><?php if (isset($error)) echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; ?></center>
<form class="form-horizontal" id="addCarrera" action="<?php echo base_url(); ?>administrador/add_carrera" method="post">
    <div class="form-group">
        <label for="id_carrera" class="col-sm-3 control-label">Id Carrera</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="id_carrera" maxlength="13" placeholder="Escriba el Id Carrera" value="<?php if(isset($id_carrera)){echo $id_carrera;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="nombre_carrera" class="col-sm-3 control-label">Nombre Carrera </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nombre_carrera" maxlength="50" placeholder="Escriba el Nombre Carrera" value="<?php if(isset($nombre_carrera)){echo $nombre_carrera;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Ingresar Datos</button>
        </div>
    </div>

</form>

