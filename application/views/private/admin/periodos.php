<table class="table table-hover">
    <thead>
    <th>Id Periodo</th>
    <th>Descripción</th>
    <th>Editar</th>
    <th>Eliminar</th>
</thead>
<tbody>
    <?php if ($result->num_rows > 0) {
        foreach ($result->result() as $row) {
            $query = $this->periodo_model->count_periodo_of_detalle($row->id_periodo);
            
            if($query > 0){
                $visibleRef = "style='visibility:hidden'";
            }else{
                $visibleRef = "";
            }
            ?>
            <tr class="info">
                <td><?php echo $row->id_periodo; ?></td>
                <td><?php echo $row->descripcion; ?></td>
                <td><a href="<?php echo base_url() ?>administrador/editar_periodo/<?php echo $row->id_periodo; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a <?php echo $visibleRef; ?> onclick="confirmarDeletePeriodo('<?php echo $row->id_periodo; ?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
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
<div class="modal fade" id="modalDeletePeriodo" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
           <div class="modal-body" id="cuerpoEliminarPeriodo"></div>
            <div class="modal-footer">
                <a id="rutaEliminarPeriodo" href=""><button type="button"
                                                         class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Aceptar</button></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Close</button>
            </div>
        </div>
    </div>
</div>

