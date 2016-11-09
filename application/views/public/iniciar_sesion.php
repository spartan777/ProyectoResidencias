<form class="form-horizontal" action="<?php echo base_url(); ?>welcome/validar_usuario" method="post">
    <div class="form-group">
        <label for="nombre_usuario" class="col-sm-3 control-label">Usuario</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nombre_usuario" placeholder="Usuario">
        </div>
    </div>
    <div class="form-group">
        <label for="pass_usuario" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" name="pass_usuario" placeholder="Password">
        </div>
    </div>

    <div class="form-group">
        <label for="tipo_usuario" class="col-sm-3 control-label">Tipo usuario</label>
        <div class="col-sm-3">
            <select class="form-control" name="tipo_usuario">
            <option value="Admin">Administrador</option>
            <option value="Jefe">Jefe Carrera</option>
        </select>
        </div>
    </div> 

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success">Iniciar Sesión</button>
        </div>
    </div>
</form>