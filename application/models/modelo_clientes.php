<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_clientes extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function get_todos_los_clientes_activos(){
        $query=$this->db->get_where('clientes',array('Activo'=>1));
        if($query->num_rows()>0){
            return $query;
        }
        return false;
    }
    
    function insert_cliente($data){
        $this->db->insert('clientes',$data);
    }
    
    function eliminar_cliente($id){
        $this->db->where('ID',$id);
        $this->db->update('clientes',array('Activo'=>0));
        
    }
    
    function buscar_cliente($valor){
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('Activo','1');
        $this->db->like('Codigo', $valor);
        $query=$this->db->get();
        if($query){           
            return $query;
        }
        return false;
        
    }
    
    function editar_cliente($id,$data){
        $this->db->where('ID',$id);
        $this->db->update('clientes',$data);
    }
            
    function get_cliente_por_id($id_cliente){
        $query=$this->db->get_where('clientes',array('ID'=>$id_cliente));
        if($query->num_rows()>0){
            return $query;
        }
        return false;
    }
    
    function buscar_cliente_por_nombre($nombre){
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('Activo','1');
        $this->db->like('Nombre', $nombre);
        $query=$this->db->get();
        if($query){           
            return $query;
        }
        return false;
    }
  }
  ?>