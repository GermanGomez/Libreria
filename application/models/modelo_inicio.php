<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_inicio extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function validar_usuario($usuario,$contrasenia){
        $this->db->select("*");
        $this->db->from("empleados");
        $this->db->where("Usuario",$usuario);
        $this->db->where("Contrasenia",$contrasenia);
        $this->db->where("Activo",'1');
        $query=$this->db->get();
        if($query && $query->num_rows()>0){
            $sesion=$query->result();
            return $sesion[0];
        }
        return false;
    }
  }
  ?>