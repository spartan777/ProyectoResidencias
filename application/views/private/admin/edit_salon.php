<center><?php if (isset($error)) echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; ?></center>
<form class="form-horizontal" id="addSalon" action="<?php echo base_url(); ?>administrador/edit_salon/<?php echo $id_salon; ?>" method="post">
    <div class="form-group">
        <label for="id_salon" class="col-sm-3 control-label">Id Salón</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="id_salon" maxlength="13" readonly="" value="<?php if(isset($id_salon)){echo $id_salon;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre Salón </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nombre" maxlength="50"  value="<?php if(isset($nombre)){echo $nombre;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Editar Datos</button>
        </div>
    </div>

</form>



