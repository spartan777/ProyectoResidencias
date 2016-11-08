<!DOCTYPE html>
<html lang="es">

    <head>
        <title>Login</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scale=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asetts/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asetts/css/estiloss.css" />
    </head>

    <body>
        <form>
            <h2>Login</h2>
            <div class="form-group">
                <label for="exampleInputEmail1">Usuario:</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Usuario">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña:</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
            </div>
            <label for="disabledSelect">Tipo de Usuario:</label>
            <select id="disabledSelect" class="form-control">
                <option></option>
                <option>Administrador</option>
                <option>Jefe de Carrera</option>
                <option>Alumno</option>
            </select>


            <input type="Button" class="btn btn-success"  value="Ingresar"/>
        </form>
    </body>
</html>

