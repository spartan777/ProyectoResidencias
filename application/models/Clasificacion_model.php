<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clasificacion_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function check_id_clasificacion($id_clasificacion){
        $this->db->where('id_clasificacion', $id_clasificacion);
        $query = $this->db->get('clasificacion');
        return $query->num_rows();
    }
        
    public function add_clasificacion($data){
        $this->db->insert('clasificacion', $data);
    }
    
    public function get_all_clasificacion(){
        $query = $this->db->get('clasificacion');
        return $query;
    }
    
    public function get_clasificacion_by_id_carrera($id_carrera){
        $this->db->where('id_clasificacion',$id_carrera);
    	$query = $this->db->get('clasificacion');
        return $query;
    }
    
    public function get_clasificacion_by_id($id_clasificacion){
        $this->db->where('id_clasificacion',$id_clasificacion);
    	$query = $this->db->get('clasificacion');
        return $query;
    }
    
    public function update_clasificacion($id_clasificacion, $data){
        $this->db->where('id_clasificacion',$id_clasificacion);
    	$this->db->update('clasificacion',$data);
    }
    
    public function delete_clasificacion($id_clasificacion){
        $this->db->where('id_clasificacion',$id_clasificacion);
        $this->db->delete('clasificacion');
    }
    
}
