<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_venta extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('modelo_venta');
    }
    
    public function index(){
        $data['Folio']=$this->modelo_venta->get_folio();
        $data['Codigo_Empleado']="";
         $this->load->view('venta/index',$data);
    }
    
    public function agregar_venta(){
         $vistas["header"]=$this->load->view('main/header','',TRUE);
         $vistas["footer"]=$this->load->view('main/footer','',TRUE);
         $vistas["body"]=$this->load->view('proveedores/agregar','',TRUE);
         $this->load->view('main/template',$vistas);
    }
    
}