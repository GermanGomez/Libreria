<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class controlador_inventario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('modelo_inventario');
    }

    public function index() {
        $data['inventarios'] = $this->modelo_inventario->get_todos_los_inventarios_activos();

        $this->load->view('inventario/index', $data);
    }

    public function agregar_inventario() {
//activar_validaciones();
//        $this->load->view('inventario/agregar');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('codigo', 'código', 'required|is_natura|max_length[10]|min_length[1]');
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('editorial', 'editorial', 'required');
        $this->form_validation->set_rules('autor', 'autor', 'required');
        $this->form_validation->set_rules('edicion', 'edicion', 'required');
        $this->form_validation->set_rules('anio', 'anio', 'required');
        $this->form_validation->set_rules('pais', 'pais', 'required');
        $this->form_validation->set_rules('costo', 'costo', 'required');
        $this->form_validation->set_rules('precio', 'precio', 'required');
        $this->form_validation->set_rules('existencias', 'existencias', 'required');


        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $data['Titulo'] = "Registro de  inventarios";
        $data['Controlador'] = base_url() . "index.php/controlador_inventario/agregar_inventario";
        $data['Codigo'] = $this->input->post('codigo');
        $data['Nombre'] = $this->input->post('nombre');
        $data['Editorial'] = $this->input->post('editorial');
        $data['Autor'] = $this->input->post('autor');
        $data['Edicion'] = $this->input->post('edicion');
        $data['Anio'] = $this->input->post('anio');
        $data['Pais'] = $this->input->post('pais');
        $data['Costo'] = $this->input->post('costo');
        $data['Precio_Venta'] = $this->input->post('precio');
        $data['Existencias'] = $this->input->post('existencias');
        $data['Boton'] = " <button class='btn-success  btn-lg' type='submit'><span class='glyphicon glyphicon-floppy-disk'></span> Agregar</button>";

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('inventario/agregar', $data);
        } else {
            $this->modelo_inventario->insert_inventario(array(
                'Codigo' => $data['Codigo'],
                'Nombre' => $data['Nombre'],
                'Editorial' => $data['Editorial'],
                'Autor' => $data['Autor'],
                'Edicion' => $data['Edicion'],
                'Anio' => $data['Anio'],
                'Pais' => $data['Pais'],
                'Costo' => $data['Costo'],
                'Precio_Venta' => $data['Precio_Venta'],
                'Existencias' => $data['Existencias']));
            redirect('controlador_inventario');
        }
    }

    public function editar_inventario($id_inventario = '', $bandera = TRUE) {
        if ($id_inventario != "") {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('codigo', 'código', 'required|is_natura|max_length[10]|min_length[1]');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('editorial', 'editorial', 'required');
            $this->form_validation->set_rules('autor', 'autor', 'required');
            $this->form_validation->set_rules('edicion', 'edicion', 'required');
            $this->form_validation->set_rules('anio', 'anio', 'required');
            $this->form_validation->set_rules('pais', 'pais', 'required');
            $this->form_validation->set_rules('costo', 'costo', 'required');
            $this->form_validation->set_rules('precio', 'precio', 'required');
            $this->form_validation->set_rules('existencias', 'existencias', 'required');

            $this->form_validation->set_message('required', 'El campo %s es obligatorio');
            $data['Titulo'] = "Edicion de  inventario";
            $data['Controlador'] = base_url() . "index.php/controlador_inventario/editar_inventario/" . $id_inventario . "/FALSE";
            if ($bandera === TRUE) {
                $consulta = $this->modelo_inventario->get_inventario_por_id($id_inventario);
                if ($consulta) {
                    foreach ($consulta->result() as $inventario) {
                        $data['Codigo'] = $inventario->Codigo;
                        $data['Nombre'] = $inventario->Nombre;
                        $data['Editorial'] = $inventario->Editorial;
                        $data['Autor'] = $inventario->Autor;
                        $data['Edicion'] = $inventario->Edicion;
                        $data['Anio'] = $inventario->Anio;
                        $data['Pais'] = $inventario->Pais;
                        $data['Costo'] = $inventario->Costo;
                        $data['Precio_Venta'] = $inventario->Precio_Venta;
                        $data['Existencias'] = $inventario->Existencias;
                    }
                }
            } else {
                $data['Codigo'] = $this->input->post('codigo');
                $data['Nombre'] = $this->input->post('nombre');
                $data['Editorial'] = $this->input->post('editorial');
                $data['Autor'] = $this->input->post('autor');
                $data['Edicion'] = $this->input->post('edicion');
                $data['Anio'] = $this->input->post('anio');
                $data['Pais'] = $this->input->post('pais');
                $data['Costo'] = $this->input->post('costo');
                $data['Precio_Venta'] = $this->input->post('precio');
                $data['Existencias'] = $this->input->post('existencias');
            }
            $data['Boton'] = " <button class='btn-primary  btn-lg' type='submit'><span class='glyphicon glyphicon-edit'></span> Editar</button>";
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('inventario/agregar', $data);
            } else {
                $this->modelo_inventario->editar_inventario($id_inventario, array(
                    'Codigo' => $data['Codigo'], 'Nombre' => $data['Nombre'], 'Editorial' => $data['Editorial'],
                    'Autor' => $data['Autor'], 'Edicion' => $data['Edicion'], 'Anio' => $data['Anio'],
                    'Pais' => $data['Pais'], 'Costo' => $data['Costo'], 'Precio_Venta' => $data['Precio_Venta'], 'Existencias' => $data['Existencias']));
                redirect('controlador_inventario');
            }
        } else {
            redirect('controlador_inventario');
        }
    }

    public function buscar_inventario() {
        $valor = $this->input->post('busqueda');
        if ($valor == "") {
            $data['inventarios'] = $this->modelo_inventario->get_todos_los_inventarios_activos();
        } else {
            $data['inventarios'] = $this->modelo_inventario->buscar_inventario($valor);
        }

        $this->load->view('inventario/index', $data);
    }
    public function buscar_libro(){
        $valor = $this->input->post('busqueda');
        $libros=$this->modelo_inventario->buscar_libro($valor);
        echo "<br><table class='table table-condensed'>
            <thead>
                           <tr class='active'>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Precio Venta</th>
                                <th>Existencias</th>
                                <th>Cantidad</th>
                            </tr>
           </thead>";
        if($libros != false){
                echo "<tbody>";
                foreach ($libros->result() as $libro){
                     echo "<tr>" .
                                    "<td>" . $libro->Codigo . "</td>" .
                                    "<td>" . $libro->Nombre . "</td>" .
                                    "<td>" . $libro->Precio_Venta . "</td>" .
                                    "<td>" . $libro->Existencias . "</td>".
                                    "<td><input list=browsers size=2 type=number min=0 max=".$libro->Existencias.">
                                    <datalist id=browsers size=2>";
                                     for($i = 1; $i <= $libro->Existencias; $i++){
                                         echo "<option>".$i;
                                     }
                    echo "</datalist><a class=' btn btn-success' href='#'>
                                                     <span class='glyphicon glyphicon-plus-sign'> </span> 
                                                </a></td></tr>";
                    
                }
                echo "</tbody>";
        }
        echo "</table>";
        
    }
    
    public function buscar_libro_por_nombre(){
        $nombre = $this->input->post('busqueda');
        $libros=$this->modelo_inventario->buscar_libro($nombre);
        echo "<br><table id='tabla_libro' class='table table-condensed'>
            <thead>
                           <tr class='active'>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th  style='display:none'>Precio Venta</th>
                                <th  style='display:none'>Existencias</th>
                                <th  style='display:none'>Cantidad</th>
                                <th>Acción</th>
                            </tr>
           </thead>";
        if($libros != false){
                echo "<tbody>";
                foreach ($libros->result() as $libro){
                     echo "<tr>" .
                                    "<td>" . $libro->Codigo . "</td>" .
                                    "<td>" . $libro->Nombre . "</td>" .
                                    "<td  style='display:none'>" . $libro->Precio_Venta . "</td>" .
                                    "<td  style='display:none'>" . $libro->Existencias . "</td>".
                                    "<td  style='display:none'><input list=browsers size=2 type=number min=0 max=".$libro->Existencias.">
                                    <datalist id=browsers size=2>";
                                     for($i = 1; $i <= $libro->Existencias; $i++){
                                         echo "<option>".$i;
                                     }
                    echo "</datalist></td>"
                                     . "<td><a class=' btn btn-success' href='javascript:agregar_libro(". $libro->Codigo.")'>
                                                     <span class='glyphicon glyphicon-plus-sign'> </span> 
                                                </a></td></tr>";
                
                    
                }
                echo "</tbody>";
                
        }
                echo "</table>";
        
    }
    public function eliminar_inventario($id = '') {

        $this->modelo_inventario->eliminar_inventario($id);
        redirect('controlador_inventario');
    }

}
