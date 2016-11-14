<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jefe_carrera extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('carrera_model');
        $this->load->model('jefe_carrera_model');
        $this->load->model('catedratico_model');
        $this->load->model('salon_model');
    }
    
    public function index(){
         $data = array(
            'contenido' => "private/jefe_carrera/welcome",
            'nav' => "navHome",
            'titulo' => "Proyecto Residencias | Zona Jefe de Carrera",
            'tituloPantalla' => "Bienvenido"
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }
    
    public function catedratico(){
        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row){
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
    
    public function salon(){
         $data = array(
            'contenido' => "private/jefe_carrera/salones",
            'nav' => "navCatedratico",
            'titulo' => "Proyecto Residencias | Salones",
            'result' => $this->salon_model->get_all_salones(),
            'tituloPantalla' => "Salones"
        );
       $this->load->view('private/jefe_carrera/index', $data);
    }
    
    public function asignar_horario(){
        $data = array(
            'contenido' => "private/jefe_carrera/asignar_horario",
            'nav' => "navCatedratico",
            'titulo' => "Proyecto Residencias | Salones",
            'tituloPantalla' => "Salones"
        );
       $this->load->view('private/jefe_carrera/index', $data);
    }
    
}
