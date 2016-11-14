<center><?php if (isset($error)){ echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; }?></center>
<form id="formRegJefeCarrera" class="form-horizontal" action="<?php echo base_url(); ?>administrador/add_catedratico" method="post">
    <div class="form-group">
        <label for="id_usuario" class="col-sm-3 control-label">Id Catedrático</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="id_usuario" placeholder="Escriba el Id del Catedrático" value="<?php if(isset($id_usuario)){ echo $id_usuario; } ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre Catedrático</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nombre" placeholder="Escriba el Nombre del Catedrático" value="<?php if(isset($nombre)){ echo $nombre; } ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">Apellido Paterno</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="ape_paterno" placeholder="Escriba Apellido Paterno" value="<?php if(isset($ape_paterno)){ echo $ape_paterno; } ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="ape_materno" class="col-sm-3 control-label">Apellido Materno</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="ape_materno" placeholder="Escriba Apellido Paterno" value="<?php if(isset($ape_materno)){ echo $ape_materno; } ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="id_carrera" class="col-sm-3 control-label">Carrera</label>
        <div class="col-sm-3">
            <select class="form-control" name="id_carrera">
                <option value=""></option>
                <?php if (isset($result)) {
                    foreach ($result->result() as $row) {
                        ?>
                <option <?php if(isset($id_carrera) && $id_carrera == $row->id_carrera ){ echo "selected";} ?> value="<?php echo $row->id_carrera ?>"><?php echo $row->nombre_carrera ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div> 

    <div class="form-group">
        <label for="correo" class="col-sm-3 control-label">Correo</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="correo" placeholder="Correo" value="<?php if(isset($correo)){ echo $correo; } ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Guardar</button>
        </div>
    </div>
</form>

