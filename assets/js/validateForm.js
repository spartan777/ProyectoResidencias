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
    
    var validatorCambiarJefe = $('#rutaCambiarJefe').validate({
        rules: {
            password2: {
                equalTo: "#passwordCambiar"
            }

        }
    });
    
    $("#closeModalCambiarJefe").click(function(){
        validatorCambiarJefe.resetForm();
	$('#modalCambiarJefeCarrera').modal('hide');
        document.getElementById("passwordCambiar").value = "";
        document.getElementById("password2Cambiar").value = "";
    });
    
    var validatorDatosEmpresa = $('#guardarDatosEmpresa').validate({
       rules:{
           nombre_empresa:{
               required: true
           },
           giro_ramo_sector:{
               required: true
           },
           rfc:{
               required: true
           },
           domicilio:{
               required: true
           },
           colonia:{
               required: true
           },
           codigo_postal:{
               required: true
           },
           fax:{
               required: true
           },
           ciudad:{
               required: true
           },
           telefono:{
               required: true
           },
           mision_empresa:{
               required: true
           },
           nombre_titular:{
               required: true
           },
           puesto_titular:{
               required: true
           },
           asesor_externo:{
               required: true
           },
           puesto_asesor:{
               required: true
           },
           nombre_acuerdo_trabajo:{
               required: true
           },
           puesto_acuerdo_trabajo:{
               required: true
           }
       }    
    });
    var validatorDatosProyecto = $('#guardarDatosProyecto').validate({
       rules:{
           lugar:{
               required: true
           },
           fecha:{
               required: true
           },
           jefe_division:{
               required: true
           },
           nombre_proyecto:{
               required: true
           },
           opcion_proyecto:{
               required: true
           },
           periodo:{
               required: true
           },
           numero_residentes:{
               required: true
           }
       }    
    });
});