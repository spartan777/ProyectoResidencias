<table class="table table-hover">
    <thead>
    <th>Id Catedrático</th>
    <th>Nombre</th>
    <th>Paterno</th>
    <th>Materno</th>
    <th>Carrera</th>
    <th>Correo</th>
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
            
           /*if($query > 0){
                $visibleRef = "style='visibility:hidden'";
            }else{
                $visibleRef = "";
            }*/
            ?>
            <tr class="info">
                <td><?php echo $row->id_catedratico; ?></td>
                <td><?php echo $row->nombre; ?></td>
                <td><?php echo $row->ape_paterno; ?></td>
                <td><?php echo $row->ape_materno; ?></td>
                <td><?php echo $nombreCarrera; ?></td>
                <td><?php echo $row->correo; ?></td>
                <td><a href="<?php echo base_url() ?>jefe_carrera/editar_catedratico/<?php echo $row->id_catedratico; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a <?php //echo $visibleRef; ?> onclick="confirmarDeleteCatedraticoByJefe('<?php echo $row->id_catedratico; ?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
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
<div class="modal fade" id="modalDeleteCatedratico" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
           <div class="modal-body" id="cuerpoEliminarCatedratico"></div>
            <div class="modal-footer">
                <a id="rutaEliminarCatedratico" href=""><button type="button"
                                                         class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Aceptar</button></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Close</button>
            </div>
        </div>
    </div>
</div>

