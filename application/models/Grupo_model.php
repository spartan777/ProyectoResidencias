<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupo_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function check_id_grupo($id_grupo){
        $this->db->where('id_grupo', $id_grupo);
        $query = $this->db->get('grupos');
        return $query->num_rows();
    }
        
    public function add_grupo($data){
        $this->db->insert('grupos', $data);
    }
    
    public function get_all_grupos(){
        $query = $this->db->get('grupos');
        return $query;
    }
    
    public function get_grupo_by_id($id_grupo){
        $this->db->where('id_grupo',$id_grupo);
    	$query = $this->db->get('grupos');
        return $query;
    }
    
    public function get_grupo_by_id_carrera($id_carrera){
        $this->db->where('id_carrera',$id_carrera);
    	$query = $this->db->get('grupos');
        return $query;
    }
    
    public function update_grupo($id_grupo, $nombre_grupo){
        $this->db->where('id_grupo',$id_grupo);
    	$this->db->update('grupos',$nombre_grupo);
    }
    
    public function delete_grupo($id_grupo){
        $this->db->where('id_grupo',$id_grupo);
        $this->db->delete('grupos');
    }
    
    public function count_grupo_of_detalle($id_grupo){
        $this->db->where('id_catedratico',$id_grupo);
    	$query = $this->db->get('detalle_horario');
        return $query->num_rows;
    }
    
}
