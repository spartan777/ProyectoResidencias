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
        $this->load->model('catalogos_model');
        $this->load->model('detalle_horario_model');
        $this->load->model('detalle_actividad_model');
        $this->load->model('bitacora_model');
        $this->load->model('clasificacion_model');
        $this->load->model('periodo_model');
        $this->load->model('academia_model');
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
            $datosBitacora = array(
                'id_usuario' => $id_usuario,
                'modulo' => "Catedrático",
                'accion' => "Alta",
                'registro' => $datosCatedratico['id_catedratico']
            );
            $this->catedratico_model->add_catedratico($datosCatedratico);
            $this->bitacora_model->insert_bitacora($datosBitacora);
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

        $datosBitacora = array(
            'id_usuario' => $this->session->userdata['user_login'],
            'modulo' => "Catedrático",
            'accion' => "Editar",
            'registro' => $id_catedratico
        );

        $this->catedratico_model->update_catedratico($id_catedratico, $datosCatedratico);
        $this->bitacora_model->insert_bitacora($datosBitacora);
        redirect('jefe_carrera/catedratico');
    }

    public function delete_catedratico() {
        $id_catedratico = $this->uri->segment(3);
        $datosBitacora = array(
            'id_usuario' => $this->session->userdata['user_login'],
            'modulo' => "Catedrático",
            'accion' => "Eliminar",
            'registro' => $id_catedratico
        );

        $this->catedratico_model->delete_catedratico($id_catedratico);
        $this->bitacora_model->insert_bitacora($datosBitacora);
        redirect('jefe_carrera/catedratico');
    }

    public function grupos() {
        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row) {
            $id_carrera = $row->id_carrera;
        }
        $data = array(
            'contenido' => "private/jefe_carrera/grupos",
            'nav' => "navGrupo",
            'titulo' => "Proyecto Residencias | Grupos",
            'tituloPantalla' => "Grupos",
            'result' => $this->grupo_model->get_grupo_by_id_carrera($id_carrera)
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
            $datosBitacora = array(
                'id_usuario' => $this->session->userdata['user_login'],
                'modulo' => "Grupo",
                'accion' => "Alta",
                'registro' => $datos['id_grupo']
            );

            $this->grupo_model->add_grupo($datos);
            $this->bitacora_model->insert_bitacora($datosBitacora);
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
        $datosBitacora = array(
            'id_usuario' => $this->session->userdata['user_login'],
            'modulo' => "Grupo",
            'accion' => "Editar",
            'registro' => $id_grupo
        );

        $this->grupo_model->update_grupo($id_grupo, $data);
        $this->bitacora_model->insert_bitacora($datosBitacora);
        redirect('jefe_carrera/grupos');
    }

    public function delete_grupo() {
        $id_grupo = $this->uri->segment(3);
        $datosBitacora = array(
            'id_usuario' => $this->session->userdata['user_login'],
            'modulo' => "Grupo",
            'accion' => "Eliminar",
            'registro' => $id_grupo
        );

        $this->grupo_model->delete_grupo($id_grupo);
        $this->bitacora_model->insert_bitacora($datosBitacora);
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
            'result' => $this->materia_model->get_materia_by_id_carrera($id_carrera)
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
            $datosBitacora = array(
                'id_usuario' => $this->session->userdata['user_login'],
                'modulo' => "Materia",
                'accion' => "Alta",
                'registro' => $datos['id_materia']
            );

            $this->materia_model->add_materia($datos);
            $this->bitacora_model->insert_bitacora($datosBitacora);
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

        $datosBitacora = array(
            'id_usuario' => $this->session->userdata['user_login'],
            'modulo' => "Materia",
            'accion' => "Editar",
            'registro' => $id_materia
        );

        $this->materia_model->update_materia($id_materia, $datos);
        $this->bitacora_model->insert_bitacora($datosBitacora);
        redirect('jefe_carrera/materias');
    }

    public function delete_materia() {
        $id_materia = $this->uri->segment(3);
        $datosBitacora = array(
            'id_usuario' => $this->session->userdata['user_login'],
            'modulo' => "Materia",
            'accion' => "Eliminar",
            'registro' => $id_materia
        );

        $this->materia_model->delete_materia($id_materia);
        $this->bitacora_model->insert_bitacora($datosBitacora);
        redirect('jefe_carrera/materias');
    }

    public function select_catedratico() {
        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row) {
            $id_carrera = $row->id_carrera;
        }

        $data = array(
            'contenido' => "private/jefe_carrera/salones",
            'nav' => "navAsignar",
            'titulo' => "Proyecto Residencias | Asignar Horario",
            'result' => $this->catedratico_model->get_catedratico_by_carrera($id_carrera),
            'tituloPantalla' => "Asignar Horario | Catedratico"
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function asignar_horario() {
        $id_catedratico = $this->uri->segment(3);
        $result = $this->catedratico_model->get_catedratico_by_id($id_catedratico);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $ape_paterno = $row->ape_paterno;
            $ape_materno = $row->ape_materno;
        }

        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row) {
            $id_carrera = $row->id_carrera;
        }

        $data = array(
            'contenido' => "private/jefe_carrera/asignar_horario",
            'nav' => "navAsignar",
            'titulo' => "Proyecto Residencias | Asignar Horario",
            'tituloPantalla' => "Asignar Horario | Detalle del Horario",
            'nombre' => $nombre . '&nbsp;' . $ape_paterno . '&nbsp;' . $ape_materno,
            'resultDiaSemana' => $this->catalogos_model->get_all_dias(),
            'resultHorario' => $this->catalogos_model->get_all_horarios(),
            'resultMaterias' => $this->materia_model->get_materia_by_id_carrera($id_carrera),
            'resultSalones' => $this->salon_model->get_all_salones(),
            'resultGrupos' => $this->grupo_model->get_grupo_by_id_carrera($id_carrera),
            'resultTabla' => $this->detalle_horario_model->get_detalle_horario_by_id_catedratico($id_catedratico),
            'id_catedratico' => $id_catedratico,
            'horas_teoricas' => $this->detalle_horario_model->suma_horas_teoricas($id_catedratico),
            'horas_practicas' => $this->detalle_horario_model->suma_horas_practicas($id_catedratico),
            'resultPeriodo' => $this->periodo_model->get_all_periodos()
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }

    public function add_detalle_horario() {
        $datos = array(
            'id_catedratico' => $this->input->post('id_catedratico'),
            'id_dia_semana' => $this->input->post('id_dia_semana'),
            'id_horario' => $this->input->post('id_horario'),
            'id_materia' => $this->input->post('id_materia'),
            'id_salon' => $this->input->post('id_salon'),
            'id_grupo' => $this->input->post('id_grupo'),
            'id_periodo' => $this->input->post('periodo')
        );

        $result = $this->catedratico_model->get_catedratico_by_id($datos['id_catedratico']);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $ape_paterno = $row->ape_paterno;
            $ape_materno = $row->ape_materno;
        }

        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultados->result() as $row) {
            $id_carrera = $row->id_carrera;
        }

        $error = "";
        $checkHorario = $this->detalle_horario_model->check_detalle_horario($datos['id_salon'], $datos['id_horario'], $datos['id_dia_semana'], $datos['id_periodo']);
        $checkHorasMateria = $this->detalle_horario_model->check_horas_materia( $datos['id_materia'], $datos['id_catedratico'], $datos['id_periodo']);
        $checHorasDiariasMateria = $this->detalle_horario_model->check_horas_diarias($datos['id_catedratico'], $datos['id_dia_semana'],$datos['id_periodo'], $datos['id_materia']);
        $checkHorasSeguidas = $this->detalle_horario_model->check_horas_seguidas($datos['id_catedratico'], $datos['id_dia_semana'],$datos['id_periodo'], $datos['id_materia'], $datos['id_horario']);
        if ($checkHorario == 0) {
            if($checkHorasMateria == 0){
                if($checHorasDiariasMateria == 0){
                    if($checkHorasSeguidas == 0){
                        $datosBitacora = array(
                            'id_usuario' => $id_usuario,
                            'modulo' => "Horario",
                            'accion' => "Alta",
                            'registro' => $datos['id_catedratico']
                        );

                        $this->detalle_horario_model->insert_detalle_horario($datos);
                        $this->bitacora_model->insert_bitacora($datosBitacora);
                        redirect('jefe_carrera/asignar_horario/' . $datos['id_catedratico']);
                    }else{
                        $error = "Las horas de la materias deben de ser seguidas";
                    }    
                }else{
                    $error = "Solo se permiten dos horas diarias de la materia";
                }
            }else{
                $error = "Ya se ocuparon los creditos de la materia";
            }
        } else {
            $error = "Ya se encuentra ocupado el salon en ese horario";
        }

        $data = array(
            'contenido' => "private/jefe_carrera/asignar_horario",
            'nav' => "navAsignar",
            'titulo' => "Proyecto Residencias | Asignar Horario",
            'tituloPantalla' => "Asignar Horario | Detalle del Horario",
            'nombre' => $nombre . '&nbsp;' . $ape_paterno . '&nbsp;' . $ape_materno,
            'resultDiaSemana' => $this->catalogos_model->get_all_dias(),
            'resultHorario' => $this->catalogos_model->get_all_horarios(),
            'resultMaterias' => $this->materia_model->get_materia_by_id_carrera($id_carrera),
            'resultSalones' => $this->salon_model->get_all_salones(),
            'resultGrupos' => $this->grupo_model->get_grupo_by_id_carrera($id_carrera),
            'resultTabla' => $this->detalle_horario_model->get_detalle_horario_by_id_catedratico($datos['id_catedratico']),
            'id_catedratico' => $datos['id_catedratico'],
            'id_dia_semana' => $datos['id_dia_semana'],
            'id_horario' => $datos['id_horario'],
            'id_materia' => $datos['id_materia'],
            'id_salon' => $datos['id_salon'],
            'id_grupo' => $datos['id_grupo'],
            'error' => $error,
            'periodo' => $datos['id_periodo'],
            'horas_teoricas' => $this->detalle_horario_model->suma_horas_teoricas($datos['id_catedratico']),
            'horas_practicas' => $this->detalle_horario_model->suma_horas_practicas($datos['id_catedratico']),
            'resultPeriodo' => $this->periodo_model->get_all_periodos()
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }
    
    public function delete_detalle_horario(){
        $id_horario = $this->input->post('id_detalle');
        $id_catedratico = $this->input->post('id_catedratico');
        $datosBitacora = array(
            'id_usuario' => $this->session->userdata['user_login'],
            'modulo' => "Horario",
            'accion' => "Eliminar",
            'registro' => $id_horario
        );

        $this->detalle_horario_model->delete_detalle_horario($id_horario);
        $this->bitacora_model->insert_bitacora($datosBitacora);
        redirect('jefe_carrera/asignar_horario/' . $id_catedratico);
    }

    public function asignar_actividad() {
        $id_catedratico = $this->uri->segment(3);
        $result = $this->catedratico_model->get_catedratico_by_id($id_catedratico);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $ape_paterno = $row->ape_paterno;
            $ape_materno = $row->ape_materno;
        }

        $data = array(
            'contenido' => "private/jefe_carrera/asignar_actividad",
            'nav' => "navAsignar",
            'titulo' => "Proyecto Residencias | Asignar Actividad",
            'tituloPantalla' => "Asignar Horario | Detalle de Actividades",
            'nombre' => $nombre . '&nbsp;' . $ape_paterno . '&nbsp;' . $ape_materno,
            'resultDiaSemana' => $this->catalogos_model->get_all_dias(),
            'resultHorario' => $this->catalogos_model->get_all_horarios(),
            'resulClasificacion' => $this->clasificacion_model->get_all_clasificacion(),
            'resultTabla' => $this->detalle_actividad_model->get_detalle_actividad_by_id_catedratico($id_catedratico),
            'id_catedratico' => $id_catedratico,
            'horas_apoyo' => $this->detalle_actividad_model->suma_horas_apoyo($id_catedratico),
            'resultPeriodo' => $this->periodo_model->get_all_periodos()
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }
    
    public function carga_actividad() {
        $options = "";
        if ($this->input->post('clasificacion')) {
            $clasificacion = $this->input->post('clasificacion');
            $actividad = $this->clasificacion_model->carga_actividad($clasificacion);
            foreach ($actividad as $fila) {
                ?>
                <option value="<?php echo $fila->id_clasificacion ?>"><?php echo $fila->actividad ?></option>
                <?php
            }
        }
    }
    
    public function add_detalle_actividad() {
        $datos = array(
            'id_catedratico' => $this->input->post('id_catedratico'),
            'id_dia_semana' => $this->input->post('id_dia_semana'),
            'id_horario' => $this->input->post('id_horario'),
            'id_clasificacion' => $this->input->post('actividad'),
            'id_periodo' => $this->input->post('periodo')
        );

        $result = $this->catedratico_model->get_catedratico_by_id($datos['id_catedratico']);

        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $ape_paterno = $row->ape_paterno;
            $ape_materno = $row->ape_materno;
        }
        $id_usuario = $this->session->userdata['user_login'];
        $error = "";
        $checkHorario = $this->detalle_actividad_model->check_detalle_horario($datos['id_catedratico'], $datos['id_horario'], $datos['id_dia_semana'], $datos['id_periodo']);
        $checkActividad = $this->detalle_actividad_model->check_detalle_actividad($datos['id_catedratico'], $datos['id_horario'], $datos['id_dia_semana'], $datos['id_periodo']);
        if ($checkHorario == 0 ) {
            if( $checkActividad == 0){
                $datosBitacora = array(
                    'id_usuario' => $id_usuario,
                    'modulo' => "Horario",
                    'accion' => "Alta",
                    'registro' => $datos['id_catedratico']
                );

                $this->detalle_actividad_model->insert_detalle_actividad($datos);
                $this->bitacora_model->insert_bitacora($datosBitacora);
                redirect('jefe_carrera/asignar_actividad/' . $datos['id_catedratico']);
            }else{
                $error = "Ya se encuentra ocupado el catedrático en ese horario";
            }
        } else {
            $error = "Ya se encuentra ocupado el catedrático en ese horario";
        }

        $data = array(
            'contenido' => "private/jefe_carrera/asignar_actividad",
            'nav' => "navAsignar",
            'titulo' => "Proyecto Residencias | Asignar Actividad",
            'tituloPantalla' => "Asignar Horario | Detalle de Actividades",
            'nombre' => $nombre . '&nbsp;' . $ape_paterno . '&nbsp;' . $ape_materno,
            'resultDiaSemana' => $this->catalogos_model->get_all_dias(),
            'resultHorario' => $this->catalogos_model->get_all_horarios(),
            'resulClasificacion' => $this->clasificacion_model->get_all_clasificacion(),
            'resultTabla' => $this->detalle_actividad_model->get_detalle_actividad_by_id_catedratico($datos['id_catedratico']),
            'id_catedratico' => $datos['id_catedratico'],
            'horas_apoyo' => $this->detalle_actividad_model->suma_horas_apoyo($datos['id_catedratico']),
            'id_catedratico' => $datos['id_catedratico'],
            'id_dia_semana' => $datos['id_dia_semana'],
            'id_horario' => $datos['id_horario'],
            'clasificacion' => $this->input->post('clasificacion'),
            'periodo' => $datos['id_periodo'],
            'error' => $error,
            'resultPeriodo' => $this->periodo_model->get_all_periodos()
        );
        $this->load->view('private/jefe_carrera/index', $data);
    }
    
    public function delete_detalle_actividad(){
        $id_horario = $this->input->post('id_detalle');
        $id_catedratico = $this->input->post('id_catedratico');
        $datosBitacora = array(
            'id_usuario' => $this->session->userdata['user_login'],
            'modulo' => "Horario Actividad",
            'accion' => "Eliminar",
            'registro' => $id_horario
        );

        $this->detalle_actividad_model->delete_detalle_actividad($id_horario);
        $this->bitacora_model->insert_bitacora($datosBitacora);
        redirect('jefe_carrera/asignar_actividad/' . $id_catedratico);
    }

    public function descargar_horario() {
        $id_catedratico = $this->input->post('id_catedratico');
        $id_periodo = $this->input->post('id_periodo');
        $id_usuario = $this->session->userdata['user_login'];
        $resultados = $this->detalle_horario_model->get_detalle_horario_by_id_catedratico_descargar($id_catedratico, $id_periodo);
        $resultadosActividad = $this->detalle_actividad_model->get_detalle_actividad_by_id_catedratico_descargar($id_catedratico, $id_periodo);
        $file = APPPATH . 'template/FORMATO_HORARIOS_MAESTRO.xlsx';
        $this->load->library('excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);

        if ($resultados != NULL) {
            foreach ($resultados->result() as $row) {
                if ($row->id_dia == 1) {
                    if ($row->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B10', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C10', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B11', $row->grupo);
                    }
                    if ($row->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B12', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C12', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B13', $row->grupo);
                    }
                    if ($row->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B14', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C14', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B15', $row->grupo);
                    }
                    if ($row->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B16', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C16', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B17', $row->grupo);
                    }
                    if ($row->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B18', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C18', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B19', $row->grupo);
                    }
                    if ($row->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B20', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C20', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B21', $row->grupo);
                    }
                    if ($row->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B22', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C22', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B23', $row->grupo);
                    }
                    if ($row->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B24', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C24', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B25', $row->grupo);
                    }
                    if ($row->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B26', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C26', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B27', $row->grupo);
                    }
                    if ($row->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B28', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C28', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B29', $row->grupo);
                    }
                    if ($row->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B30', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C30', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B31', $row->grupo);
                    }
                    if ($row->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B32', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('C32', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('B33', $row->grupo);
                    }
                }

                if ($row->id_dia == 2) {
                    if ($row->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D10', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E10', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D11', $row->grupo);
                    }
                    if ($row->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D12', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E12', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D13', $row->grupo);
                    }
                    if ($row->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D14', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E14', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D15', $row->grupo);
                    }
                    if ($row->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D16', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E16', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D17', $row->grupo);
                    }
                    if ($row->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D18', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E18', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D19', $row->grupo);
                    }
                    if ($row->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D20', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E20', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D21', $row->grupo);
                    }
                    if ($row->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D22', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E22', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D23', $row->grupo);
                    }
                    if ($row->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D24', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E24', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D25', $row->grupo);
                    }
                    if ($row->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D26', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E26', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D27', $row->grupo);
                    }
                    if ($row->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D28', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E28', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D29', $row->grupo);
                    }
                    if ($row->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D30', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E30', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D31', $row->grupo);
                    }
                    if ($row->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D32', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('E32', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('D33', $row->grupo);
                    }
                }

                if ($row->id_dia == 3) {
                    if ($row->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F10', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G10', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F11', $row->grupo);
                    }
                    if ($row->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F12', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G12', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F13', $row->grupo);
                    }
                    if ($row->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F14', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G14', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F15', $row->grupo);
                    }
                    if ($row->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F16', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G16', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F17', $row->grupo);
                    }
                    if ($row->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F18', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G18', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F19', $row->grupo);
                    }
                    if ($row->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F20', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G20', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F21', $row->grupo);
                    }
                    if ($row->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F22', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G22', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F23', $row->grupo);
                    }
                    if ($row->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F24', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G24', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F25', $row->grupo);
                    }
                    if ($row->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F26', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G26', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F27', $row->grupo);
                    }
                    if ($row->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F28', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G28', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F29', $row->grupo);
                    }
                    if ($row->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F30', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G30', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F31', $row->grupo);
                    }
                    if ($row->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F32', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('G32', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('F33', $row->grupo);
                    }
                }

                if ($row->id_dia == 4) {
                    if ($row->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H10', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I10', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H11', $row->grupo);
                    }
                    if ($row->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H12', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I12', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H13', $row->grupo);
                    }
                    if ($row->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H14', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I14', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H15', $row->grupo);
                    }
                    if ($row->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H16', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I16', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H17', $row->grupo);
                    }
                    if ($row->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H18', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I18', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H19', $row->grupo);
                    }
                    if ($row->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H20', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I20', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H21', $row->grupo);
                    }
                    if ($row->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H22', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I22', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H23', $row->grupo);
                    }
                    if ($row->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H24', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I24', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H25', $row->grupo);
                    }
                    if ($row->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H26', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I26', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H27', $row->grupo);
                    }
                    if ($row->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H28', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I28', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H29', $row->grupo);
                    }
                    if ($row->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H30', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I30', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H31', $row->grupo);
                    }
                    if ($row->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H32', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('I32', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('H33', $row->grupo);
                    }
                }
                if ($row->id_dia == 5) {
                    if ($row->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J10', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K10', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J11', $row->grupo);
                    }
                    if ($row->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J12', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K12', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J13', $row->grupo);
                    }
                    if ($row->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J14', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K14', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J15', $row->grupo);
                    }
                    if ($row->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J16', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K16', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J17', $row->grupo);
                    }
                    if ($row->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J18', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K18', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J19', $row->grupo);
                    }
                    if ($row->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J20', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K20', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J21', $row->grupo);
                    }
                    if ($row->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J22', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K22', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J23', $row->grupo);
                    }
                    if ($row->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J24', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K24', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J25', $row->grupo);
                    }
                    if ($row->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J26', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K26', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J27', $row->grupo);
                    }
                    if ($row->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J28', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K28', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J29', $row->grupo);
                    }
                    if ($row->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J30', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K30', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J31', $row->grupo);
                    }
                    if ($row->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J32', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('K32', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('J33', $row->grupo);
                    }
                }
                if ($row->id_dia == 6) {
                    if ($row->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L10', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M10', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L11', $row->grupo);
                    }
                    if ($row->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L12', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M12', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L13', $row->grupo);
                    }
                    if ($row->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L14', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M14', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L15', $row->grupo);
                    }
                    if ($row->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L16', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M16', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L17', $row->grupo);
                    }
                    if ($row->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L18', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M18', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L19', $row->grupo);
                    }
                    if ($row->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L20', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M20', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L21', $row->grupo);
                    }
                    if ($row->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L22', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M22', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L23', $row->grupo);
                    }
                    if ($row->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L24', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M24', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L25', $row->grupo);
                    }
                    if ($row->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L26', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M26', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L27', $row->grupo);
                    }
                    if ($row->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L28', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M28', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L29', $row->grupo);
                    }
                    if ($row->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L30', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M30', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L31', $row->grupo);
                    }
                    if ($row->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L32', $row->materia);
                        $objPHPExcel->getActiveSheet()->setCellValue('M32', $row->salon);
                        $objPHPExcel->getActiveSheet()->setCellValue('L33', $row->grupo);
                    }
                }
                $periodo = $row->periodo;
            }
        }
        
        if ($resultadosActividad != NULL) {
            foreach ($resultadosActividad->result() as $rowAct) {
                if ($rowAct->id_dia == 1) {
                    if ($rowAct->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B10', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B12', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B14', $rowAct->descripcion);
                    }
                    if ($row->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B16', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B18', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B20', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B22', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B24', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B26', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B28', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B30', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('B32', $rowAct->descripcion);
                    }
                }

                if ($rowAct->id_dia == 2) {
                    if ($rowAct->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D10', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D12', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D14', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D16', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D18', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D20', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D22', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D24', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D26', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D28', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D30', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('D32', $rowAct->descripcion);
                    }
                }

                if ($rowAct->id_dia == 3) {
                    if ($rowAct->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F10', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F12', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F14', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F16', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F18', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F20', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F22', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F24', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F26', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F28', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F30', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('F32', $rowAct->descripcion);
                    }
                }

                if ($rowAct->id_dia == 4) {
                    if ($rowAct->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H10', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H12', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H14', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H16', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H18', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H20', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H22', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H24', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H26', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H28', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H30', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('H32', $rowAct->descripcion);
                    }
                }
                if ($rowAct->id_dia == 5) {
                    if ($rowAct->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J10', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J12', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J14', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J16', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J18', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J20', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J22', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J24', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J26', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J28', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J30', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('J32', $rowAct->descripcion);
                    }
                }
                if ($rowAct->id_dia == 6) {
                    if ($rowAct->id_horario == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L10', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 2) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L12', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 3) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L14', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 4) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L16', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 5) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L18', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 6) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L20', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 7) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L22', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 8) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L24', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 9) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L26', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 10) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L28', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 11) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L30', $rowAct->descripcion);
                    }
                    if ($rowAct->id_horario == 12) {
                        $objPHPExcel->getActiveSheet()->setCellValue('L32', $rowAct->descripcion);
                    }
                }
            }
        }

        $result = $this->catedratico_model->get_catedratico_by_id($id_catedratico);
        foreach ($result->result() as $row) {
            $nombre = $row->nombre;
            $ape_paterno = $row->ape_paterno;
            $ape_materno = $row->ape_materno;
            $id_carrera = $row->id_carrera;
        }

        $queryNombre = $this->carrera_model->select_name_carrera($id_carrera);
        foreach ($queryNombre->result() as $carrera) {
            $nombreCarrera = $carrera->nombre_carrera;
        }

        $resultJefe = $this->jefe_carrera_model->get_jefe_carrera_by_id($id_usuario);
        foreach ($resultJefe->result() as $rowJefe) {
            $nombreJefe = $rowJefe->nombre;
            $ape_paternoJefe = $rowJefe->ape_paterno;
            $ape_maternoJefe = $rowJefe->ape_materno;
        }
                
        $resultAcademia = $this->academia_model->get_all_academia();
        foreach ($resultAcademia->result() as $academia){
            if($academia->id_academia == 2){
                $nombreDirector = $academia->nombre;
                $paternoDirector = $academia->paterno;
                $maternoDirector = $academia->materno;
            }
            
            if($academia->id_academia == 1){
                $nombreSubdirector = $academia->nombre;
                $paternoSubdirector = $academia->paterno;
                $maternoSubdirector = $academia->materno;
            }
        }
        
        $nombreDocente = $nombre . " " . $ape_paterno . " " . $ape_materno;
        $nombreDirAcademia = $nombreDirector . " " . $paternoDirector . " " . $maternoDirector;
        $nombreSubAcademia = $nombreSubdirector . " " . $paternoSubdirector . " " . $maternoSubdirector;        
        $nombreJefeCarrera = $nombreJefe . " " . $ape_paternoJefe . " " . $ape_maternoJefe;
        $titulo = "INSTITUTO TECNOLÓGICO SUPERIOR DE COSAMALOAPAN SEMESTRE " . $periodo;
        $docente = "NOMBRE DEL DOCENTE: " . $nombreDocente;
        $academia = "ACADEMIA: " . $nombreCarrera;
        $tituloDivision = "JEFE DE DIVISIÓN " . $nombreCarrera;
        $tituloCatedratico = "CATEDRATICO DE " . $nombreCarrera;
        $horasTotales = $this->detalle_horario_model->suma_horas_periodo($id_catedratico, $id_periodo);
        $horasApoyo = $this->detalle_actividad_model->suma_horas_apoyo_periodo($id_catedratico, $id_periodo);
        $horasFinales = $horasTotales + $horasApoyo;
        
        $objPHPExcel->getActiveSheet()->setCellValue('F35', $nombreDirAcademia);
        $objPHPExcel->getActiveSheet()->setCellValue('D35', $nombreSubAcademia);
        $objPHPExcel->getActiveSheet()->setCellValue('E1', $titulo);
        $objPHPExcel->getActiveSheet()->setCellValue('A2', $docente);
        $objPHPExcel->getActiveSheet()->setCellValue('C5', $horasTotales);
        $objPHPExcel->getActiveSheet()->setCellValue('G5', $horasApoyo);
        $objPHPExcel->getActiveSheet()->setCellValue('C7', $horasFinales);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', $academia);
        $objPHPExcel->getActiveSheet()->setCellValue('A35', $nombreJefeCarrera);
        $objPHPExcel->getActiveSheet()->setCellValue('A36', $tituloDivision);
        $objPHPExcel->getActiveSheet()->setCellValue('J35', $nombreDocente);
        $objPHPExcel->getActiveSheet()->setCellValue('J36', $tituloCatedratico);


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Horario ' . $nombreDocente . '.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

}
