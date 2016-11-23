<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    } 
    
    public function buscar_usuario($nombre_usuario, $pass_usuario, $tipo_usuario){
        $this->db->where('nombre_usuario', $nombre_usuario);
        $this->db->where('pass_usuario', $pass_usuario);
        $this->db->where('tipo_usuario', $tipo_usuario);
        $query = $this->db->get('usuario');
        return $query->row();
    }
    
    public function insert_usuario($data){
        $this->db->insert('usuario', $data);
    }
    
    public function delete_usuario($id_usuario){
        $this->db->where('clave_usuario',$id_usuario);
    	$this->db->delete('usuario');
    }
}
