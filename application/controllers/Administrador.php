<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('carrera_model');
        $this->load->model('jefe_carrera_model');
        $this->load->model('login_model');
    }

    public function index() {
        $data = array(
            'contenido' => "private/admin/welcome",
            'nav' => "navHome",
            'titulo' => "Proyecto Residencias | Iniciar Sesión",
            'tituloPantalla' => "Bienvenido"
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
            'result' => $this->carrera_model->get_all_carreras()
        );
        $this->load->view('private/admin/index', $data);
    }

    public function add_jefe_carrera() {
        $datosUsuario = array(
            'nombre_usuario' => $this->input->post('id_usuario'),
            'pass_usuario' => md5($this->input->post('contra'))
        );

        $datosJefe = array(
            'id_usuario' => $this->input->post('id_usuario'),
            'nombre' => $this->input->post('nombre'),
            'ape_paterno' => $this->input->post('ape_paterno'),
            'ape_materno' => $this->input->post('ape_materno'),
            'correo' => $this->input->post('correo'),
            'id_carrera' => $this->input->post('id_carrera')
        );

        $checkIdJefeCarrera = $this->jefe_carrera_model->check_id_jefe_carrera($datosJefe['id_usuario']);
        $checkNombreJefeCarrera = $this->jefe_carrera_model->check_carrera_jefe_carrera($datosJefe['id_carrera']);

        if ($checkIdJefeCarrera == 0) {
            if ($checkNombreJefeCarrera == 0) {
                $this->login_model->insert_usuario($datosUsuario);
                $this->jefe_carrera_model->add_jefe_carrera($datosJefe);
                redirect('administrador/jefe_carrera');
            } else {
                $error = "La carrera ya tiene un Jefe registrado.";
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
        
        $checkNombreJefeCarrera = $this->jefe_carrera_model->check_carrera_jefe_carrera($id_usuario);
        if($checkNombreJefeCarrera == 1){
            $this->jefe_carrera_model->update_jefe_carrera($id_usuario, $datosJefe);
            redirect('administrador/jefe_carrera');
        }else{
            $error = "La carrera ya tiene un Jefe registrado.";
        }
        
        $data = array(
            'contenido' => "private/admin/edit_jefe_carrera",
            'nav' => "navJefeCarrera",
            'titulo' => "Proyecto Residencias | Editar Jefe de Carrera",
            'result' => $this->carrera_model->get_all_carreras(),
            'tituloPantalla' => "Editar " . $nombre,
            'id_usuario' => $datosJefe['id_usuario'],
            'nombre' => $datosJefe['nombre'],
            'ape_paterno' => $datosJefe['ape_paterno'],
            'ape_materno' => $datosJefe['ape_materno'],
            'correo' => $datosJefe['correo'],
            'id_carrera' => $datosJefe['id_carrera'],
            'error' => $error
        );
        $this->load->view('private/admin/index', $data);
    }
    
    public function delete_jefe_carrera(){
        $id_usuario = $this->uri->segment(3);
        $this->jefe_carrera_model->delete_jefe_carrera($id_usuario);
        $this->login_model->delete_usuario($id_usuario);
        redirect('administrador/jefe_carrera');
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

    public function salones() {
        $data = array(
            'contenido' => "private/admin/salones",
            'nav' => "navSalon",
            'titulo' => "Proyecto Residencias | Salones",
            'tituloPantalla' => "Carreras"
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

}
