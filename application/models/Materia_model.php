<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materia_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function check_id_materia($id_materia){
        $this->db->where('id_materia', $id_materia);
        $query = $this->db->get('materias');
        return $query->num_rows();
    }
        
    public function add_materia($data){
        $this->db->insert('materias', $data);
    }
    
    public function get_all_materias(){
        $query = $this->db->get('materias');
        return $query;
    }
    
    public function get_materia_by_id_carrera($id_carrera){
        $this->db->where('id_carrera',$id_carrera);
    	$query = $this->db->get('materias');
        return $query;
    }
    
    public function get_materia_by_id($id_materia){
        $this->db->where('id_materia',$id_materia);
    	$query = $this->db->get('materias');
        return $query;
    }
    
    public function update_materia($id_materia, $data){
        $this->db->where('id_materia',$id_materia);
    	$this->db->update('materias',$data);
    }
    
    public function delete_materia($id_materia){
        $this->db->where('id_materia',$id_materia);
        $this->db->delete('materias');
    }
    
    public function count_materia_of_detalle($id_materia){
        $this->db->where('id_materia',$id_materia);
    	$query = $this->db->get('detalle_horario');
        return $query->num_rows;
    }
    
}
