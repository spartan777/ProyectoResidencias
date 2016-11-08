function validar_contraseña()
{

    if (txtContraseña.value == "") {
        alert("Complete la Contraseña");
        txtContraseña.focus();
        return (false);
    }
    if (txtConf.value == "") {
        alert("Debe confirmar la contraseña");
        txtConf.focus();
        return (false);
    }

    if (txtContraseña.value != txtConf.value) {
        alert("La contraseña confirmada no concuerda con la contraseña escrita");
        txtConf.focus();
        return (false);
    }
}