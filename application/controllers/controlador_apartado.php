<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_apartado extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');    
        $this->load->library('session');
        $this->load->model('modelo_apartado');
        $this->load->model('modelo_empleados');
        $this->load->model('modelo_clientes');
    }
    
    public function index($codigo){
         $data=$this->get_datos_sesion($codigo);
         $data["apartados"]=$this->modelo_apartado->get_todos_los_apartados_activos();
         $this->load->view('apartado/index',$data);
    }
   private function get_datos_sesion($codigo){
        $empleado=$this->modelo_empleados->get_empleado_por_codigo($codigo);
        $data["Usuario"]=$empleado->Usuario;
        $data["Nombre"]=$empleado->Nombre;
        $data["Codigo_Empleado"]=$empleado->Codigo;
        return $data;
    }
    public function agregar_apartado($codigo){
         $data=$this->get_datos_sesion($codigo);
         $data['Folio']=$this->modelo_apartado->get_folio();
         $this->load->view('apartado/apartado',$data);
    }
    
    public function registrar_apartado(){
        $data['Folio']=$this->input->post('folio');
        $data['Codigo_Empleado']=$this->input->post('codigo_empleado');
        $data['Codigo_Cliente']=$this->input->post('codigo_cliente');
        $data['Tabla_Apartado']=$this->input->post('tabla_apartado');
        $id=$this->modelo_apartado->insert_apartado_encabezado(array(
            "Folio"=>$data["Folio"],
            "Codigo_Empleado"=>$data["Codigo_Empleado"],
            "Codigo_Cliente"=>$data["Codigo_Cliente"]));
        
        foreach ($data["Tabla_Apartado"] as $fila ){
            $this->modelo_apartado->insert_apartado_detalle(array(
                "Folio"=>$data["Folio"],
                "Codigo_Libro"=>$fila["codigo_libro"],
                "Nombre_Libro"=>$fila["nombre_libro"],
                "Cantidad"=>$fila["cantidad_apartado"]
            ));
        }
    }

    private function get_apartado_encabezado($folio="",$codigo){
        $data=$this->get_datos_sesion($codigo);
        $data["Encabezado"]=$this->modelo_apartado->get_apartado_encabezado($folio);
        return $data;
    }
    private function get_apartado_detalle($folio){
        return $this->modelo_apartado->get_apartado_detalle($folio);
    }
    
     public function buscar_apartados_detalle_por_cliente(){
         $detalle=$this->modelo_apartado->buscar_apartados_detalle_por_cliente($this->input->post('busqueda'));
         echo "<br><h3>Libros Apartados</h3><table id='tabla_detalle' class='table table-condensed'>
            <thead>
                           <tr class='active'>
                                <th>Código Libro</th>
                                <th>Nombre Libro</th>
                                <th>Cantidad</th>
                                <th>Acción</th>
                            </tr>
           </thead>";
           if($detalle!=false){
             $i=1;
              echo "<tbody>";
             foreach ($detalle->result() as $libro){
                  echo "<tr>" .
                                    "<td>" . $libro->Codigo_Libro . "</td>" .
                                    "<td>" . $libro->Nombre_Libro . "</td>" .
                                    "<td >" . $libro->Cantidad . "</td>" .
                                   "<td><a class=' btn btn-success' id='btn_apartado_".$libro->Codigo_Libro."' href='javascript:seleccionar_libro(".$libro->Codigo_Libro.");'>
                                                     <span class='glyphicon glyphicon-plus-sign'> </span> 
                                                </a></td>".
                          "</tr>";
                  $i++;
             }
              echo "</tbody>";
         }
         echo "</table>";
     }
    public function detalle_apartado( $folio,$codigo){
        $data=$this->get_apartado_encabezado($folio,$codigo);
        $data["Detalle"]=$this->get_apartado_detalle($folio);
        $this->load->view('apartado/detalle_apartado',$data);
    }
    
    public function buscar_apartado(){
          $valor=$this->input->post('busqueda');
          $data=$this->get_datos_sesion($this->input->post('codigo_sesion'));
          if($valor==""){
              $data['apartados']=$this->modelo_apartado->get_todos_los_apartados_activos();
          }else{
             $data['apartados']=$this->modelo_apartado->buscar_apartado($valor);
          }
          $this->load->view('apartado/index',$data); 
                  
    }
    public function eliminar_apartado($id='',$codigo){
        $this->modelo_apartado->eliminar_apartado($id);
        redirect('controlador_apartado/index/'.$codigo);
            
     }
}