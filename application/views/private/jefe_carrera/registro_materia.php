<center><?php if (isset($error)){ echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; }?></center>
<form class="form-horizontal" id="addMateria" action="<?php echo base_url(); ?>jefe_carrera/add_materia" method="post">
    <div class="form-group">
        <label for="id_salon" class="col-sm-3 control-label">Id Materia</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="id_materia" maxlength="13" value="<?php if(isset($id_materia)){echo $id_materia;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre Materia </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nombre" maxlength="50"  value="<?php if(isset($nombre)){echo $nombre;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="creditos" class="col-sm-3 control-label">Creditos </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="creditos" maxlength="50"  value="<?php if(isset($creditos)){echo $creditos;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="horas_teoricas" class="col-sm-3 control-label">Horas Teoricas </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="horas_teoricas" maxlength="50"  value="<?php if(isset($horas_teoricas)){echo $horas_teoricas;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="horas_practicas" class="col-sm-3 control-label">Horas Practicas </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="horas_practicas" maxlength="50"  value="<?php if(isset($horas_practicas)){echo $horas_practicas;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Ingresar Datos</button>
        </div>
    </div>

</form>

