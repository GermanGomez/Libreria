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
    
    function insert_venta_encabezado($data){
        $this->db->insert('ventas_encabezado',$data);
        return $this->db->insert_id();
    }
    
    function insert_venta_detalle($data){
        $this->db->insert('Ventas_Detalle',$data);
    }
    function get_todas_las_ventas_activas(){
        $this->db->select('Ventas_Encabezado.ID,Ventas_Encabezado.Folio,Clientes.Nombre as Cliente,Empleados.Nombre as Empleado');
        $this->db->from('Ventas_Encabezado');
        $this->db->join('Empleados', 'Empleados.Codigo = Ventas_Encabezado.Codigo_Empleado');
        $this->db->join('Clientes', 'Clientes.Codigo = Ventas_Encabezado.Codigo_Cliente');
        $this->db->where("Ventas_Encabezado.Activo",1);
        $query=$this->db->get();
        if($query){
            return $query;
        }
        return false;
    }
       function buscar_venta($valor){
        $this->db->select('Ventas_Encabezado.ID,Ventas_Encabezado.Folio,Clientes.Nombre as Cliente,Empleados.Nombre as Empleado');
        $this->db->from('Ventas_Encabezado');
        $this->db->join('Empleados', 'Empleados.Codigo = Ventas_Encabezado.Codigo_Empleado');
        $this->db->join('Clientes', 'Clientes.Codigo = Ventas_Encabezado.Codigo_Cliente');
        $this->db->where("Ventas_Encabezado.Activo",1);
        $this->db->like('Ventas_Encabezado.Folio', $valor);
        $query=$this->db->get();
        if($query){
            return $query;
        }
        return false;
        } 
    function eliminar_venta($id){
        $this->db->where('ID',$id);
        $this->db->update('Ventas_Encabezado',array('Activo'=>0));
        
    }
   function get_venta_encabezado($folio){
        $this->db->select('Ventas_Encabezado.ID,Ventas_Encabezado.Folio, Clientes.Codigo as Codigo_Cliente,Empleados.Codigo as Codigo_Empleado,'
                . ' Empleados.Usuario,Clientes.Nombre as Cliente,Empleados.Nombre as Empleado,'
                . 'Ventas_Encabezado.Monto_Total,Ventas_Encabezado.Fecha,Ventas_Encabezado.Hora');
        $this->db->from('Ventas_Encabezado');
        $this->db->join('Empleados', 'Empleados.Codigo = Ventas_Encabezado.Codigo_Empleado');
        $this->db->join('Clientes', 'Clientes.Codigo = Ventas_Encabezado.Codigo_Cliente');
        $this->db->where("Ventas_Encabezado.Activo",1);
        $this->db->like('Ventas_Encabezado.Folio', $folio);
        $query=$this->db->get();
        if($query){
            $apartado=$query->result();
            
            return $apartado[0];
        }
        return false;
    }
    function get_venta_detalle($folio){
        $this->db->select("*");
        $this->db->from('Ventas_Detalle');
        $this->db->where('Folio', $folio);
        $query=$this->db->get();
        
        if($query){
            return $query;
        }
        return false;
    }
 }

    
  ?>