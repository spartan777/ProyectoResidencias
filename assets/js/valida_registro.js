with(document.registro){
	onsubmit = function(e){
		e.preventDefault();
		ok = true;
		if(ok && txtUsuario.value==""){
			ok=false;
			alert("Debe escribir un nombre de usuario");
			txtUsuario.focus();
		}
		if(ok &&txtApe_Pat.value==""){
			ok=false;
			alert("Debe escribir su Apellido Paterno");
			txtApe_Pat.focus();
		}
		if(ok && txtApe_Mat.value==""){
			ok=false;
			alert("Debe escribir su Apellido Materno");
			txtApe_Mat.focus();
		}
		if(ok && txtCorreo.value==""){
			ok=false;
			alert("Debe escribir su Correo");
			txtCorreo.focus();
		}
		if(ok && txtContrasena.value==""){
			ok=false;
			alert("Debe escribir su contrasena");
		txtContrasena.focus();
		}
        if(ok && txtConf.value==""){
			ok=false;
			alert("Debe escribir su confirmacion de  contrasena");
		txtConf.focus();
		}


		
		if(ok){ submit(); }
	}
}
