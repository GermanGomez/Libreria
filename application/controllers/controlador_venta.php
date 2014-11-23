<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_venta extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('modelo_venta');
        $this->load->model('modelo_empleados');
        $this->load->model('modelo_inventario');
    }
    
    public function index($codigo){
        $data=$this->get_datos_sesion($codigo);
        $data['Folio']=$this->modelo_venta->get_folio();
        
         $this->load->view('venta/index',$data);
    }
    private function get_datos_sesion($codigo){
        $empleado=$this->modelo_empleados->get_empleado_por_codigo($codigo);
        $data["Usuario"]=$empleado->Usuario;
        $data["Nombre"]=$empleado->Nombre;
        $data["Codigo_Empleado"]=$empleado->Codigo;
        return $data;
    }
    public function realizar_venta(){
        date_default_timezone_set('America/Mexico_City');
        $data["Folio"]=$this->input->post('folio');
        $data["Fecha"]=date("d/m/Y");
        $data["Hora"]=date("h:i:s A");
        $data["Codigo_Empleado"]=$this->input->post('empleado');
        $data["Codigo_Cliente"]=$this->input->post('cliente');
        $data["Monto_Total"]=$this->input->post('total');
        $tabla_venta=$this->input->post('tabla_venta');
        $id=$this->modelo_venta->insert_venta_encabezado($data);
        foreach($tabla_venta as $fila){     
            $nueva_existencia= $fila["existencias"]-$fila['cantidad'];
            $this->modelo_inventario->editar_inventario($fila["codigo_libro"],array("Existencias"=>$nueva_existencia));
            $this->modelo_venta->insert_venta_detalle(array(
                "Folio"=>$data["Folio"],"Codigo_Libro"=>$fila["codigo_libro"],
                "Nombre_Libro"=>$fila["nombre_libro"],
                "Cantidad"=>$fila["cantidad"],
                "Precio_Unitario"=>$fila["precio_unitario"],
                "Monto"=>$fila["monto"]
            ));
            
        }
        
    }
    public function lista_ventas($codigo){
        $data=$this->get_datos_sesion($codigo);
        $data["ventas"]=$this->modelo_venta->get_todas_las_ventas_activas();
        $this->load->view('venta/lista_ventas',$data);
        
    }
    public function buscar_venta(){
          $valor=$this->input->post('busqueda');
          $data=$this->get_datos_sesion($this->input->post('codigo_sesion'));
          if($valor==""){
              $data['ventas']=$this->modelo_venta->get_todas_las_ventas_activas();
          }else{
             $data['ventas']=$this->modelo_venta->buscar_venta($valor);
          }
          $this->load->view('venta/lista_ventas',$data); 
                  
    }
    public function eliminar_venta($id='',$codigo){
        $this->modelo_venta->eliminar_venta($id);
        redirect('controlador_venta/lista_ventas/'.$codigo);
            
     }
    private function get_venta_detalle($folio){
        return $this->modelo_venta->get_venta_detalle($folio);
    }
    private function get_venta_encabezado($folio="",$codigo){
        $data=$this->get_datos_sesion($codigo);
        $data["Encabezado"]=$this->modelo_venta->get_venta_encabezado($folio);
        return $data;
    }
    public function detalle_venta( $folio,$codigo){
        $data=$this->get_venta_encabezado($folio,$codigo);
        $data["Detalle"]=$this->get_venta_detalle($folio);
        $this->load->view('venta/detalle_venta',$data);
    }
}