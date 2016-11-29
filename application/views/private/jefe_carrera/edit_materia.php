<center><?php if (isset($error)) echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; ?></center>
<form class="form-horizontal" id="addMateria" action="<?php echo base_url(); ?>jefe_carrera/edit_materia/<?php echo $id_materia; ?>" method="post">
    <div class="form-group">
        <label for="id_salon" class="col-sm-3 control-label">Id Materia</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="id_materia" maxlength="8" readonly="" value="<?php if(isset($id_materia)){echo $id_materia;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre Materia </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nombre" maxlength="50"  value="<?php if(isset($nombre)){echo $nombre;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="creditos" class="col-sm-3 control-label">Créditos </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="creditos" maxlength="2"  value="<?php if(isset($creditos)){echo $creditos;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="horas_teoricas" class="col-sm-3 control-label">Horas Teóricas </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="horas_teoricas" maxlength="2"  value="<?php if(isset($horas_teoricas)){echo $horas_teoricas;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="horas_practicas" class="col-sm-3 control-label">Horas Prácticas </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="horas_practicas" maxlength="2"  value="<?php if(isset($horas_practicas)){echo $horas_practicas;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Editar Datos</button>
        </div>
    </div>

</form>



