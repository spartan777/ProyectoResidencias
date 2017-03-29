<table class="table table-hover">
    <thead>
    <th>Id Jefe</th>
    <th>Nombre</th>
    <th>Paterno</th>
    <th>Materno</th>
    <th>Carrera</th>
    <th>Correo</th>
    <th>Estatus</th>
    <th>Ultimo Periodo</th>
    <th>Editar</th>
    <th>Eliminar</th>
</thead>
<tbody>
    <?php if ($result->num_rows > 0) {
        foreach ($result->result() as $row) {
            $this->load->model('carrera_model');
            $this->load->model('periodo_model');
            //$query = $this->carrera_model->count_carrera_of_jefe($row->id_carrera);
            $queryNombre = $this->carrera_model->select_name_carrera($row->id_carrera);
            $queryPeriodo = $this->periodo_model->get_periodo_by_id($row->id_periodo);
            foreach ($queryNombre->result() as $carrera){
                $nombreCarrera = $carrera->nombre_carrera;
            }
            
            foreach($queryPeriodo->result() as $periodo){
                $nombrePeriodo = $periodo->descripcion;
            }
            
            $query = $this->jefe_carrera_model->count_jefe_of_bitacora($row->id_usuario);
           if($query > 0){
                $visibleRef = "style='visibility:hidden'";
            }else{
                $visibleRef = "";
            }
            ?>
            <tr class="info">
                <td><?php echo $row->id_usuario; ?></td>
                <td><?php echo $row->nombre; ?></td>
                <td><?php echo $row->ape_paterno; ?></td>
                <td><?php echo $row->ape_materno; ?></td>
                <td><?php echo $nombreCarrera; ?></td>
                <td><?php echo $row->correo; ?></td>
                <td><?php if($row->estatus == 1){ echo "Activo"; }else{ echo "Inactivo";} ?></td>
                <td><?php if($row->id_periodo != NULL){ echo $nombrePeriodo; } ?></td>
                <td><a href="<?php echo base_url() ?>administrador/editar_jefe_carrera/<?php echo $row->id_usuario; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a <?php echo $visibleRef; ?> onclick="confirmarDeleteJefeCarrera('<?php echo $row->id_usuario; ?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
    <?php }
} else { ?>
        <tr class="danger">
            <td>No hay registros</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
<?php } ?>
</tbody>
</table>

<!-- Modal eliminar-->
<div class="modal fade" id="modalDeleteJefeCarrera" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
           <div class="modal-body" id="cuerpoEliminarJefeCarrera"></div>
            <div class="modal-footer">
                <a id="rutaEliminarJefeCarrera" href=""><button type="button"
                                                         class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Aceptar</button></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Close</button>
            </div>
        </div>
    </div>
</div>

