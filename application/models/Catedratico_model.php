<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catedratico_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
     public function check_id_catedratico($id_catedratico){
        $this->db->where('id_catedratico', $id_catedratico);
        $query = $this->db->get('catedratico');
        return $query->num_rows();
    }
        
    public function add_catedratico($data){
        $this->db->insert('catedratico', $data);
    }
    
    public function get_all_catedratico(){
        $query = $this->db->get('catedratico');
        return $query;
    }
    
    public function get_catedratico_by_id($id_catedratico){
        $this->db->where('id_catedratico',$id_catedratico);
    	$query = $this->db->get('catedratico');
        return $query;
    }
    
    public function get_catedratico_by_carrera($id_carrera){
        $this->db->where('id_carrera',$id_carrera);
    	$query = $this->db->get('catedratico');
        return $query;
    }
    
    public function update_catedratico($id_catedratico, $data){
        $this->db->where('id_catedratico',$id_catedratico);
    	$this->db->update('catedratico',$data);
    }
    
    public function delete_catedratico($id_catedratico){
        $this->db->where('id_catedratico',$id_catedratico);
    	$this->db->delete('catedratico');
    }
}
