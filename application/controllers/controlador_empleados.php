<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_empleados extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session'); 
        $this->load->model('modelo_empleados');
    }
    
    public function index(){
         $data['empleados']=$this->modelo_empleados->get_todos_los_empleados_activos();
         
         $this->load->view('empleados/index',$data);
    }
    
    public function agregar_empleado(){
//activar_validaciones();
//        $this->load->view('empleados/agregar');
         $this->load->library('form_validation');
         $this->form_validation->set_rules('codigo', 'código', 'required|is_natura|max_length[10]|min_length[1]');
         $this->form_validation->set_rules('nombre','nombre','required');
         $this->form_validation->set_rules('telefono','teléfono','required|is_natural|max_length[10]|min_length[10]');
         $this->form_validation->set_rules('direccion','dirección','required');
         $this->form_validation->set_rules('correo','correo','required|valid_email');
         $this->form_validation->set_rules('usuario', 'usuario', 'required|alpha_dash|max_length[30]|min_length[1]');
         $this->form_validation->set_rules('contrasenia', 'contraseña', 'required|max_length[16]|min_length[8]');
         
         $this->form_validation->set_message('required','El campo %s es obligatorio');
        $data['Titulo']="Registro de  Empleados";
        $data['Controlador']=base_url()."index.php/controlador_empleados/agregar_empleado";
        $data['Codigo']=$this->input->post('codigo');
        $data['Nombre']=$this->input->post('nombre');
        $data['Telefono']=$this->input->post('telefono');
        $data['Direccion']=$this->input->post('direccion');
        $data['Correo']=$this->input->post('correo');
        $data['Usuario']=$this->input->post('usuario');
        $data['Contrasenia']=$this->input->post('contrasenia');
        $data['Boton']=" <button class='btn-success  btn-lg' type='submit'><span class='glyphicon glyphicon-floppy-disk'></span> Agregar</button>";
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('empleados/agregar',$data);
        }else{
            $this->modelo_empleados->insert_empleado(array(
                'Codigo'=>$data['Codigo'],
                'Nombre'=>$data['Nombre'],'Telefono'=>$data['Telefono'],'Direccion'=>$data['Direccion'],'Correo'=>$data['Correo'],'Usuario'=>$data['Usuario'],'Contrasenia'=>$data['Contrasenia']));
            redirect('controlador_empleados');   
         }
    }
   
    public function editar_empleado($id_empleado='', $bandera=TRUE){
        if($id_empleado!=""){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('codigo', 'código', 'required|is_natura|max_length[10]|min_length[1]');
            $this->form_validation->set_rules('nombre','nombre','required');
            $this->form_validation->set_rules('telefono','teléfono','required|is_natural|max_length[10]|min_length[10]');
            $this->form_validation->set_rules('direccion','dirección','required');
            $this->form_validation->set_rules('correo','correo','required|valid_email');
            $this->form_validation->set_rules('usuario', 'usuario', 'required|alpha_dash|max_length[30]|min_length[1]');
            $this->form_validation->set_rules('contrasenia', 'contraseña', 'required|max_length[16]|min_length[4]');
         
            $this->form_validation->set_message('required','El campo %s es obligatorio');
            $data['Titulo']="Edición de  Empleado";
            $data['Controlador']=base_url()."index.php/controlador_empleados/editar_empleado/".$id_empleado."/FALSE";
            if($bandera===TRUE){
                    $consulta=$this->modelo_empleados->get_empleado_por_id($id_empleado);
                    if($consulta){
                        foreach($consulta->result() as $empleado){
                          $data['Codigo']=$empleado->Codigo;
                          $data['Nombre']=$empleado->Nombre;
                          $data['Telefono']=$empleado->Telefono;
                          $data['Direccion']=$empleado->Direccion;
                          $data['Correo']=$empleado->Correo;
                          $data['Usuario']=$empleado->Usuario;
                          $data['Contrasenia']=$empleado->Codigo;
                    }
                }                
            }else{
                $data['Codigo']=$this->input->post('codigo');
                $data['Nombre']=$this->input->post('nombre');
                $data['Telefono']=$this->input->post('telefono');
                $data['Direccion']=$this->input->post('direccion');
                $data['Correo']=$this->input->post('correo');
                $data['Usuario']=$this->input->post('usuario');
                $data['Contrasenia']=$this->input->post('contrasenia');
            }
            $data['Boton']=" <button class='btn-primary  btn-lg' type='submit'><span class='glyphicon glyphicon-edit'></span> Editar</button>";        
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('empleados/agregar',$data);
            }else{
                $this->modelo_empleados->editar_empleado($id_empleado,array(
                    'Codigo'=>$data['Codigo'],'Nombre'=>$data['Nombre'], 'Telefono'=>$data['Telefono'],
                    'Direccion'=>$data['Direccion'],'Correo'=>$data['Correo'],'Usuario'=>$data['Usuario'],
                    'Contrasenia'=>$data['Contrasenia']));
                redirect('controlador_empleados');   
            }
        }else{
            redirect('controlador_empleados');
        }
        
    }
    
    public function buscar_empleado(){
          $valor=$this->input->post('busqueda');
          if($valor==""){
              $data['empleados']=$this->modelo_empleados->get_todos_los_empleados_activos();
          }else{
             $data['empleados']=$this->modelo_empleados->buscar_empleado($valor);
          }

          $this->load->view('empleados/index',$data); 
                  
    }
    
    public function eliminar_empleado($id=''){
       
        $this->modelo_empleados->eliminar_empleado($id);
        redirect('controlador_empleados');
            
     }
     
     
}