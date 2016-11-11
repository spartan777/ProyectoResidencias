<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jefe_carrera_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function check_id_jefe_carrera($id_usuario){
        $this->db->where('id_usuario', $id_usuario);
        $query = $this->db->get('jefe_carrera');
        return $query->num_rows();
    }
    
    public function check_carrera_jefe_carrera($id_carrera){
        $this->db->where('id_carrera', $id_carrera);
        $query = $this->db->get('jefe_carrera');
        return $query->num_rows();
    }
    
    public function add_jefe_carrera($data){
        $this->db->insert('jefe_carrera', $data);
    }
    
    public function get_all_jefe_carrera(){
        $query = $this->db->get('jefe_carrera');
        return $query;
    }
    
    public function get_jefe_carrera_by_id($id_usuario){
        $this->db->where('id_usuario', $id_usuario);
        $query = $this->db->get('jefe_carrera');
        return $query;
    }
    
    public function update_jefe_carrera($id_usuario, $data){
        $this->db->where('id_usuario',$id_usuario);
    	$this->db->update('jefe_carrera',$data);
    }
    
    public function delete_jefe_carrera($id_usuario){
        $this->db->where('id_usuario',$id_usuario);
    	$this->db->delete('jefe_carrera');
    }
   
}
