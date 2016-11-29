<center><?php if (isset($error)) echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; ?></center>
<form class="form-horizontal" id="addGrupo" action="<?php echo base_url(); ?>jefe_carrera/add_grupo" method="post">
    <div class="form-group">
        <label for="id_grupo" class="col-sm-3 control-label">Id Grupo</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="id_grupo" maxlength="2" placeholder="Escriba el Id del Grupo" value="<?php if(isset($id_grupo)){echo $id_grupo;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre Grupo </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nombre" maxlength="5" placeholder="Escriba el Nombre de Salón" value="<?php if(isset($nombre)){echo $nombre;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Ingresar Datos</button>
        </div>
    </div>

</form>

