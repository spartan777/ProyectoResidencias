with(document.registrousuario){
	onsubmit = function(e){
		e.preventDefault();
		ok = true;
		if(ok && NombreUsuario.value==""){
			ok=false;
			alert("Debe escribir un nombre de usuario");
			NombreUsuario.focus();
		}
		if(ok && Ape_Pat.value==""){
			ok=false;
			alert("Debe escribir su Apellido Paterno");
			Ape_Pat.focus();
		}
		if(ok && Ape_Mat.value==""){
			ok=false;
			alert("Debe escribir su Apellido Materno");
			Ape_Mat.focus();
		}
		if(ok && Correo.value==""){
			ok=false;
			alert("Debe escribir su Correo");
			Correo.focus();
		}
		if(ok && Contraseña.value==""){
			ok=false;
			alert("Debe escribir su Contraseña");
		Contraseña.focus();
		}

		if(ok && confirm_password.value==""){
			ok=false;
			alert("Debe escribir su confirmacion de password");
			confirm_password.focus();
		}

		if(ok && Contraseña.value!= confirm_password.value){
			ok=false;
			alert("Los passwords no coinciden");
			confirm_password.focus();
		}


		if(ok){ submit(); }
	}
}
