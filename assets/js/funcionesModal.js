function confirmarDeleteCarrera(clave_acceso) {
	document.getElementById("cuerpoEliminarCarrera").innerHTML = "¿Desea eliminar la carrera con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarCarrera").href = "delete_carrera/" + clave_acceso + "";
	$('#modalDeleteCarrera').modal('show');
}

function confirmarDeleteJefeCarrera(clave_acceso) {
	document.getElementById("cuerpoEliminarJefeCarrera").innerHTML = "¿Desea eliminar el jefe de carrera con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarJefeCarrera").href = "delete_jefe_carrera/" + clave_acceso + "";
	$('#modalDeleteJefeCarrera').modal('show');
}

function confirmarDeleteCatedratico(clave_acceso) {
	document.getElementById("cuerpoEliminarCatedratico").innerHTML = "¿Desea eliminar el Catedrático con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarCatedratico").href = "delete_catedratico/" + clave_acceso + "";
	$('#modalDeleteCatedratico').modal('show');
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
