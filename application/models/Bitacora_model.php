<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bitacora_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function filas() {
        $consulta = $this->db->get('bitacora');
        return $consulta->num_rows();
    }

    //obtenemos todas las provincias a paginar con la función
    //total_posts_paginados pasando la cantidad por página y el segmento
    //como parámetros de la misma
    function total_paginados($por_pagina, $segmento) {
        $consulta = $this->db->get('bitacora', $por_pagina, $segmento);
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $fila) {
                $data[] = $fila;
            }
            return $data;
        }
    }
    
    public function insert_bitacora($data){
        $this->db->insert('bitacora', $data);
    }

}
