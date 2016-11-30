<div class="alert alert-info" role="alert"><center><strong>Catedrático:</strong> <?php echo $nombre; ?>  &nbsp;<strong>Horas Totales:</strong><?php echo ($horas_teoricas + $horas_practicas); ?> &nbsp;<strong>Horas Teoricas:</strong><?php echo $horas_teoricas; ?> &nbsp;<strong>Horas Praticas:</strong><?php echo $horas_practicas; ?></center></div>

<center><form class="form-inline" id="addDetalleHorario"  method="post">
        <div class="form-group">
            <label for="id_salon">Clasificación:</label>
            <select class="form-control" name="id_salon">
                <option value=""></option>
                <?php
                if (isset($resulClasificacion)) {
                    foreach ($resulClasificacion->result() as $row) {
                        ?>
                        <option <?php
                            if (isset($id_clasificacion) && $id_clasificacion == $row->id_clasificacion) {
                                echo "selected";
                            }
                            ?> value="<?php echo $row->id_clasificacion ?>"><?php echo $row->clasificacion ?></option>
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

