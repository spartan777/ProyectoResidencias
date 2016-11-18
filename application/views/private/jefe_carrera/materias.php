<table class="table table-hover">
    <thead>
    <th>Id Materia</th>
    <th>Nombre Materia</th>
    <th>Carrera</th>
    <th>Creditos</th>
    <th>Horas Teoricas</th>
    <th>Horas Practicas</th>
    <th>Editar</th>
    <th>Eliminar</th>
</thead>
<tbody>
    <?php if ($result->num_rows > 0) {
        foreach ($result->result() as $row) {
            $queryNombre = $this->carrera_model->select_name_carrera($row->id_carrera);
            
            foreach ($queryNombre->result() as $carrera){
                $nombreCarrera = $carrera->nombre_carrera;
            }
            /*$this->load->model('carrera_model');
            $query = $this->carrera_model->count_carrera_of_jefe($row->id_carrera);
            
            if($query > 0){
                $visibleRef = "style='visibility:hidden'";
            }else{
                $visibleRef = "";
            }*/
            ?>
            <tr class="info">
                <td><?php echo $row->id_materia; ?></td>
                <td><?php echo $row->nombre; ?></td>
                <td><?php echo $nombreCarrera; ?></td>
                <td><?php echo $row->creditos; ?></td>
                <td><?php echo $row->horas_teoricas; ?></td>
                <td><?php echo $row->horas_practicas; ?></td>
                <td><a href="<?php echo base_url() ?>jefe_carrera/editar_materia/<?php echo $row->id_materia; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a <?php //echo $visibleRef; ?> onclick="confirmarDeleteMateria('<?php echo $row->id_materia; ?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
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
        </tr>
<?php } ?>
</tbody>
</table>

<!-- Modal eliminar-->
<div class="modal fade" id="modalDeleteMateria" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
           <div class="modal-body" id="cuerpoEliminarMateria"></div>
            <div class="modal-footer">
                <a id="rutaEliminarMateria" href=""><button type="button"
                                                         class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Aceptar</button></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Close</button>
            </div>
        </div>
    </div>
</div>
