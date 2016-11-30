<table class="table table-hover">
    <thead>
    <th>Id Carrera</th>
    <th>Nombre Carrera</th>
    <th>Editar</th>
    <th>Eliminar</th>
</thead>
<tbody>
    <?php if ($result->num_rows > 0) {
        foreach ($result->result() as $row) {
            $query = $this->carrera_model->count_carrera_of_jefe($row->id_carrera);
            $queryMateria = $this->carrera_model->count_carrera_of_materia($row->id_carrera);
            $queryGrupo = $this->carrera_model->count_carrera_of_grupo($row->id_carrera);
            $queryCate = $this->carrera_model->count_carrera_of_catedratico($row->id_carrera);
            
            if($query > 0 OR $queryMateria > 0 OR $queryGrupo > 0 OR $queryCate > 0){
                $visibleRef = "style='visibility:hidden'";
            }else{
                $visibleRef = "";
            }
            ?>
            <tr class="info">
                <td><?php echo $row->id_carrera; ?></td>
                <td><?php echo $row->nombre_carrera; ?></td>
                <td><a href="<?php echo base_url() ?>administrador/editar_carrera/<?php echo $row->id_carrera; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a <?php echo $visibleRef; ?> onclick="confirmarDeleteCarrera('<?php echo $row->id_carrera; ?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
    <?php }
} else { ?>
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

<!-- Modal eliminar-->
<div class="modal fade" id="modalDeleteCarrera" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
           <div class="modal-body" id="cuerpoEliminarCarrera"></div>
            <div class="modal-footer">
                <a id="rutaEliminarCarrera" href=""><button type="button"
                                                         class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Aceptar</button></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Close</button>
            </div>
        </div>
    </div>
</div>

