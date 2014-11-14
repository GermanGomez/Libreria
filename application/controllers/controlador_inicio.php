<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_inicio extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('encrypt');
        $this->load->library('session');    
        
    }
    
    
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()	{
                           $this->load->view('main/index');
                   }

                   public function iniciar_sesion(){
                       $this->load->library('form_validation');
                       $this->form_validation->set_rules('usuario', 'usuario', 'trim|required|max_length[30]');
                       $this->form_validation->set_rules('contrasenia', 'contraseña', 'trim|required|max_length[16]');
                       $usuario=$this->input->post('usuario');
                       $contrasenia=$this->input->post('contrasenia');
                       if ($this->form_validation->run() == FALSE)
                       {
                           redirect('/');
                        }else{
                            if($usuario=='admin'){
                                redirect("controlador_empleados");
                            }else{
                                redirect("controlador_inventario/index/".$usuario);
                            }
                            
                        }
                        //$this->load->view('main/index');
                   }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */