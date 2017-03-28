<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('carrera_model');
        $this->load->model('jefe_carrera_model');
        $this->load->model('login_model');
        $this->load->model('catedratico_model');
        $this->load->model('salon_model');
        $this->load->model('bitacora_model');
        $this->load->model('clasificacion_model');
        $this->load->model('periodo_model');
        $this->load->model('academia_model');
    }

    public function index() {
        $data = array(
            'contenido' => "private/admin/welcome",
            'nav' => "navHome",
            'titulo' => "Proyecto Residencias | Zona Administrador",
            'tituloPantalla' => "Bienvenidos a la Página"
        );
        $this->load->view('private/admin/index', $data);
    }

    public function jefe_carrera() {
        $data = array(
            'contenido' => "private/admin/jefe_carrera",
            'nav' => "navJefeCarrera",
            'titulo' => "Proyecto Residencias | Jefes de Carrera",
            'tituloPantalla' => "Jefes de carrera",
            'result' => $this->jefe_carrera_model->get_all_jefe_carrera()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function registro_jefe_carrera() {
        $data = array(
            'contenido' => "private/admin/registro_jefe_carrera",
            'nav' => "navJefeCarrera",
            'titulo' => "Proyecto Residencias | Registro Jefes de Carrera",
            'tituloPantalla' => "Registro de Jefes de Carrera",
            'result' => $this->carrera_model->get_all_carreras(),
            'resultPeriodo' => $this->periodo_model->get_all_periodos()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function add_jefe_carrera() {
        $datosUsuario = array(
            'nombre_usuario' => $this->input->post('correo'),
            'clave_usuario' => $this->input->post('id_usuario'),
            'pass_usuario' => md5($this->input->post('contra')),
            'tipo_usuario' => "Jefe"
        );

        $datosJefe = array(
            'id_usuario' => $this->input->post('id_usuario'),
            'nombre' => $this->input->post('nombre'),
            'ape_paterno' => $this->input->post('ape_paterno'),
            'ape_materno' => $this->input->post('ape_materno'),
            'correo' => $this->input->post('correo'),
            'id_carrera' => $this->input->post('id_carrera'),
            'estatus' => 1
        );
        
        

        $checkIdJefeCarrera = $this->jefe_carrera_model->check_id_jefe_carrera($datosJefe['id_usuario']);
        //$checkNombreJefeCarrera = $this->jefe_carrera_model->check_carrera_jefe_carrera($datosJefe['id_carrera']);
        $checkCorreoJefeCarrera = $this->jefe_carrera_model->check_correo_jefe_carrera($datosJefe['correo']);
        $checkJefeActivo = $this->jefe_carrera_model->check_jefe_carrera_activo($datosJefe['id_carrera']);
        foreach ($checkJefeActivo->result() as $row){
            $idJefeAnterior = $row->id_usuario;
        }
        $datosUpdate = array(
            'estaus' => 2,
            'id_periodo' => $this->input->post('periodo')
        );
        
        if ($checkIdJefeCarrera == 0) {
            if ($checkCorreoJefeCarrera == 0) {
                //if ($checkNombreJefeCarrera == 0) {
                    $this->login_model->insert_usuario($datosUsuario);
                    $this->jefe_carrera_model->add_jefe_carrera($datosJefe);
                    $this->jefe_carrera_model->update_jefe_carrera($idJefeAnterior, $datosUpdate);
                    redirect('administrador/jefe_carrera');
                /*} else {
                    $error = "La carrera ya tiene un Jefe registrado.";
                }*/
            } else {
                $error = "El correo ya existe.";
            }
        } else {
            $error = "El id del Jefe de Carrera ya existe.";
        }

        $data = array(
            'contenido' => "private/admin/registro_jefe_carrera",
            'nav' => "navJefeCarrera",
            'titulo' => "Proyecto Residencias | Registro Jefes de Carrera",
            'tituloPantalla' => "Registro de Jefes de Carrera",
            'result' => $this->carrera_model->get_all_carreras(),
            'error' => $error,
            'id_usuario' => $datosJefe['id_usuario'],
            'nombre' => $datosJefe['nombre'],
            'ape_paterno' => $datosJefe['ape_paterno'],
            'ape_materno' => $datosJefe['ape_materno'],
            'correo' => $datosJefe['correo'],
            'id_carrera' => $datosJefe['id_carrera']
        );
        $this->load->view('private/admin/index', $data);
    }

    public function editar_jefe_carrera() {
        $id_usuario = $this->uri->segment(3);
        $result = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $ape_paterno = $row->ape_paterno;
            $ape_materno = $row->ape_materno;
            $correo = $row->correo;
            $id_carrera = $row->id_carrera;
        }

        $data = array(
            'contenido' => "private/admin/edit_jefe_carrera",
            'nav' => "navJefeCarrera",
            'titulo' => "Proyecto Residencias | Editar Jefe de Carrera",
            'result' => $this->carrera_model->get_all_carreras(),
            'tituloPantalla' => "Editar " . $nombre,
            'id_usuario' => $id_usuario,
            'nombre' => $nombre,
            'ape_paterno' => $ape_paterno,
            'ape_materno' => $ape_materno,
            'correo' => $correo,
            'id_carrera' => $id_carrera
        );
        $this->load->view('private/admin/index', $data);
    }

    public function edit_jefe_carrera() {
        $id_usuario = $this->uri->segment(3);
        $datosJefe = array(
            'nombre' => $this->input->post('nombre'),
            'ape_paterno' => $this->input->post('ape_paterno'),
            'ape_materno' => $this->input->post('ape_materno'),
            'correo' => $this->input->post('correo'),
            'id_carrera' => $this->input->post('id_carrera')
        );

        //$checkNombreJefeCarrera = $this->jefe_carrera_model->check_update_jefe_carrera($id_usuario, $datosJefe['id_carrera']);
        $checkCorreoJefeCarrera = $this->jefe_carrera_model->check_update_correo_jefe_carrera($datosJefe['correo'], $datosJefe['id_carrera']);
        //if ($checkNombreJefeCarrera == 0) {
            if ($checkCorreoJefeCarrera == 0) {
                $this->jefe_carrera_model->update_jefe_carrera($id_usuario, $datosJefe);
                redirect('administrador/jefe_carrera');
            } else {
                $error = "El correo ya existe.";
            }
        /*} else {
            $error = "La carrera ya tiene un Jefe registrado.";
        }*/

        $data = array(
            'contenido' => "private/admin/edit_jefe_carrera",
            'nav' => "navJefeCarrera",
            'titulo' => "Proyecto Residencias | Editar Jefe de Carrera",
            'result' => $this->carrera_model->get_all_carreras(),
            'tituloPantalla' => "Editar " . $datosJefe['nombre'],
            'id_usuario' => $id_usuario,
            'nombre' => $datosJefe['nombre'],
            'ape_paterno' => $datosJefe['ape_paterno'],
            'ape_materno' => $datosJefe['ape_materno'],
            'correo' => $datosJefe['correo'],
            'id_carrera' => $datosJefe['id_carrera'],
            'error' => $error
        );
        $this->load->view('private/admin/index', $data);
    }

    public function delete_jefe_carrera() {
        $id_usuario = $this->uri->segment(3);
        $this->jefe_carrera_model->delete_jefe_carrera($id_usuario);
        $this->login_model->delete_usuario($id_usuario);
        redirect('administrador/jefe_carrera');
    }

    public function catedratico() {
        $data = array(
            'contenido' => "private/admin/catedratico",
            'nav' => "navCatedratico",
            'titulo' => "Proyecto Residencias | Catedráticos",
            'tituloPantalla' => "Catedráticos",
            'result' => $this->catedratico_model->get_all_catedratico()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function registro_catedratico() {
        $data = array(
            'contenido' => "private/admin/registro_catedratico",
            'nav' => "navCatedratico",
            'titulo' => "Proyecto Residencias | Registro Catedrático",
            'tituloPantalla' => "Registro de Catedráticos",
            'result' => $this->carrera_model->get_all_carreras()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function add_catedratico() {
        $datosCatedratico = array(
            'id_catedratico' => $this->input->post('id_usuario'),
            'nombre' => $this->input->post('nombre'),
            'ape_paterno' => $this->input->post('ape_paterno'),
            'ape_materno' => $this->input->post('ape_materno'),
            'correo' => $this->input->post('correo'),
            'id_carrera' => $this->input->post('id_carrera')
        );

        $checkIdCatedratico = $this->catedratico_model->check_id_catedratico($datosCatedratico['id_catedratico']);

        if ($checkIdCatedratico == 0) {
            $this->catedratico_model->add_catedratico($datosCatedratico);
            redirect('administrador/catedratico');
        } else {
            $error = "El id del Catedrático ya existe.";
        }

        $data = array(
            'contenido' => "private/admin/registro_catedratico",
            'nav' => "navJefeCarrera",
            'titulo' => "Proyecto Residencias | Registro Catedrático",
            'tituloPantalla' => "Registro de Catedráticos",
            'result' => $this->carrera_model->get_all_carreras(),
            'error' => $error,
            'id_usuario' => $datosCatedratico['id_catedratico'],
            'nombre' => $datosCatedratico['nombre'],
            'ape_paterno' => $datosCatedratico['ape_paterno'],
            'ape_materno' => $datosCatedratico['ape_materno'],
            'correo' => $datosCatedratico['correo'],
            'id_carrera' => $datosCatedratico['id_carrera']
        );
        $this->load->view('private/admin/index', $data);
    }

    public function editar_catedratico() {
        $id_catedratico = $this->uri->segment(3);
        $result = $this->catedratico_model->get_catedratico_by_id($id_catedratico);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $ape_paterno = $row->ape_paterno;
            $ape_materno = $row->ape_materno;
            $correo = $row->correo;
            $id_carrera = $row->id_carrera;
        }

        $data = array(
            'contenido' => "private/admin/edit_catedratico",
            'nav' => "navCatedratico",
            'titulo' => "Proyecto Residencias | Editar Catedrático",
            'result' => $this->carrera_model->get_all_carreras(),
            'tituloPantalla' => "Editar " . $nombre,
            'id_usuario' => $id_catedratico,
            'nombre' => $nombre,
            'ape_paterno' => $ape_paterno,
            'ape_materno' => $ape_materno,
            'correo' => $correo,
            'id_carrera' => $id_carrera
        );
        $this->load->view('private/admin/index', $data);
    }

    public function edit_catedratico() {
        $id_catedratico = $this->uri->segment(3);
        $datosJefe = array(
            'nombre' => $this->input->post('nombre'),
            'ape_paterno' => $this->input->post('ape_paterno'),
            'ape_materno' => $this->input->post('ape_materno'),
            'correo' => $this->input->post('correo'),
            'id_carrera' => $this->input->post('id_carrera')
        );

        $this->catedratico_model->update_catedratico($id_catedratico, $datosJefe);
        redirect('administrador/catedratico');
    }

    public function delete_catedratico() {
        $id_catedratico = $this->uri->segment(3);
        $this->catedratico_model->delete_catedratico($id_catedratico);
        redirect('administrador/catedratico');
    }

    public function academia() {
        $data = array(
            'contenido' => "private/admin/academia",
            'nav' => "navAcademia",
            'titulo' => "Proyecto Residencias | Academia",
            'tituloPantalla' => "Academia",
            'result' => $this->academia_model->get_all_academia()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function editar_academia() {
        $id_academia = $this->uri->segment(3);
        $result = $this->academia_model->get_academia_by_id($id_academia);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $paterno = $row->paterno;
            $materno = $row->materno;
            $tipo = $row->tipo;
        }

        $data = array(
            'contenido' => "private/admin/edit_academia",
            'nav' => "navAcademia",
            'titulo' => "Proyecto Residencias | Editar Academia",
            'tituloPantalla' => "Editar " . $nombre,
            'id_academia' => $id_academia,
            'nombre' => $nombre,
            'paterno' => $paterno,
            'materno' => $materno,
            'tipo' => $tipo
        );
        $this->load->view('private/admin/index', $data);
    }

    public function edit_academia() {
        $id_academia = $this->uri->segment(3);
       
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'paterno' => $this->input->post('paterno'),
            'materno' => $this->input->post('materno'),
            'tipo' => $this->input->post('tipo')
        );
        $this->academia_model->update_academia($id_academia, $data);
        redirect('administrador/academia');
    }

    public function carreras() {
        $data = array(
            'contenido' => "private/admin/carrera",
            'nav' => "navCarrera",
            'titulo' => "Proyecto Residencias | Carreras",
            'tituloPantalla' => "Carreras",
            'result' => $this->carrera_model->get_all_carreras()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function registro_carrera() {
        $data = array(
            'contenido' => "private/admin/registro_carrera",
            'nav' => "navCarrera",
            'titulo' => "Proyecto Residencias | Registro de Carrera",
            'tituloPantalla' => "Registro de Carrera"
        );
        $this->load->view('private/admin/index', $data);
    }

    public function add_carrera() {
        $datos = array(
            'id_carrera' => $this->input->post('id_carrera'),
            'nombre_carrera' => $this->input->post('nombre_carrera')
        );

        $error = "";

        $checkIdCarrera = $this->carrera_model->check_id_carrera($datos['id_carrera']);
        $checkNombreCarrera = $this->carrera_model->check_nombre_carrera($datos['nombre_carrera']);

        if ($checkIdCarrera == 0) {
            if ($checkNombreCarrera == 0) {
                $this->carrera_model->add_carrera($datos);
                redirect('administrador/carreras');
            } else {
                $error = "El nombre de carrera ya existe.";
            }
        } else {
            $error = "El id de carrera ya existe.";
        }

        $data = array(
            'contenido' => "private/admin/registro_carrera",
            'nav' => "navCarrera",
            'titulo' => "Proyecto Residencias | Registro de Carrera",
            'tituloPantalla' => "Registro de Carrera",
            'error' => $error,
            'id_carrera' => $datos['id_carrera'],
            'nombre_carrera' => $datos['nombre_carrera']
        );
        $this->load->view('private/admin/index', $data);
    }

    public function editar_carrera() {
        $id_carrera = $this->uri->segment(3);
        $result = $this->carrera_model->get_by_id_carrera($id_carrera);

        foreach ($result->result() as $row) {
            $nombre_carrera = $row->nombre_carrera;
        }

        $data = array(
            'contenido' => "private/admin/edit_carrera",
            'nav' => "navCarrera",
            'titulo' => "Proyecto Residencias | Editar Carrera",
            'tituloPantalla' => "Editar Carrera " . $nombre_carrera,
            'id_carrera' => $id_carrera,
            'nombre_carrera' => $nombre_carrera
        );
        $this->load->view('private/admin/index', $data);
    }

    public function edit_carrera() {
        $id_carrera = $this->uri->segment(3);
        $data['nombre_carrera'] = $this->input->post('nombre_carrera');

        $result = $this->carrera_model->get_by_id_carrera($id_carrera);

        foreach ($result->result() as $row) {
            $nombre_carreraBD = $row->nombre_carrera;
        }

        if ($data['nombre_carrera'] == $nombre_carreraBD) {
            redirect('administrador/carreras');
        } else {
            $checkNombreCarrera = $this->carrera_model->check_nombre_carrera($data['nombre_carrera']);

            if ($checkNombreCarrera == 0) {
                $this->carrera_model->update_carrera($id_carrera, $data);
                redirect('administrador/carreras');
            } else {
                $error = "El nombre de carrera ya existe.";
            }
        }

        $data = array(
            'contenido' => "private/admin/edit_carrera",
            'nav' => "navCarrera",
            'error' => $error,
            'titulo' => "Proyecto Residencias | Editar Carrera",
            'tituloPantalla' => "Editar Carrera " . $data['nombre_carrera'],
            'id_carrera' => $id_carrera,
            'nombre_carrera' => $data['nombre_carrera']
        );
        $this->load->view('private/admin/index', $data);
    }

    public function delete_carrera() {
        $id_carrera = $this->uri->segment(3);
        $this->carrera_model->delete_carrera($id_carrera);
        redirect('administrador/carreras');
    }

    public function salon() {
        $data = array(
            'contenido' => "private/admin/salones",
            'nav' => "navSalon",
            'titulo' => "Proyecto Residencias | Salones",
            'tituloPantalla' => "Salones",
            'result' => $this->salon_model->get_all_salones()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function registro_salon() {
        $data = array(
            'contenido' => "private/admin/registro_salon",
            'nav' => "navSalon",
            'titulo' => "Proyecto Residencias | Registro de Salón",
            'tituloPantalla' => "Registro de salón"
        );
        $this->load->view('private/admin/index', $data);
    }

    public function add_salon() {
        $datos = array(
            'id_salon' => $this->input->post('id_salon'),
            'nombre' => $this->input->post('nombre')
        );

        $error = "";

        $checkIdCarrera = $this->salon_model->check_id_salon($datos['id_salon']);

        if ($checkIdCarrera == 0) {
            $this->salon_model->add_salon($datos);
            redirect('administrador/salon');
        } else {
            $error = "El id de salón ya existe.";
        }

        $data = array(
            'contenido' => "private/admin/registro_salon",
            'nav' => "navSalon",
            'titulo' => "Proyecto Residencias | Registro de Salón",
            'tituloPantalla' => "Registro de Salón",
            'error' => $error,
            'id_salon' => $datos['id_salon'],
            'nombre' => $datos['nombre']
        );
        $this->load->view('private/admin/index', $data);
    }

    public function editar_salon() {
        $id_salon = $this->uri->segment(3);
        $result = $this->salon_model->get_salon_by_id($id_salon);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
        }

        $data = array(
            'contenido' => "private/admin/edit_salon",
            'nav' => "navSalon",
            'titulo' => "Proyecto Residencias | Editar Salón",
            'tituloPantalla' => "Editar Salón " . $nombre,
            'id_salon' => $id_salon,
            'nombre' => $nombre
        );
        $this->load->view('private/admin/index', $data);
    }

    public function edit_salon() {
        $id_salon = $this->uri->segment(3);
        $data['nombre'] = $this->input->post('nombre');

        $result = $this->salon_model->get_salon_by_id($id_salon);

        foreach ($result->result() as $row) {
            $nombre_salonBD = $row->nombre;
        }

        if ($data['nombre'] == $nombre_salonBD) {
            redirect('administrador/salon');
        } else {
            $this->salon_model->update_salon($id_salon, $data);
            redirect('administrador/salon');
        }

        $data = array(
            'contenido' => "private/admin/edit_salon",
            'nav' => "navSalon",
            'titulo' => "Proyecto Residencias | Editar Salón",
            'tituloPantalla' => "Editar Salón " . $data['nombre'],
            'id_salon' => $id_salon,
            'nombre' => $data['nombre']
        );
        $this->load->view('private/admin/index', $data);
    }

    public function delete_salon() {
        $id_salon = $this->uri->segment(3);
        $this->salon_model->delete_salon($id_salon);
        redirect('administrador/salon');
    }

    public function clasificacion() {
        $data = array(
            'contenido' => "private/admin/clasificacion",
            'nav' => "navClasificacion",
            'titulo' => "Proyecto Residencias | Clasificación",
            'tituloPantalla' => "Clasificación",
            'result' => $this->clasificacion_model->get_all_clasificacion()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function registro_clasificacion() {
        $data = array(
            'contenido' => "private/admin/registro_clasificacion",
            'nav' => "navClasificacion",
            'titulo' => "Proyecto Residencias | Registro de Clasificación",
            'tituloPantalla' => "Registro de Clasificación"
        );
        $this->load->view('private/admin/index', $data);
    }

    public function add_clasificacion() {
        $datos = array(
            'id_clasificacion' => $this->input->post('id_clasificacion'),
            'clasificacion' => $this->input->post('clasificacion'),
            'descripcion' => $this->input->post('descripcion'),
            'actividad' => $this->input->post('actividad')
        );

        $error = "";

        $checkIdCarrera = $this->clasificacion_model->check_id_clasificacion($datos['id_clasificacion']);

        if ($checkIdCarrera == 0) {
            $this->clasificacion_model->add_clasificacion($datos);
            redirect('administrador/clasificacion');
        } else {
            $error = "El id de clasificación ya existe.";
        }

        $data = array(
            'contenido' => "private/admin/registro_clasificacion",
            'nav' => "navClasificacion",
            'titulo' => "Proyecto Residencias | Registro de Clasificación",
            'tituloPantalla' => "Registro de Clasificación",
            'error' => $error,
            'id_clasificaion' => $datos['id_clasificacion'],
            'clasificacion' => $datos['clasificacion'],
            'descripcion' => $datos['descripcion'],
            'actividad' => $datos['actividad']
        );
        $this->load->view('private/admin/index', $data);
    }

    public function editar_clasificacion() {
        $id_clasificacion = $this->uri->segment(3);
        $result = $this->clasificacion_model->get_clasificacion_by_id($id_clasificacion);

        foreach ($result->result() as $row) {
            $clasificacion = $row->clasificacion;
            $descripcion = $row->descripcion;
            $actividad = $row->actividad;
        }

        $data = array(
            'contenido' => "private/admin/edit_clasificacion",
            'nav' => "navClasificacion",
            'titulo' => "Proyecto Residencias | Editar Clasificación",
            'tituloPantalla' => "Editar Clasificación " . $clasificacion,
            'id_clasificacion' => $id_clasificacion,
            'clasificacion' => $clasificacion,
            'descripcion' => $descripcion,
            'actividad' => $actividad
        );
        $this->load->view('private/admin/index', $data);
    }

    public function edit_clasificacion() {
        $id_clasificacion = $this->uri->segment(3);
        $datos = array(
            'clasificacion' => $this->input->post('clasificacion'),
            'descripcion' => $this->input->post('descripcion'),
            'actividad' => $this->input->post('actividad')
        );
        $this->clasificacion_model->update_clasificacion($id_clasificacion, $datos);
        redirect('administrador/clasificacion');
    }

    public function delete_clasificacion() {
        $id_clasificacion = $this->uri->segment(3);
        $this->clasificacion_model->delete_clasificacion($id_clasificacion);
        redirect('administrador/clasificacion');
    }

    public function periodo() {
        $data = array(
            'contenido' => "private/admin/periodos",
            'nav' => "navPeriodo",
            'titulo' => "Proyecto Residencias | Periodos",
            'tituloPantalla' => "Periodos",
            'result' => $this->periodo_model->get_all_periodos()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function registro_periodo() {
        $data = array(
            'contenido' => "private/admin/registro_periodo",
            'nav' => "navPeriodo",
            'titulo' => "Proyecto Residencias | Registro de Periodo",
            'tituloPantalla' => "Registro de periodo"
        );
        $this->load->view('private/admin/index', $data);
    }

    public function add_periodo() {
        $datos = array(
            'id_periodo' => $this->input->post('id_periodo'),
            'descripcion' => $this->input->post('descripcion')
        );

        $error = "";

        $checkIdPeriodo = $this->periodo_model->check_id_periodo($datos['id_periodo']);

        if ($checkIdPeriodo == 0) {
            $this->periodo_model->add_periodo($datos);
            redirect('administrador/periodo');
        } else {
            $error = "El id de periodo ya existe.";
        }

        $data = array(
            'contenido' => "private/admin/registro_periodo",
            'nav' => "navPeriodo",
            'titulo' => "Proyecto Residencias | Registro de Periodo",
            'tituloPantalla' => "Registro de periodo",
            'error' => $error,
            'id_periodo' => $datos['id_periodo'],
            'descripcion' => $datos['descripcion']
        );
        $this->load->view('private/admin/index', $data);
    }

    public function editar_periodo() {
        $id_periodo = $this->uri->segment(3);
        $result = $this->periodo_model->get_periodo_by_id($id_periodo);

        foreach ($result->result() as $row) {
            $descripcion = $row->descripcion;
        }

        $data = array(
            'contenido' => "private/admin/edit_periodo",
            'nav' => "navPeriodo",
            'titulo' => "Proyecto Residencias | Editar Periodo",
            'tituloPantalla' => "Editar Periodo " . $descripcion,
            'id_periodo' => $id_periodo,
            'descripcion' => $descripcion
        );
        $this->load->view('private/admin/index', $data);
    }

    public function edit_periodo() {
        $id_periodo = $this->uri->segment(3);
        $data['descripcion'] = $this->input->post('descripcion');

        $result = $this->periodo_model->get_periodo_by_id($id_periodo);

        foreach ($result->result() as $row) {
            $descripcion = $row->descripcion;
        }

        if ($data['descripcion'] == $descripcion) {
            redirect('administrador/periodo');
        } else {
            $this->periodo_model->update_periodo($id_periodo, $data);
            redirect('administrador/periodo');
        }

        $data = array(
            'contenido' => "private/admin/edit_periodo",
            'nav' => "navSalon",
            'titulo' => "Proyecto Residencias | Editar Periodo",
            'tituloPantalla' => "Editar Periodo " . $data['descripcion'],
            'id_periodo' => $id_periodo,
            'descripcion' => $data['descripcion']
        );
        $this->load->view('private/admin/index', $data);
    }

    public function delete_periodo() {
        $id_periodo = $this->uri->segment(3);
        $this->periodo_model->delete_periodo($id_periodo);
        redirect('administrador/periodo');
    }

    public function bitacora() {
        $pages = 10; //Número de registros mostrados por páginas
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $config['base_url'] = base_url() . 'administrador/bitacora/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->bitacora_model->filas(); //calcula el número de filas  
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 20; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera'; //primer link
        $config['last_link'] = 'Última'; //último link
        $config["uri_segment"] = 3; //el segmento de la paginación
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['prev_link'] = 'Anterior'; //anterior link
        $this->pagination->initialize($config); //inicializamos la paginación		

        $data = array(
            'contenido' => "private/admin/bitacora",
            'nav' => "navBitacora",
            'titulo' => "Proyecto Residencias | Bitacora",
            'tituloPantalla' => "Bitacora",
            'bitacora' => $this->bitacora_model->total_paginados($config['per_page'], $this->uri->segment(3))
        );
        $this->load->view('private/admin/index', $data);
    }

}
