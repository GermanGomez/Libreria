<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_inicio extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->model("modelo_inicio");
        $this->set_validaciones();
    }
    
    public function index(){
         $this->load->view("main/index");
    }
                   
    private  function set_validaciones(){
         $this->load->library('form_validation');
         $this->set_mensajes_validaciones();
         $this->form_validation->set_rules('usuario', 'usuario', 'trim|required|max_length[30]');
          $this->form_validation->set_rules('contrasenia', 'contraseña', 'trim|required|max_length[16]');                     
    }
                   
    private function set_mensajes_validaciones(){
         $this->form_validation->set_message('required', 'El campo %s es obligatorio');
         $this->form_validation->set_message('max_length', 'El campo %s es obligatorio %s');
    }

    public function iniciar_sesion(){
         $usuario=$this->input->post('usuario');
         $contrasenia=$this->input->post('contrasenia');
        if ($this->form_validation->run() == FALSE)
        {
                  $this->load->view("main/index");
         }else{
                 $sesion=$this->modelo_inicio->validar_usuario($usuario,$contrasenia);
                  if($sesion==false){
                           $this->load->view("main/index");
                  }else{
                           $this->es_administrador($sesion);
                  }
         }
    }
                           
    private function es_administrador($usuario){
         if($usuario->Usuario=='admin'){
                  redirect("controlador_empleados/index/".$usuario->Codigo);
         }else{
                  redirect("controlador_inventario/index/".$usuario->Codigo);
                 }
        }
     
}
