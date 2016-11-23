<div class="alert alert-info" role="alert"><center><strong>Catedrático:</strong> <?php echo $nombre; ?>  &nbsp;<strong>Horas Totales:</strong><?php echo ($horas_teoricas + $horas_practicas); ?> &nbsp;<strong>Horas Teoricas:</strong><?php echo $horas_teoricas; ?> &nbsp;<strong>Horas Praticas:</strong><?php echo $horas_practicas; ?></center></div>

<center><form class="form-inline" id="addDetalleHorario" action="<?php echo base_url(); ?>jefe_carrera/add_detalle_horario" method="post">
        <div class="form-group">
            <label for="id_salon">Grupo:</label>
            <select class="form-control" name="id_grupo">
                <option value=""></option>
                <?php
                if (isset($resultGrupos)) {
                    foreach ($resultGrupos->result() as $row) {
                        ?>
                        <option <?php
                        if (isset($id_grupo) && $id_grupo == $row->id_grupo) {
                            echo "selected";
                        }
                        ?> value="<?php echo $row->id_grupo ?>"><?php echo $row->nombre ?></option>
                            <?php
                        }
                    }
                    ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_materia">Materia:</label>
            <select class="form-control" name="id_materia">
                <option value=""></option>
                <?php
                if (isset($resultMaterias)) {
                    foreach ($resultMaterias->result() as $row) {
                        ?>
                        <option <?php
                            if (isset($id_materia) && $id_materia == $row->id_materia) {
                                echo "selected";
                            }
                            ?> value="<?php echo $row->id_materia ?>"><?php echo $row->nombre ?></option>
        <?php
    }
}
?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_salon">Salon:</label>
            <select class="form-control" name="id_salon">
                <option value=""></option>
                <?php
                if (isset($resultSalones)) {
                    foreach ($resultSalones->result() as $row) {
                        ?>
                        <option <?php
                            if (isset($id_salon) && $id_salon == $row->id_salon) {
                                echo "selected";
                            }
                            ?> value="<?php echo $row->id_salon ?>"><?php echo $row->nombre ?></option>
        <?php
    }
}
?>
            </select>
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
    <?php if (isset($error)){ echo '<br><div style ="color:#FF0000;">' . $error . '</div><br>'; }?></center>
<br><br>
<table class="table table-hover">
    <thead>
    <th>Grupo</th>
    <th>Materia</th>
    <th>Salón</th>
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
                <td><?php echo $row->grupo; ?></td>
                <td><?php echo $row->materia; ?></td>
                <td><?php echo $row->salon; ?></td>
                <td><?php echo $row->dia; ?></td>
                <td><?php echo $row->hora; ?></td>
                <!--<td><a href="<?php //echo base_url() ?>jefe_carrera/editar_grupo/<?php //echo $row->id_grupo; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a <?php //echo $visibleRef;   ?> onclick="confirmarDeleteGrupo('<?php //echo $row->id_grupo; ?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
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

<!--<table class="table table-bordered">
    <thead>
    <th></th>
    <th>Lunes</th>
    <th>Martes</th>
    <th>Miercoles</th>
    <th>Jueves</th>
    <th>Viernes</th>
    <th>Sabado</th>
</thead>
<tbody>

    <tr class="info">
        <td>07:00 - 08:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    <tr class="danger">
        <td>08:00 - 09:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr class="info">
        <td>09:00 - 10:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    <tr class="danger">
        <td>10:00 - 11:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr class="info">
        <td>11:00 - 12:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    <tr class="danger">
        <td>12:00 - 13:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr class="info">
        <td>13:00 - 14:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    <tr class="danger">
        <td>14:00 - 15:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr class="info">
        <td>15:00 - 16:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    <tr class="danger">
        <td>16:00 - 17:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr class="info">
        <td>17:00 - 18:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    <tr class="danger">
        <td>18:00 - 19:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr class="info">
        <td>19:00 - 20:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</tbody>
</table>