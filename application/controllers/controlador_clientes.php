<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_clientes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session'); 
        $this->load->model('modelo_clientes');
        $this->load->model('modelo_empleados');
        $this->set_validaciones();
    }
    
    public function index($codigo){
        $data=$this->get_datos_sesion($codigo);
        $data['clientes']=$this->modelo_clientes->get_todos_los_clientes_activos();
         $this->load->view('clientes/index',$data);
    }
    
    private function get_datos_sesion($codigo){
        $empleado=$this->modelo_empleados->get_empleado_por_codigo($codigo);
        $data["Usuario"]=$empleado->Usuario;
        $data["Nombre_Empleado"]=$empleado->Nombre;
        $data["Codigo_Empleado"]=$empleado->Codigo;
        return $data;
    }
    
    private function get_post_cliente($codigo){
        $data=$this->get_datos_sesion($codigo);
        $data['Codigo']=$this->modelo_clientes->get_codigo();//$this->input->post('codigo');
        $data['Nombre']=$this->input->post('nombre');
        $data['Telefono']=$this->input->post('telefono');
        $data['Direccion']=$this->input->post('direccion');
        $data['Correo']=$this->input->post('correo');
        return $data;
    }
    public function agregar_cliente($codigo){
        $data=$this->get_post_cliente($codigo);
        $data['Titulo']="Registro de  clientes";
        $data['Controlador']=base_url()."index.php/controlador_clientes/agregar_cliente/".$codigo;
        $data['Boton']=" <button class='btn-success  btn-lg' type='submit'><span class='glyphicon glyphicon-floppy-disk'></span> Agregar</button>";
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('clientes/agregar',$data);
        }else{
            $this->modelo_clientes->insert_cliente(array(
                'Codigo'=>$data['Codigo'],
                'Nombre'=>$data['Nombre'],'Telefono'=>$data['Telefono'],'Direccion'=>$data['Direccion'],'Correo'=>$data['Correo']));
            redirect('controlador_clientes/index/'.$codigo);   
         }
    }
   private function set_validaciones(){
            $this->load->library('form_validation');
            $this->set_mensajes_validacion();
            $this->form_validation->set_rules('codigo', 'código', 'required|is_natura|max_length[10]|min_length[1]');
            $this->form_validation->set_rules('nombre','nombre','required');
            $this->form_validation->set_rules('telefono','teléfono','required|is_natural|max_length[10]|min_length[1]');
            $this->form_validation->set_rules('direccion','dirección','required');
            $this->form_validation->set_rules('correo','correo','required|valid_email');
   }
   private function set_mensajes_validacion(){
       $this->form_validation->set_message('required','El campo %s es obligatorio');
   }
   private function get_cliente($consulta, $codigo){
       $data=$this->get_datos_sesion($codigo);
        if($consulta){
                        foreach($consulta->result() as $cliente){
                          $data['Codigo']=$cliente->Codigo;
                          $data['Nombre']=$cliente->Nombre;
                          $data['Telefono']=$cliente->Telefono;
                          $data['Direccion']=$cliente->Direccion;
                          $data['Correo']=$cliente->Correo;
                    }
                }
         return $data;
   }
    public function editar_cliente($id_cliente='',$codigo, $bandera=TRUE){
        if($id_cliente!=""){
            if($bandera===TRUE){
                $data=$this->get_cliente($this->modelo_clientes->get_cliente_por_id($id_cliente), $codigo);
            }else{
                $data=$this->get_post_cliente($codigo);
                $data['Codigo']=$this->input->post('codigo');
            }
            $data['Titulo']="Edición de  cliente";
            $data['Controlador']=base_url()."index.php/controlador_clientes/editar_cliente/".$id_cliente."/".$codigo."/FALSE";
            $data['Boton']=" <button class='btn-primary  btn-lg' type='submit'><span class='glyphicon glyphicon-edit'></span> Editar</button>";        
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('clientes/agregar',$data);
            }else{
                $this->modelo_clientes->editar_cliente($id_cliente,array(
                    'Codigo'=>$data['Codigo'],'Nombre'=>$data['Nombre'], 'Telefono'=>$data['Telefono'],
                    'Direccion'=>$data['Direccion'],'Correo'=>$data['Correo']));
                redirect('controlador_clientes/index/'.$codigo);   
            }
        }else{
            redirect('controlador_clientes/index/'.$codigo);
        }
        
    }
    
    public function buscar_cliente(){
          $valor=$this->input->post('busqueda');
          $data=$this->get_datos_sesion($this->input->post("codigo_sesion"));
          if($valor==""){
              $data['clientes']=$this->modelo_clientes->get_todos_los_clientes_activos();
          }else{
             $data['clientes']=$this->modelo_clientes->buscar_cliente($valor);
          }

          $this->load->view('clientes/index',$data); 
                  
    }
    
    public function eliminar_cliente($id='',$codigo){
       
        $this->modelo_clientes->eliminar_cliente($id);
        redirect('controlador_clientes/index/'.$codigo);
            
     }
     public function buscar_cliente_por_nombre(){
           $valor=$this->input->post('busqueda');
         $clientes=$this->modelo_clientes->buscar_cliente_por_nombre($valor);
         echo "<br><table id='tabla_cliente' class='table table-condensed'>
            <thead>
                           <tr class='active'>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Acción</th>
                            </tr>
           </thead>";
         if($clientes!=false){
             $i=1;
              echo "<tbody>";
             foreach ($clientes->result() as $cliente){
                  echo "<tr>" .
                                    "<td>" . $cliente->Codigo . "</td>" .
                                    "<td>" . $cliente->Nombre . "</td>" .
                                    "<td >" . $cliente->Correo . "</td>" .
                                   "<td><a class=' btn btn-success' href='javascript:seleccionar_cliente(".$i.");'>
                                                     <span class='glyphicon glyphicon-plus-sign'> </span> 
                                                </a></td>".
                          "</tr>";
                  $i++;
             }
              echo "</tbody>";
         }
         echo "</table>";
     }
}