<div class="alert alert-info" role="alert"><center><strong>Catedrático:</strong> <?php echo $nombre; ?>  &nbsp;<strong>Horas Totales:</strong><?php echo $horas_totales; ?> </center></div>

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
        <div class="form-group">
            <label for="periodo">Periodo:</label>
            <select class="form-control" name="periodo">
                <option value=""></option>
                <?php
                if (isset($resultPeriodo)) {
                    foreach ($resultPeriodo->result() as $row) {
                        ?>
                        <option <?php
                        if ((isset($this->session->userdata['id_periodo']) && $this->session->userdata['id_periodo'] == $row->id_periodo) OR ( isset($periodo) && $periodo == $row->id_periodo)) {
                            echo "selected";
                        }
                        ?> value="<?php echo $row->id_periodo ?>"><?php echo $row->descripcion ?></option>
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
    <th>Grupo</th>
    <th>Materia</th>
    <th>Salón</th>
    <th>Día</th>
    <th>Hora</th>
    <th>Período</th>
</thead>
<tbody>
    <?php
    if ($resultTabla->num_rows > 0) {
        foreach ($resultTabla->result() as $row) {
            
            ?>
            <tr class="info">
                <td><?php echo $row->grupo; ?></td>
                <td><?php echo $row->materia; ?></td>
                <td><?php echo $row->salon; ?></td>
                <td><?php echo $row->dia; ?></td>
                <td><?php echo $row->hora; ?></td>
                <td><?php echo $row->periodo; ?></td>
               
                <td><a onclick="confirmarDeleteDetalleHorario('<?php echo $row->detalle;  ?>','<?php echo $id_catedratico; ?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
                
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
            <td></td>
        </tr>
<?php } ?>
</tbody>
</table>

<?php
if ($resultTabla->num_rows > 0) {
    ?>
    <button class="btn btn-primary" data-toggle="modal" data-target="#modalDescargarHorario"><span class="glyphicon glyphicon-download"></span>&nbsp;Descargar Horario</button></a
    <?php
}
?>

<!-- Modal eliminar-->
<div class="modal fade" id="modalDeleteDetalleHorario" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" id="cuerpoDeleteDetalleHorario"></div>
            <form class="form-inline" id="DeleteDetalleHorario" action="<?php echo base_url(); ?>jefe_carrera/delete_detalle_horario" method="post">
                <input type="hidden" id="id_detalle" name="id_detalle" value="">
                <input type="hidden" id="id_catedratico" name="id_catedratico" value="">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;Aceptar</button>
               </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal eliminar-->
<div class="modal fade" id="modalDescargarHorario" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" id="cuerpoDescargarHorario">Elija el periodo a descargar del Horario:</div>
            <form class="form-inline" id="addDetalleActividad" action="<?php echo base_url(); ?>jefe_carrera/descargar_horario" method="post">

                <div class="form-group">
                    <label for="id_periodo">Periodo:</label>
                    <select class="form-control" name="id_periodo" required="">
                        <option value=""></option>
                         <?php
                if (isset($resultPeriodo)) {
                    foreach ($resultPeriodo->result() as $row) {
                        ?>
                        <option <?php
                        if ((isset($this->session->userdata['id_periodo']) && $this->session->userdata['id_periodo'] == $row->id_periodo) OR ( isset($periodo) && $periodo == $row->id_periodo)) {
                            echo "selected";
                        }
                        ?> value="<?php echo $row->id_periodo ?>"><?php echo $row->descripcion ?></option>
                            <?php
                        }
                    }
                    ?>
                    </select>
                </div>
                <input type="hidden" name="id_catedratico" value="<?php echo $id_catedratico ?>">

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Close</button>
            </form>
        </div>
    </div>
</div>
</div>
