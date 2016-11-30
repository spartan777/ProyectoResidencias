<div class="row">
    <?php
    if (isset($result)) {
        foreach ($result->result() as $row) {
            ?>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $row->id_catedratico; ?></div>
                                <div><?php echo $row->nombre . ' ' . $row->ape_paterno . ' ' . $row->ape_materno; ?></div>
                            </div>
                        </div>
                    </div>
                    <a onclick="confirmarAcccion('<?php echo $row->id_catedratico; ?>')" >
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
    <?php }
} ?>
</div>

<!-- Modal eliminar-->
<div class="modal fade" id="modalAccion" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" id="cuerpoAccion"></div>
            <div class="modal-footer">
                <a id="rutaAccionActividad" href=""><button type="button"
                                                            class="btn btn-success"><span class="glyphicon glyphicon-list"></span>&nbsp;Asignar Actividad</button></a>
                <a id="rutaAccionGrupo" href=""><button type="button" 
                                                        class="btn btn-info" ><span class="glyphicon glyphicon-certificate"></span>&nbsp;Asignar Grupo</button></a>
                <a href=""><button type="button" 
                                      class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Cerrar</button></a>
            </div>
        </div>
    </div>
</div>