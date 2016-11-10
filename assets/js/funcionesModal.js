function confirmarDeleteCarrera(clave_acceso) {
	document.getElementById("cuerpoEliminarCarrera").innerHTML = "¿Desea eliminar la carrera con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarCarrera").href = "delete_carrera/" + clave_acceso + "";
	$('#modalDeleteCarrera').modal('show');
}

function confirmarDeleteJefeCarrera(clave_acceso) {
	document.getElementById("cuerpoEliminarJefe").innerHTML = "¿Desea eliminar la carrera con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarJefe").href = "delete_carrera/" + clave_acceso + "";
	$('#modalDeleteJefeCarrera').modal('show');
}

function confirmarCambiarPasJefe(clave_acceso) {
	document.getElementById("tituloCambiarJefe").innerHTML = "Cambiar contraseña del jefe " + clave_acceso;
	document.getElementById("cuerpoCambiarJefe").innerHTML = "Ingrese la nueva contraseña del jefe de carrera: "
			+ clave_acceso + "";
	document.getElementById("rutaCambiarJefe").action = "cambiar_pass_jefe/" + clave_acceso + "";
	$('#modalCambiarJefeCarrera').modal('show');
}

function confirmarDeleteDictamen(nombre_archivo) {
	document.getElementById("tituloEliminarDictamen").innerHTML = "Eliminar " + nombre_archivo;
	document.getElementById("cuerpoEliminarDictamen").innerHTML = "¿Desea eliminar el dictamen con nombre: "
			+ nombre_archivo + "?";
	document.getElementById("rutaEliminarDictamen").href = "eliminar_dictamen/" + nombre_archivo + "";
	$('#modalDeleteDictamen').modal('show');
}
