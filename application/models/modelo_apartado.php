<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_apartado extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_folio(){
        $query=$this->db->query("SELECT AUTO_INCREMENT AS Folio FROM INFORMATION_SCHEMA.TABLES 
			WHERE TABLE_NAME = 'Apartados_Encabezado' AND TABLE_SCHEMA='Libreria'");
        
        if($query){
            foreach($query->result() as $apartado_encabezado){
                return $apartado_encabezado->Folio;
            }
        }
        return false;
    }
    function get_todos_los_apartados_activos(){
        $this->db->select('Apartados_Encabezado.ID,Apartados_Encabezado.Folio,Clientes.Nombre as Cliente,Empleados.Nombre as Empleado');
        $this->db->from('Apartados_Encabezado');
        $this->db->join('Empleados', 'Empleados.Codigo = Apartados_Encabezado.Codigo_Empleado');
        $this->db->join('Clientes', 'Clientes.Codigo = Apartados_Encabezado.Codigo_Cliente');
        $this->db->where("Apartados_Encabezado.Activo",1);
        $query=$this->db->get();
        if($query){
            return $query;
        }
        return false;
    }
    
    function insert_apartado_encabezado($data){
        $this->db->insert('apartados_encabezado',$data);
        return $this->db->insert_id();
        //return get_folio_encabezado($this->db->insert_id());
    }
    function insert_apartado_detalle($data){
        $this->db->insert('apartados_detalle',$data);
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
    function eliminar_apartado($id){
        $this->db->where('ID',$id);
        $this->db->update('Apartados_Encabezado',array('Activo'=>0));
        
    }
    
    function buscar_apartado($valor){
        $this->db->select('Apartados_Encabezado.ID,Apartados_Encabezado.Folio,Clientes.Nombre as Cliente,Empleados.Nombre as Empleado');
        $this->db->from('Apartados_Encabezado');
        $this->db->join('Empleados', 'Empleados.Codigo = Apartados_Encabezado.Codigo_Empleado');
        $this->db->join('Clientes', 'Clientes.Codigo = Apartados_Encabezado.Codigo_Cliente');
        $this->db->where("Apartados_Encabezado.Activo",1);
        $this->db->like('Apartados_Encabezado.Folio', $valor);
        $query=$this->db->get();
        if($query){
            return $query;
        }
        return false;
    }
    function get_apartado_encabezado($folio){
        $this->db->select('Apartados_Encabezado.ID,Apartados_Encabezado.Folio, Clientes.Codigo as Codigo_Cliente,Empleados.Codigo as Codigo_Empleado, Empleados.Usuario,Clientes.Nombre as Cliente,Empleados.Nombre as Empleado');
        $this->db->from('Apartados_Encabezado');
        $this->db->join('Empleados', 'Empleados.Codigo = Apartados_Encabezado.Codigo_Empleado');
        $this->db->join('Clientes', 'Clientes.Codigo = Apartados_Encabezado.Codigo_Cliente');
        $this->db->where("Apartados_Encabezado.Activo",1);
        $this->db->like('Apartados_Encabezado.Folio', $folio);
        $query=$this->db->get();
        if($query){
            $apartado=$query->result();
            return $apartado[0];
        }
        return false;
    }
    function buscar_apartados_detalle_por_cliente($codigo_cliente){
        $this->db->select("Apartados_Detalle.Codigo_Libro, Apartados_Detalle.Nombre_Libro,Apartados_Detalle.Cantidad");
        $this->db->from("Apartados_Detalle");
        $this->db->join('Apartados_Encabezado','Apartados_Encabezado.Folio=Apartados_Detalle.Folio');
        $this->db->where('Apartados_Encabezado.Codigo_Cliente',$codigo_cliente);
        $this->db->where('Apartados_Encabezado.Activo',1);
        $query=$this->db->get();
        if($query){
            return $query;
        }
        return false;
    }
    function get_apartado_detalle($folio){
        $this->db->select("*");
        $this->db->from('Apartados_Detalle');
        $this->db->where('Folio', $folio);
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