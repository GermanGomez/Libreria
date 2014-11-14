<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_proveedores extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function get_todos_los_proveedores_activos(){
        $query=$this->db->get_where('proveedores',array('Activo'=>1));
        if($query->num_rows()>0){
            return $query;
        }
        return false;
    }
    
    function insert_proveedor($data){
        $this->db->insert('proveedores',$data);
    }
    
    function eliminar_proveedor($id){
        $this->db->where('ID',$id);
        $this->db->update('proveedores',array('Activo'=>0));
        
    }
    
    function buscar_proveedor($valor){
        $this->db->select('*');
        $this->db->from('proveedores');
        $this->db->where('Activo','1');
        $this->db->like('Codigo', $valor);
        $query=$this->db->get();
        if($query){           
            return $query;
        }
        return false;
        
    }
    
    function editar_proveedor($id,$data){
        $this->db->where('ID',$id);
        $this->db->update('proveedores',$data);
    }
            
    function get_proveedor_por_id($id_proveedor){
        $query=$this->db->get_where('proveedores',array('ID'=>$id_proveedor));
        if($query->num_rows()>0){
            return $query;
        }
        return false;
    }
    
  }
  ?>