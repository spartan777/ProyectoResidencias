<center><?php if (isset($error)) echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; ?></center>
<form class="form-horizontal" id="addGrupo" action="<?php echo base_url(); ?>jefe_carrera/edit_grupo/<?php echo $id_grupo; ?>" method="post">
    <div class="form-group">
        <label for="id_salon" class="col-sm-3 control-label">Id Grupo</label>
        <div class="col-sm-6">
            <input type="text" class="form-control"  name="id_salon" maxlength="2" readonly="" value="<?php if(isset($id_grupo)){echo $id_grupo;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre Grupo </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre" maxlength="5"  value="<?php if(isset($nombre)){echo $nombre;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Editar Datos</button>
        </div>
    </div>

</form>



