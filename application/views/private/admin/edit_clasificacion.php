<center><?php if (isset($error)) echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; ?></center>
<form class="form-horizontal" id="addClasificacion" action="<?php echo base_url(); ?>administrador/edit_clasificacion/<?php echo $id_clasificacion; ?>" method="post">
    <div class="form-group">
        <label for="id_clasificacion" class="col-sm-3 control-label">Id Clasificación</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="id_clasificacion" readonly="" maxlength="13" placeholder="Escriba el Id Clasificación" value="<?php if(isset($id_clasificacion)){echo $id_clasificacion;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="clasificacion" class="col-sm-3 control-label">Clasificación </label>
        <div class="col-sm-3">
            <select class="form-control" name="clasificacion">
                <option value=""></option>
                <option value="docencia" <?php if(isset($clasificacion) and $clasificacion == "docencia"){echo "selected"; } ?>>Docencia</option>
                <option value="investigacion" <?php if(isset($clasificacion) and $clasificacion == "investigacion"){echo "selected"; } ?>>Investigación</option>
                <option value="tutoria" <?php if(isset($clasificacion) and $clasificacion == "tutoria"){echo "selected"; } ?>>Tutoria y dirección individualizada de estudiantes</option>
                <option value="gestion_aca" <?php if(isset($clasificacion) and $clasificacion == "gestion_aca"){echo "selected"; } ?>>Gestión académica-vinculación</option>
                <option value="formacion" <?php if(isset($clasificacion) and $clasificacion == "formacion"){echo "selected"; } ?>>Formación disciplinaria y pedagogica delporfesor</option>
                <option value="otras" <?php if(isset($clasificacion) and $clasificacion == "otras"){echo "selected"; } ?>>Otras Actividades</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="descripcion" class="col-sm-3 control-label">Descripción </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="descripcion" maxlength="50" placeholder="Escriba la Descripción" value="<?php if(isset($descripcion)){echo $descripcion;} ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="actividad" class="col-sm-3 control-label">Actividad </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="actividad" maxlength="50" placeholder="Escriba la Actividad" value="<?php if(isset($actividad)){echo $actividad;} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Editar Datos</button>
        </div>
    </div>

</form>

