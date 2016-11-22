<div class="row">
    <?php if (isset($result)) {
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
                                <div><?php echo $row->nombre.' '.$row->ape_paterno.' '.$row->ape_materno; ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>jefe_carrera/asignar_horario/<?php echo $row->id_catedratico; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php }} ?>
</div>
