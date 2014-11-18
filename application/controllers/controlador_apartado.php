<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_apartado extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');    
        $this->load->library('session');
        $this->load->model('modelo_apartado');
        $this->load->model('modelo_empleados');
    }
    
    public function index($codigo){
         $data=$this->get_datos_sesion($codigo);
         $this->load->view('apartado/index',$data);
    }
   private function get_datos_sesion($codigo){
        $empleado=$this->modelo_empleados->get_empleado_por_codigo($codigo);
        $data["Usuario"]=$empleado->Usuario;
        $data["Nombre"]=$empleado->Nombre;
        $data["Codigo_Empleado"]=$empleado->Codigo;
        return $data;
    }
    public function agregar_apartado(){
         $data['Folio']=$this->modelo_apartado->get_folio();
         $data['Codigo_Empleado']="";
         $this->load->view('apartado/apartado',$data);
    }
    
    public function registrar_apartado(){
        $data['Folio']=$this->input->post('folio');
        $data['Codigo_Empleado']=$this->input->post('codigo_empleado');
        $data['Codigo_Cliente']=$this->input->post('codigo_cliente');
    }
    
}