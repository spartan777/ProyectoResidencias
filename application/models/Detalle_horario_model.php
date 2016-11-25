<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detalle_horario_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_detalle_horario_by_id_catedratico($id_catedratico){
        $queryBD = "SELECT dh.id_detalle AS detalle, g.nombre AS grupo, h.desc_horario AS hora, ds.desc_dia_semana AS dia, "
                . "s.nombre AS salon, m.nombre AS materia, dh.id_dia_semana AS id_dia, dh.id_horario AS id_horario, dh.periodo AS periodo "
                . "FROM detalle_horario dh, cat_horario h, cat_dia_semana ds, salones s, materias m, grupos g "
                . "WHERE dh.id_dia_semana = ds.id_dia_semana AND dh.id_horario = h.id_horario AND dh.id_grupo = g.id_grupo "
                . "AND dh.id_materia = m.id_materia AND dh.id_salon = s.id_salon AND dh.id_catedratico = '$id_catedratico' "
                . "ORDER BY ds.id_dia_semana, h.id_horario";
      
        $query = $this->db->query($queryBD);
        return $query;       
    }
    
    public function check_detalle_horario($id_salon, $id_horario, $id_dia_semana){
        $this->db->where('id_salon', $id_salon);
        $this->db->where('id_horario', $id_horario);
        $this->db->where('id_dia_semana', $id_dia_semana);
        $query = $this->db->get('detalle_horario');
        return $query->num_rows();
    }
    
    public function insert_detalle_horario($data){
        $this->db->insert('detalle_horario',$data);
    }

    public function suma_horas_teoricas($id_catedratico){
        $sumaHoras = 0;
        $this->db->where('id_catedratico', $id_catedratico);
        $query = $this->db->get('detalle_horario');
        
        if($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $id_materia = $row->id_materia;
                $this->db->where('id_materia', $id_materia);
                $queryMaterias = $this->db->get('materias');
                foreach ($queryMaterias->result() as $rowMaterias){
                    $sumaHoras = $sumaHoras + $rowMaterias->horas_teoricas;
                }
            }
        }
        
        return $sumaHoras;
    }
    
    public function suma_horas_practicas($id_catedratico){
        $sumaHoras = 0;
        $this->db->where('id_catedratico', $id_catedratico);
        $query = $this->db->get('detalle_horario');
        
        if($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $id_materia = $row->id_materia;
                $this->db->where('id_materia', $id_materia);
                $queryMaterias = $this->db->get('materias');
                foreach ($queryMaterias->result() as $rowMaterias){
                    $sumaHoras = $sumaHoras + $rowMaterias->horas_practicas;
                }
            }
        }
        
        return $sumaHoras;
    }
}
