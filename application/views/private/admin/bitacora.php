<table class="table table-striped">
    <?php
    if ($bitacora) {
        ?>
        <tr>
            <th>
                Id Usuario
            </th>
            <th>
                Nombre
            </th>
            <th>
                Apellido
            </th>
            <th>
                Fecha
            </th>
            <th>
                Modulo
            </th>
            <th>
                Acción
            </th>
            <th>
                Registro
            </th>
        </tr>
        <?php
        foreach ($bitacora as $row) {
            $result = $this->jefe_carrera_model->get_jefe_carrera_by_id($row->id_usuario);
            foreach ($result->result() as $jefe){
                $nombre = $jefe->nombre;
                $apellido = $jefe->ape_paterno;
            }
            ?>
            <tr>
                <td>
        <?php echo $row->id_usuario ?>
                </td>
                <td>
        <?php echo $nombre ?>
                </td>
                <td>
        <?php echo $apellido ?>
                </td>
                <td>
        <?php echo $row->fecha ?>
                </td>
                <td>
        <?php echo $row->modulo ?>
                </td>
                <td>
        <?php echo $row->accion ?>
                </td>
                <td>
        <?php echo $row->registro ?>
                </td>
            </tr>
        <?php
    }
    ?>
        <?php
    }
    ?>
</table>
    <?php echo $this->pagination->create_links() ?>

