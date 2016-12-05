<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Periodo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function check_id_periodo($id_periodo){
        $this->db->where('id_periodo', $id_periodo);
        $query = $this->db->get('periodos');
        return $query->num_rows();
    }
        
    public function add_periodo($data){
        $this->db->insert('periodos', $data);
    }
    
    public function get_all_periodos(){
        $query = $this->db->get('periodos');
        return $query;
    }
    
    public function get_periodo_by_id($id_periodo){
        $this->db->where('id_periodo',$id_periodo);
    	$query = $this->db->get('periodos');
        return $query;
    }
    
    public function update_periodo($id_periodo, $data){
        $this->db->where('id_periodo',$id_periodo);
        $this->db->update('periodos',$data);
    }
    
    public function delete_periodo($id_periodo){
        $this->db->where('id_periodo',$id_periodo);
    	$this->db->delete('periodos');
    }
    
    public function count_periodo_of_detalle($id_periodo){
        $this->db->where('id_periodo',$id_periodo);
    	$query = $this->db->get('detalle_horario');
        return $query->num_rows();
    }
    
}
