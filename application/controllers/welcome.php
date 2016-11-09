<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'contenido' => "public/iniciar_sesion",
            'nav' => "navIniciarSesion",
            'titulo' => "Proyecto Residencias | Iniciar Sesión",
            'tituloPantalla' => "Iniciar Sesión"
        );
        $this->load->view('public/index', $data);
    }

    public function registro() {
        $data = array(
            'contenido' => "public/registro",
            'nav' => "navRegistro",
            'titulo' => "Proyecto Residencias | Registro",
            'tituloPantalla' => "Registro"
        );
        $this->load->view('public/index', $data);
    }
    
    public function validar_usuario(){
        $nombre_usuario = $this->input->post('nombre_usuario');
        $pass_usuario = $this->input->post('pass_usuario');
        $tipo_usuario = $this->input->post('tipo_usuario');
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */