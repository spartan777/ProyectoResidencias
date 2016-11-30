$(document).ready(function () {
    var validatorAdd = $('#addCarrera').validate({
        rules: {
            id_carrera: {
                required: true
            },
            nombre_carrera: {
                required: true
            }
        }
    });
    
    var validatorAddJefe = $('#formRegJefeCarrera').validate({
        rules: {
            id_usuario: {
                required: true
            },
            nombre: {
                required: true
            },
            ape_paterno: {
                required: true
            },
            ape_materno: {
                required: true
            },
            id_carrera: {
                required: true
            },
            correo: {
                required: true,
                email: true
            },
            contra: {
                required: true
            },
            contra2: {
                equalTo: "#contra"
            }

        }
    });
    
    var validatorAddSalon = $('#addSalon').validate({
        rules: {
            id_salon: {
                required: true
            },
            nombre: {
                required: true
            }
        }
    });
    
    var validatorAddGrupo = $('#addGrupo').validate({
        rules: {
            id_grupo: {
                required: true
            },
            nombre: {
                required: true
            }
        }
    });
    
    var validatorAddMateria = $('#addMateria').validate({
        rules: {
            id_materia: {
                required: true
            },
            nombre: {
                required: true
            },
            creditos: {
                required: true,
                number: true
            },
            horas_teoricas: {
                required: true,
                number: true
            },
            horas_practicas: {
                required: true,
                number: true
            }
        }
    });
    
    var validatorAddclasificacion = $('#addClasificacion').validate({
        rules: {
            id_clasificacion: {
                required: true
            },
            clasificacion: {
                required: true
            },
            descripcion: {
                required: true,
                number: true
            },
            actividad: {
                required: true
            }
        }
    });
    
    var validatorAddDetalleHorario = $('#addDetalleHorario').validate({
        rules: {
            id_grupo: {
                required: true
            },
            id_dia_semana: {
                required: true
            },
            id_horario: {
                required: true,
                number: true
            },
            id_materia: {
                required: true
            },
            id_salon: {
                required: true
            },
            periodo: {
                required: true
            }
        }
    });
    
});