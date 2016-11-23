<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index() {
        $data = array(
            'contenido' => "public/iniciar_sesion",
            'titulo' => "Proyecto Residencias | Iniciar Sesión",
            'tituloPantalla' => "Iniciar Sesión"
        );
        $this->load->view('public/index', $data);
    }

    public function validar_usuario() {
        $nombre_usuario = $this->input->post('nombre_usuario');
        $pass_usuario = $this->input->post('pass_usuario');
        $tipo_usuario = $this->input->post('tipo_usuario');

        $result = $this->login_model->buscar_usuario($nombre_usuario, md5($pass_usuario), $tipo_usuario);

        if ($result) {
            $user_data = array(
                'user_login' => $result->clave_usuario,
                'pass_login' => $result->pass_usuario,
                'tipo_login' => $result->tipo_usuario,
                'nombre_usuario' => $result->nombre_usuario,
                'logueado' => TRUE
            );
            $this->session->set_userdata($user_data);
            switch ($user_data['tipo_login']) {
                case "Admin":
                    redirect('administrador');
                    break;
                case "Jefe":
                    redirect('jefe_carrera');
                    break;
            }
        } else {
            $data = array(
                'contenido' => "public/iniciar_sesion",
                'titulo' => "Proyecto Residencias | Iniciar Sesión",
                'tituloPantalla' => "Iniciar Sesión",
                'error' => "Usuario o contraseña incorrecta."
            );
            $this->load->view('public/index', $data);
        }
    }
    
    public function cerrar_sesion(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */