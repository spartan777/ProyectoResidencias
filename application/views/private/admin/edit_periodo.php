<center><?php if (isset($error)) echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; ?></center>
<form class="form-horizontal" id="addPeriodo" action="<?php echo base_url(); ?>administrador/edit_periodo/<?php echo $id_periodo; ?>" method="post">
    <div class="form-group">
        <label for="id_periodo" class="col-sm-3 control-label">Id Periodo</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="id_periodo" maxlength="10" readonly="" value="<?php if(isset($id_periodo)){echo $id_periodo;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="descripcion" class="col-sm-3 control-label">Descripción </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="descripcion" maxlength="40" placeholder="Escriba la Descripción del Periodo" value="<?php if(isset($descripcion)){echo $descripcion;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Editar Datos</button>
        </div>
    </div>

</form>



