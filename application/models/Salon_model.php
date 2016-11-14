<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salon_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function check_id_salon($id_salon){
        $this->db->where('id_salon', $id_salon);
        $query = $this->db->get('salones');
        return $query->num_rows();
    }
        
    public function add_salon($data){
        $this->db->insert('salones', $data);
    }
    
    public function get_all_salones(){
        $query = $this->db->get('salones');
        return $query;
    }
    
    public function get_salon_by_id($id_salon){
        $this->db->where('id_salon',$id_salon);
    	$query = $this->db->get('salones');
        return $query;
    }
    
    public function update_salon($id_salon, $nombre_salon){
        $this->db->where('id_salon',$id_salon);
    	$this->db->update('salones',$nombre_salon);
    }
    
    public function delete_salon($id_salon){
        $this->db->where('id_salon',$id_salon);
    	$this->db->delete('salones');
    }
    
}
