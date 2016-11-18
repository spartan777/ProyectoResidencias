<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jefe_carrera extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('carrera_model');
        $this->load->model('jefe_carrera_model');
        $this->load->model('catedratico_model');
        $this->load->model('salon_model');
        $this->load->model('grupo_model');
        $this->load->model('materia_model');
    }

    public function index() {
        $data = array(
            'contenido' => "private/jefe_carrera/welcome",
            'nav' => "navHome",
            'titulo' => "Proyecto Residencias | Zona Jefe de Carrera",
            'tituloPantalla' => "Bienvenido"
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function catedratico() {
        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row) {
            $id_carrera = $row->id_carrera;
        }
        $data = array(
            'contenido' => "private/jefe_carrera/catedratico",
            'nav' => "navCatedratico",
            'titulo' => "Proyecto Residencias | Catedráticos",
            'result' => $this->catedratico_model->get_catedratico_by_carrera($id_carrera),
            'tituloPantalla' => "Catedráticos"
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function registro_catedratico() {
        $data = array(
            'contenido' => "private/jefe_carrera/registro_catedratico",
            'nav' => "navCatedratico",
            'titulo' => "Proyecto Residencias | Registro Catedrático",
            'tituloPantalla' => "Registro de Catedráticos"
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function add_catedratico() {
        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row) {
            $id_carrera = $row->id_carrera;
        }
        $datosCatedratico = array(
            'id_catedratico' => $this->input->post('id_usuario'),
            'nombre' => $this->input->post('nombre'),
            'ape_paterno' => $this->input->post('ape_paterno'),
            'ape_materno' => $this->input->post('ape_materno'),
            'correo' => $this->input->post('correo'),
            'id_carrera' => $id_carrera
        );

        $checkIdCatedratico = $this->catedratico_model->check_id_catedratico($datosCatedratico['id_catedratico']);

        if ($checkIdCatedratico == 0) {
            $this->catedratico_model->add_catedratico($datosCatedratico);
            redirect('jefe_carrera/catedratico');
        } else {
            $error = "El id del Catedrático ya existe.";
        }

        $data = array(
            'contenido' => "private/jefe_carrera/registro_catedratico",
            'nav' => "navJefeCarrera",
            'titulo' => "Proyecto Residencias | Registro Catedrático",
            'tituloPantalla' => "Registro de Catedráticos",
            'error' => $error,
            'id_usuario' => $datosCatedratico['id_usuario'],
            'nombre' => $datosCatedratico['nombre'],
            'ape_paterno' => $datosCatedratico['ape_paterno'],
            'ape_materno' => $datosCatedratico['ape_materno'],
            'correo' => $datosCatedratico['correo'],
            'id_carrera' => $datosCatedratico['id_carrera']
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function editar_catedratico() {
        $id_catedratico = $this->uri->segment(3);
        $result = $this->catedratico_model->get_catedratico_by_id($id_catedratico);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $ape_paterno = $row->ape_paterno;
            $ape_materno = $row->ape_materno;
            $correo = $row->correo;
        }

        $data = array(
            'contenido' => "private/jefe_carrera/edit_catedratico",
            'nav' => "navCatedratico",
            'titulo' => "Proyecto Residencias | Editar Catedrático",
            'tituloPantalla' => "Editar " . $nombre,
            'id_usuario' => $id_catedratico,
            'nombre' => $nombre,
            'ape_paterno' => $ape_paterno,
            'ape_materno' => $ape_materno,
            'correo' => $correo
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function edit_catedratico() {
        $id_catedratico = $this->uri->segment(3);
        $datosCatedratico = array(
            'nombre' => $this->input->post('nombre'),
            'ape_paterno' => $this->input->post('ape_paterno'),
            'ape_materno' => $this->input->post('ape_materno'),
            'correo' => $this->input->post('correo')
        );

        $this->catedratico_model->update_catedratico($id_catedratico, $datosCatedratico);
        redirect('jefe_carrera/catedratico');
    }

    public function delete_catedratico() {
        $id_catedratico = $this->uri->segment(3);
        $this->catedratico_model->delete_catedratico($id_catedratico);
        redirect('jefe_carrera/catedratico');
    }

    public function grupos() {
        $data = array(
            'contenido' => "private/jefe_carrera/grupos",
            'nav' => "navGrupo",
            'titulo' => "Proyecto Residencias | Grupos",
            'tituloPantalla' => "Grupos",
            'result' => $this->grupo_model->get_all_grupos()
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function registro_grupo() {
        $data = array(
            'contenido' => "private/jefe_carrera/registro_grupo",
            'nav' => "navGrupo",
            'titulo' => "Proyecto Residencias | Registro de Grupo",
            'tituloPantalla' => "Registro de Grupo"
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function add_grupo() {
        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row) {
            $id_carrera = $row->id_carrera;
        }
        $datos = array(
            'id_grupo' => $this->input->post('id_grupo'),
            'nombre' => $this->input->post('nombre'),
            'id_carrera' => $id_carrera
        );

        $error = "";

        $checkIdCarrera = $this->grupo_model->check_id_grupo($datos['id_grupo']);

        if ($checkIdCarrera == 0) {
            $this->grupo_model->add_grupo($datos);
            redirect('jefe_carrera/grupos');
        } else {
            $error = "El id de grupo ya existe.";
        }

        $data = array(
            'contenido' => "private/jefe_carrera/registro_grupo",
            'nav' => "navGrupo",
            'titulo' => "Proyecto Residencias | Registro de Grupo",
            'tituloPantalla' => "Registro de Grupo",
            'error' => $error,
            'id_grupo' => $datos['id_grupo'],
            'nombre' => $datos['nombre']
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function editar_grupo() {
        $id_grupo = $this->uri->segment(3);
        $result = $this->grupo_model->get_grupo_by_id($id_grupo);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
        }

        $data = array(
            'contenido' => "private/jefe_carrera/edit_grupo",
            'nav' => "navGrupo",
            'titulo' => "Proyecto Residencias | Editar Grupo",
            'tituloPantalla' => "Editar Grupo " . $nombre,
            'id_grupo' => $id_grupo,
            'nombre' => $nombre
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function edit_grupo() {
        $id_grupo = $this->uri->segment(3);
        $data['nombre'] = $this->input->post('nombre');
        $this->grupo_model->update_grupo($id_grupo, $data);
        redirect('jefe_carrera/grupos');
    }

    public function delete_grupo() {
        $id_grupo = $this->uri->segment(3);
        $this->grupo_model->delete_grupo($id_grupo);
        redirect('jefe_carrera/grupos');
    }
    
    public function materias() {
        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row) {
            $id_carrera = $row->id_carrera;
        }
        
        $data = array(
            'contenido' => "private/jefe_carrera/materias",
            'nav' => "navMateria",
            'titulo' => "Proyecto Residencias | Materias",
            'tituloPantalla' => "Materias",
            'result' =>  $this->materia_model->get_materia_by_id_carrera($id_carrera)
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function registro_materia() {
        
        $data = array(
            'contenido' => "private/jefe_carrera/registro_materia",
            'nav' => "navMateria",
            'titulo' => "Proyecto Residencias | Registro de Materia",
            'tituloPantalla' => "Registro de Materia"
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function add_materia() {
        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row) {
            $id_carrera = $row->id_carrera;
        }
        $datos = array(
            'id_materia' => $this->input->post('id_materia'),
            'nombre' => $this->input->post('nombre'),
            'id_carrera' => $id_carrera,
            'creditos' => $this->input->post('creditos'),
            'horas_teoricas' => $this->input->post('horas_teoricas'),
            'horas_practicas' => $this->input->post('horas_practicas')
        );

        $error = "";

        $checkIdMateria = $this->materia_model->check_id_materia($datos['id_materia']);

        if ($checkIdMateria == 0) {
            $this->materia_model->add_materia($datos);
            redirect('jefe_carrera/materias');
        } else {
            $error = "El id de materia ya existe.";
        }

        $data = array(
            'contenido' => "private/jefe_carrera/registro_materia",
            'nav' => "navMateria",
            'titulo' => "Proyecto Residencias | Registro de Materia",
            'tituloPantalla' => "Registro de Materia",
            'error' => $error,
            'id_materia' => $datos['id_materia'],
            'nombre' => $datos['nombre'],
            'creditos' => $datos['creditos'],
            'horas_teoricas' => $datos['horas_teoricas'],
            'horas_practicas' => $datos['horas_practicas']
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function editar_materia() {
        $id_materia = $this->uri->segment(3);
        $result = $this->materia_model->get_materia_by_id($id_materia);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $creditos = $row->creditos;
            $horas_teoricas = $row->horas_teoricas;
            $horas_practicas = $row->horas_practicas;
        }

        $data = array(
            'contenido' => "private/jefe_carrera/edit_materia",
            'nav' => "navMateria",
            'titulo' => "Proyecto Residencias | Editar Materia",
            'tituloPantalla' => "Editar Materia " . $nombre,
            'id_materia' => $id_materia,
            'nombre' => $nombre,
            'creditos' => $creditos,
            'horas_teoricas' => $horas_teoricas,
            'horas_practicas' => $horas_practicas
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function edit_materia() {
        $id_materia = $this->uri->segment(3);
        $datos = array(
            'nombre' => $this->input->post('nombre'),
            'creditos' => $this->input->post('creditos'),
            'horas_teoricas' => $this->input->post('horas_teoricas'),
            'horas_practicas' => $this->input->post('horas_practicas')
        );
        $this->materia_model->update_materia($id_materia, $datos);
        redirect('jefe_carrera/materias');
    }

    public function delete_materia() {
        $id_materia = $this->uri->segment(3);
        $this->materia_model->delete_materia($id_materia);
        redirect('jefe_carrera/materias');
    }

    public function salon() {
        $data = array(
            'contenido' => "private/jefe_carrera/salones",
            'nav' => "navSalon",
            'titulo' => "Proyecto Residencias | Salones",
            'result' => $this->salon_model->get_all_salones(),
            'tituloPantalla' => "Salones"
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function asignar_horario() {
        $data = array(
            'contenido' => "private/jefe_carrera/asignar_horario",
            'nav' => "navSalon",
            'titulo' => "Proyecto Residencias | Salones",
            'tituloPantalla' => "Salones"
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

}
