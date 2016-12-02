<table class="table table-hover">
    <thead>
    <th>Nombre</th>
    <th>Paterno</th>
    <th>Materno</th>
    <th>Puesto</th>
    <th>Editar</th>
</thead>
<tbody>
    <?php if ($result->num_rows > 0) {
        foreach ($result->result() as $row) {
            
            ?>
            <tr class="info">
                <td><?php echo $row->nombre; ?></td>
                <td><?php echo $row->paterno; ?></td>
                <td><?php echo $row->materno; ?></td>
                <td><?php echo $row->tipo; ?></td>
                <td><a href="<?php echo base_url() ?>administrador/editar_academia/<?php echo $row->id_academia; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
               
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
