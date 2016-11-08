function registrousuario()
{
    if (txtNombre.value == "") {
        alert("Debe escribir un nombre de usuario");
        txtNombre.focus();
        return (false);
    }
    if (txtAP.value == "") {
        alert("Debe escribir su Apellido Paterno");
        txtAP.focus();
        return (false);
    }
    if (txtAM.value == "") {
        alert("Debe escribir su  Apellido Materno");
        txtAM.focus();
        return (false);
    }
    if (txtCorreo.value == "") {
        alert("Debe escribir su Correo");
        txtCorreo.focus();
        return (false);
    }
    if (txtContraseña.value == "") {
        alert("Debe escribir su contraseña");
        txtContraseña.focus();
        return (false);
    }
    if (txtConf.value == "") {
        alert("Debe escribir su confirmacion de password");
        txtConf.focus();
        return (false);
    }


    if (txtContraseña.value != txtConf.value) {
        alert("Los passwords no coinciden");
        txtConf.focus();
        return (false);
    }

}