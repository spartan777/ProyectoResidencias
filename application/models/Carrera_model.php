<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrera_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function check_id_carrera($id_carrera){
        $this->db->where('id_carrera', $id_carrera);
        $query = $this->db->get('carreras');
        return $query->num_rows();
    }
    
    public function check_nombre_carrera($nombre_carrera){
        $this->db->where('nombre_carrera', $nombre_carrera);
        $query = $this->db->get('carreras');
        return $query->num_rows();
    }
    
    public function add_carrera($data){
        $this->db->insert('carreras', $data);
    }
    
    public function get_all_carreras(){
        $query = $this->db->get('carreras');
        return $query;
    }
    
    public function get_by_id_carrera($id_carrera){
        $this->db->where('id_carrera',$id_carrera);
    	$query = $this->db->get('carreras');
        return $query;
    }
    
    public function update_carrera($id_carerra, $nombre_carrera){
        $this->db->where('id_carrera',$id_carerra);
    	$this->db->update('carreras',$nombre_carrera);
    }
    
    public function delete_carrera($id_carrera){
        $this->db->where('id_carrera',$id_carrera);
    	$this->db->delete('carreras');
    }
    
    public function count_carrera_of_jefe($id_carrera){
        $this->db->where('id_carrera',$id_carrera);
    	$query = $this->db->get('jefe_carrera');
        return $query->num_rows();
    }
    
    public function count_carrera_of_materia($id_carrera){
        $this->db->where('id_carrera',$id_carrera);
    	$query = $this->db->get('materias');
        return $query->num_rows();
    }
    
    public function count_carrera_of_grupo($id_carrera){
        $this->db->where('id_carrera',$id_carrera);
    	$query = $this->db->get('grupos');
        return $query->num_rows();
    }
    
    public function count_carrera_of_catedratico($id_carrera){
        $this->db->where('id_carrera',$id_carrera);
    	$query = $this->db->get('catedratico');
        return $query->num_rows();
    }
    
    public function select_name_carrera($id_carrera){
        $this->db->select('nombre_carrera');
        $this->db->where('id_carrera', $id_carrera);
        $query = $this->db->get('carreras');
        return $query;
    }
}
