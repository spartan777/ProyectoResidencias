<div class="alert alert-info" role="alert"><center><strong>Catedrático:</strong> <?php echo $nombre; ?>  &nbsp;<strong>Horas de Apoyo:</strong><?php echo $horas_apoyo; ?></center></div>

<center><form class="form-inline" id="addDetalleActividad" action="<?php echo base_url(); ?>jefe_carrera/add_detalle_actividad" method="post">
        <div class="form-group">
            <label for="clasificacion" class="col-sm-3 control-label">Clasificación </label>
            <div class="col-sm-3">
                <select class="form-control" name="clasificacion" id="clasificacion">
                    <option value=""></option>
                    <option value="docencia" <?php if (isset($clasificacion) and $clasificacion == "docencia") {
    echo "selected";
} ?>>Docencia</option>
                    <option value="investigacion" <?php if (isset($clasificacion) and $clasificacion == "investigacion") {
    echo "selected";
} ?>>Investigación</option>
                    <option value="tutoria" <?php if (isset($clasificacion) and $clasificacion == "tutoria") {
    echo "selected";
} ?>>Tutoria y dirección individualizada de estudiantes</option>
                    <option value="gestion_aca" <?php if (isset($clasificacion) and $clasificacion == "gestion_aca") {
    echo "selected";
} ?>>Gestión académica-vinculación</option>
                    <option value="formacion" <?php if (isset($clasificacion) and $clasificacion == "formacion") {
    echo "selected";
} ?>>Formación disciplinaria y pedagogica delporfesor</option>
                    <option value="otras" <?php if (isset($clasificacion) and $clasificacion == "otras") {
                    echo "selected";
                } ?>>Otras Actividades</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="actividad" class="col-sm-3 control-label">Actividad </label>
            <div class="col-sm-3">
                <select class="form-control" name="actividad" id="actividad">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="id_dia_semana">Dia semana:</label>
            <select class="form-control" name="id_dia_semana">
                <option value=""></option>
                    <?php
                    if (isset($resultDiaSemana)) {
                        foreach ($resultDiaSemana->result() as $row) {
                            ?>
                        <option <?php
                            if (isset($id_dia_semana) && $id_dia_semana == $row->id_dia_semana) {
                                echo "selected";
                            }
                            ?> value="<?php echo $row->id_dia_semana ?>"><?php echo $row->desc_dia_semana ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_horario">Horario:</label>
            <select class="form-control" name="id_horario">
                <option value=""></option>
                    <?php
                    if (isset($resultHorario)) {
                        foreach ($resultHorario->result() as $row) {
                            ?>
                        <option <?php
                            if (isset($id_horario) && $id_horario == $row->id_horario) {
                                echo "selected";
                            }
                            ?> value="<?php echo $row->id_horario ?>"><?php echo $row->desc_horario ?></option>
        <?php
    }
}
?>
            </select>
        </div>
        <input type="hidden" name="id_catedratico" value="<?php echo $id_catedratico ?>">
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
    <?php if (isset($error)) {
        echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>';
    } ?></center>
<br><br>
<table class="table table-hover">
    <thead>
    <th>Clasificación</th>
    <th>Descripción</th>
    <th>Actividad</th>
    <th>Día</th>
    <th>Hora</th>
</thead>
<tbody>
<?php
if ($resultTabla->num_rows > 0) {
    foreach ($resultTabla->result() as $row) {
        /* $this->load->model('carrera_model');
          $query = $this->carrera_model->count_carrera_of_jefe($row->id_carrera);

          if($query > 0){
          $visibleRef = "style='visibility:hidden'";
          }else{
          $visibleRef = "";
          } */
        ?>
            <tr class="info">
                <td><?php
                    switch ($row->clasificacion) {
                        case "docencia": echo "Docencia";
                            break;
                        case "investigacion": echo "Investigación";
                            break;
                        case "tutoria": echo "Tutoria y dirección individualizada de estudiantes";
                            break;
                        case "gestion_aca": echo "Gestión académica-vinculación";
                            break;
                        case "formacion": echo "Formación disciplinaria y pedagogica delporfesor";
                            break;
                        case "otras": echo "Otras Actividades";
                            break;
                    }
                    ?></td>
                <td><?php echo $row->descripcion; ?></td>
                <td><?php echo $row->actividad; ?></td>
                <td><?php echo $row->dia; ?></td>
                <td><?php echo $row->hora; ?></td>
                <!--<td><a href="<?php //echo base_url()  ?>jefe_carrera/editar_grupo/<?php //echo $row->id_grupo;  ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a <?php //echo $visibleRef;    ?> onclick="confirmarDeleteGrupo('<?php //echo $row->id_grupo;  ?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
                -->
            </tr>
        <?php
    }
} else {
    ?>
        <tr class="danger">
            <td>No hay registros</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
<?php } ?>
</tbody>
</table>

<?php
if ($resultTabla->num_rows > 0) {
    ?>
    <a href="<?php echo base_url() ?>jefe_carrera/descargar_horario/<?php echo $id_catedratico; ?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-download"></span>&nbsp;Descargar Horario</button></a>
    <?php
}
?>

