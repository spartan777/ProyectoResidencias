<center><?php if (isset($error)) echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; ?></center>
<form class="form-horizontal" id="addSalon" action="<?php echo base_url(); ?>administrador/add_salon" method="post">
    <div class="form-group">
        <label for="id_salon" class="col-sm-3 control-label">Id Salón</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="id_salon" maxlength="4" placeholder="Escriba el Id de Salón" value="<?php if(isset($id_salon)){echo $id_salon;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre Salón </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre" maxlength="4" placeholder="Escriba el Nombre de Salón" value="<?php if(isset($nombre)){echo $nombre;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Ingresar Datos</button>
        </div>
    </div>

</form>

