<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('carrera_model');
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
            'tituloPantalla' => "Jefes de carrera"
        );
        $this->load->view('private/admin/index', $data);
    }

    public function registro_jefe_carrera() {
        $data = array(
            'contenido' => "private/admin/registro_jefe_carrera",
            'nav' => "navJefeCarrera",
            'titulo' => "Proyecto Residencias | Registro Jefes de Carrera",
            'tituloPantalla' => "Registro de Jefes de Carrera"
        );
        $this->load->view('private/admin/index', $data);
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
