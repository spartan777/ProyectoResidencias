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

function confirmarDeleteCatedraticoByJefe(clave_acceso) {
	document.getElementById("cuerpoEliminarCatedratico").innerHTML = "¿Desea eliminar el Catedrático con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarCatedratico").href = "delete_catedratico/" + clave_acceso + "";
	$('#modalDeleteCatedratico').modal('show');
}

function confirmarDeleteSalon(clave_acceso) {
	document.getElementById("cuerpoEliminarSalon").innerHTML = "¿Desea eliminar el salón con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarSalon").href = "delete_salon/" + clave_acceso + "";
	$('#modalDeleteSalon').modal('show');
}

function confirmarDeleteGrupo(clave_acceso) {
	document.getElementById("cuerpoEliminarGrupo").innerHTML = "¿Desea eliminar el grupo con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarGrupo").href = "delete_grupo/" + clave_acceso + "";
	$('#modalDeleteGrupo').modal('show');
}

function confirmarDeleteMateria(clave_acceso) {
	document.getElementById("cuerpoEliminarMateria").innerHTML = "¿Desea eliminar la materia con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarMateria").href = "delete_materia/" + clave_acceso + "";
	$('#modalDeleteMateria').modal('show');
}

function confirmarDeleteClasificacion(clave_acceso) {
	document.getElementById("cuerpoEliminarClasificacion").innerHTML = "¿Desea eliminar la clasificación con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaEliminarClasificacion").href = "delete_clasificacion/" + clave_acceso + "";
	$('#modalDeleteClasificacion').modal('show');
}

function confirmarAcccion(clave_acceso) {
	document.getElementById("cuerpoAccion").innerHTML = "¿Que movimiento desea realizar al catedratico con clave: "
			+ clave_acceso + "?";
	document.getElementById("rutaAccionActividad").href = "asignar_actividad/" + clave_acceso + "";
        document.getElementById("rutaAccionGrupo").href = "asignar_horario/" + clave_acceso + "";
	$('#modalAccion').modal('show');
}