<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Academia_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_academia() {
        $query = $this->db->get('academia');
        return $query;
    }
    
    public function get_academia_by_id($id_academia){
        $this->db->where('id_academia', $id_academia);
        $query = $this->db->get('academia');
        return $query;
    }

    public function update_academia($id_academia, $datos) {
        $this->db->where('id_academia', $id_academia);
        $this->db->update('academia', $datos);
    }

}
