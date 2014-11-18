<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_venta extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('modelo_venta');
        $this->load->model('modelo_empleados');
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
    public function agregar_venta(){
         $vistas["header"]=$this->load->view('main/header','',TRUE);
         $vistas["footer"]=$this->load->view('main/footer','',TRUE);
         $vistas["body"]=$this->load->view('proveedores/agregar','',TRUE);
         $this->load->view('main/template',$vistas);
    }
    
}