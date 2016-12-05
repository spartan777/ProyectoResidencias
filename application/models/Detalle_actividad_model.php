<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Detalle_actividad_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_detalle_actividad_by_id_catedratico($id_catedratico){
        $queryBD = "SELECT dh.id_detalle_act AS detalle, h.desc_horario AS hora, ds.desc_dia_semana AS dia, c.*, "
                . "dh.id_dia_semana AS id_dia, dh.id_horario AS id_horario "
                . "FROM detalle_actividad dh, cat_horario h, cat_dia_semana ds, clasificacion c "
                . "WHERE dh.id_dia_semana = ds.id_dia_semana AND dh.id_horario = h.id_horario "
                . "AND dh.id_clasificacion = c.id_clasificacion AND dh.id_catedratico = '$id_catedratico' "
                . "ORDER BY ds.id_dia_semana, h.id_horario";
      
        $query = $this->db->query($queryBD);
        return $query;       
    }
    
    public function get_detalle_actividad_by_id_catedratico_descargar($id_catedratico, $id_periodo){
        $queryBD = "SELECT dh.id_detalle_act AS detalle, h.desc_horario AS hora, ds.desc_dia_semana AS dia, c.*, "
                . "dh.id_dia_semana AS id_dia, dh.id_horario AS id_horario "
                . "FROM detalle_actividad dh, cat_horario h, cat_dia_semana ds, clasificacion c "
                . "WHERE dh.id_dia_semana = ds.id_dia_semana AND dh.id_horario = h.id_horario "
                . "AND dh.id_clasificacion = c.id_clasificacion AND dh.id_catedratico = '$id_catedratico' AND dh.id_periodo = '$id_periodo'"
                . "ORDER BY ds.id_dia_semana, h.id_horario";
      
        $query = $this->db->query($queryBD);
        return $query;       
    }
    
    public function check_detalle_horario($id_catedratico, $id_horario, $id_dia_semana,$id_periodo){
        $this->db->where('id_catedratico', $id_catedratico);
        $this->db->where('id_horario', $id_horario);
        $this->db->where('id_dia_semana', $id_dia_semana);
        $this->db->where('id_periodo', $id_periodo);
        $query = $this->db->get('detalle_horario');
        return $query->num_rows();
    }
    
    public function check_detalle_actividad($id_catedratico, $id_horario, $id_dia_semana,$id_periodo){
        $this->db->where('id_catedratico', $id_catedratico);
        $this->db->where('id_horario', $id_horario);
        $this->db->where('id_dia_semana', $id_dia_semana);
        $this->db->where('id_periodo', $id_periodo);
        $query = $this->db->get('detalle_actividad');
        return $query->num_rows();
    }
    
    public function insert_detalle_actividad($data){
        $this->db->insert('detalle_actividad',$data);
    }

    public function suma_horas_apoyo($id_catedratico){
        $this->db->where('id_catedratico', $id_catedratico);
        $query = $this->db->get('detalle_actividad');
        
        return $query->num_rows();
    }
    
    public function suma_horas_apoyo_periodo($id_catedratico, $id_periodo){
        $this->db->where('id_catedratico', $id_catedratico);
        $this->db->where('id_periodo', $id_periodo);
        $query = $this->db->get('detalle_actividad');
        
        return $query->num_rows();
    }
    
    public function delete_detalle_actividad($id_horario){
        $this->db->where('id_detalle_act', $id_horario);
        $this->db->delete('detalle_actividad');
    }
    
}
