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
    
    var validatorAddGRupo = $('#addGrupo').validate({
        rules: {
            id_grupo: {
                required: true
            },
            nombre: {
                required: true
            }
        }
    });
    
});