<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_empleados extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function get_todos_los_empleados_activos(){
        $query=$this->db->get_where('empleados',array('Activo'=>1));
        if($query->num_rows()>0){
            return $query;
        }
        return false;
    }
    
    function insert_empleado($data){
        $this->db->insert('empleados',$data);
    }
    
    function eliminar_empleado($id){
        $this->db->where('ID',$id);
        $this->db->update('empleados',array('Activo'=>0));
        
    }
    
    function buscar_empleado($valor){
        $this->db->select('*');
        $this->db->from('empleados');
        $this->db->where('Activo','1');
        $this->db->like('Codigo', $valor);
        $query=$this->db->get();
        if($query){           
            return $query;
        }
        return false;
        
    }
    
    function editar_empleado($id,$data){
        $this->db->where('ID',$id);
        $this->db->update('empleados',$data);
    }
            
    function get_empleado_por_id($id_empleado){
        $query=$this->db->get_where('empleados',array('ID'=>$id_empleado,'Activo'=>1));
        if($query->num_rows()>0){
            return $query;
        }
        return false;
    }
    function get_empleado_por_codigo($Codigo){
        $query=$this->get_empleado_por_id($Codigo);
        if($query->num_rows()>0){
            $empleado=$query->result();
            return $empleado[0];
        }
        return false;
    }
  }
  ?>