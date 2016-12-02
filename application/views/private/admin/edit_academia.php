<center><?php if (isset($error)){ echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; }?></center>
<form id="formRegJefeCarrera" class="form-horizontal" action="<?php echo base_url(); ?>administrador/edit_academia/<?php echo $id_academia; ?>" method="post">
        
    <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nombre" maxlength="50" placeholder="Escriba el Nombre del Catedrático" value="<?php if(isset($nombre)){ echo $nombre; } ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="paterno" class="col-sm-3 control-label">Apellido Paterno</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="paterno" maxlength="50" placeholder="Escriba Apellido Paterno" value="<?php if(isset($paterno)){ echo $paterno; } ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="materno" class="col-sm-3 control-label">Apellido Materno</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="materno" maxlength="50" placeholder="Escriba Apellido Materno" value="<?php if(isset($materno)){ echo $materno; } ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="tipo" class="col-sm-3 control-label">Puesto</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="tipo" maxlength="100" readonly="" value="<?php if(isset($tipo)){ echo $tipo; } ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Editar Datos</button>
        </div>
    </div>
</form>

