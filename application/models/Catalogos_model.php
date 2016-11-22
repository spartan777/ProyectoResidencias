<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogos_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_dias(){
        $query = $this->db->get('cat_dia_semana');
        return $query;
    }
            
    public function get_all_horarios(){
        $query = $this->db->get('cat_horario');
        return $query;
    }
}
