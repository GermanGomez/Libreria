<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_venta extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_folio(){
        $query=$this->db->query("SELECT AUTO_INCREMENT AS Folio FROM INFORMATION_SCHEMA.TABLES 
			WHERE TABLE_NAME = 'Ventas_Encabezado' AND TABLE_SCHEMA='Libreria'");
        
        if($query){
            foreach($query->result() as $apartado_encabezado){
                return $apartado_encabezado->Folio;
            }
        }
        return false;
    }
    function get_todos_los_inventarios_activos(){
        $query=$this->db->get_where('libros',array('Activo'=>1));
        if($query->num_rows()>0){
            return $query;
        }
        return false;
    }
    
    function insert_apartado_encabezado($data){
        $this->db->insert('apartados_encabezado',$data);
        return get_folio_encabezado($this->db->insert_id());
    }
    
    function get_folio_encabezado($id){
        $this->db->select('*');
        $this->db->from('apartados_encabezado');
        $this->db->where('Activo','1');
        $this->db->like('ID', $id);
        $query=$this->db->get();
        if($query){           
            foreach($query->result() as $apartado_encabezado){
                return $apartado_encabezado->ID;
            }
        }
        return false;
    }
    function eliminar_inventario($id){
        $this->db->where('ID',$id);
        $this->db->update('libros',array('Activo'=>0));
        
    }
    
    function buscar_inventario($valor){
        $this->db->select('*');
        $this->db->from('libros');
        $this->db->where('Activo','1');
        $this->db->like('Codigo', $valor);
        $query=$this->db->get();
        if($query){           
            return $query;
        }
        return false;
        
    }
    
    function buscar_libro($nombre){
        $this->db->select('*');
        $this->db->from('libros');
        $this->db->where('Activo','1');
        $this->db->where('Existencias >',0);
        $this->db->like('Nombre', $nombre);
        $query=$this->db->get();
        if($query){           
            return $query;
        }
        return false;
    }
    
    function editar_inventario($id,$data){
        $this->db->where('ID',$id);
        $this->db->update('libros',$data);
    }
            
    function get_inventario_por_id($id_inventario){
        $query=$this->db->get_where('libros',array('ID'=>$id_inventario));
        if($query->num_rows()>0){
            return $query;
        }
        return false;
    }
    
  }
  ?>