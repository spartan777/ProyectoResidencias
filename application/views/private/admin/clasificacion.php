<table class="table table-hover">
    <thead>
    <th>Id Clasificación</th>
    <th>Clasificación</th>
    <th>Descripción</th>
    <th>Actividad</th>
    <th>Editar</th>
    <th>Eliminar</th>
</thead>
<tbody>
    <?php
    if ($result->num_rows > 0) {
        foreach ($result->result() as $row) {
            /* $query = $this->carrera_model->count_carrera_of_jefe($row->id_carrera);
              $queryMateria = $this->carrera_model->count_carrera_of_materia($row->id_carrera);
              $queryGrupo = $this->carrera_model->count_carrera_of_grupo($row->id_carrera);
              $queryCate = $this->carrera_model->count_carrera_of_catedratico($row->id_carrera);

              if($query > 0 OR $queryMateria > 0 OR $queryGrupo > 0 OR $queryCate > 0){
              $visibleRef = "style='visibility:hidden'";
              }else{
              $visibleRef = "";
              } */
            ?>
            <tr class="info">
                <td><?php echo $row->id_clasificacion; ?></td>
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
                        case "otros": echo "Otras Actividades";
                            break;
                    }
                    ?></td>
                <td><?php echo $row->descripcion; ?></td>
                <td><?php echo $row->actividad; ?></td>
                <td><a href="<?php echo base_url() ?>administrador/editar_clasificacion/<?php echo $row->id_clasificacion; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a <?php //echo $visibleRef;  ?> onclick="confirmarDeleteClasificacion('<?php echo $row->id_clasificacion; ?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
        <?php }
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

<!-- Modal eliminar-->
<div class="modal fade" id="modalDeleteClasificacion" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" id="cuerpoEliminarClasificacion"></div>
            <div class="modal-footer">
                <a id="rutaEliminarClasificacion" href=""><button type="button"
                                                                  class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Aceptar</button></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Close</button>
            </div>
        </div>
    </div>
</div>

