<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controlador_proveedores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('modelo_proveedores');
    }

    public function index() {
        $data['proveedores'] = $this->modelo_proveedores->get_todos_los_proveedores_activos();

        $this->load->view('proveedores/index', $data);
    }

    public function agregar_proveedor() {
//activar_validaciones();
//        $this->load->view('proveedores/agregar');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('codigo', 'código', 'required|is_natura|max_length[10]|min_length[1]');
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('telefono', 'teléfono', 'required|is_natural|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('correo', 'correo', 'required|valid_email');
        $this->form_validation->set_rules('agente', 'agente', 'required');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $data['Titulo'] = "Registro de  proveedores";
        $data['Controlador'] = base_url() . "index.php/controlador_proveedores/agregar_proveedor";
        $data['Codigo'] = $this->input->post('codigo');
        $data['Nombre_Empresa'] = $this->input->post('nombre');
        $data['Telefono'] = $this->input->post('telefono');
        $data['Correo'] = $this->input->post('correo');
        $data['Agente_Ventas'] = $this->input->post('agente');
        $data['Boton'] = " <button class='btn-success  btn-lg' type='submit'><span class='glyphicon glyphicon-floppy-disk'></span> Agregar</button>";

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('proveedores/agregar', $data);
        } else {
            $this->modelo_proveedores->insert_proveedor(array(
                'Codigo' => $data['Codigo'],
                'Nombre_Empresa' => $data['Nombre_Empresa'], 'Telefono' => $data['Telefono'], 'Correo' => $data['Correo'], 'Agente_Ventas' => $data['Agente_Ventas']));
            redirect('controlador_proveedores');
        }
    }

    public function editar_proveedor($id_proveedor = '', $bandera = TRUE) {
        if ($id_proveedor != "") {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('codigo', 'código', 'required|is_natura|max_length[10]|min_length[1]');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('telefono', 'teléfono', 'required|is_natural|max_length[10]|min_length[1]');
            $this->form_validation->set_rules('correo', 'correo', 'required');
            $this->form_validation->set_rules('agente', 'agente', 'required');

            $this->form_validation->set_message('required', 'El campo %s es obligatorio');
            $data['Titulo'] = "Edición de  proveedor";
            $data['Controlador'] = base_url() . "index.php/controlador_proveedores/editar_proveedor/" . $id_proveedor . "/FALSE";
            if ($bandera === TRUE) {
                $consulta = $this->modelo_proveedores->get_proveedor_por_id($id_proveedor);
                if ($consulta) {
                    foreach ($consulta->result() as $proveedor) {
                        $data['Codigo'] = $proveedor->Codigo;
                        $data['Nombre_Empresa'] = $proveedor->Nombre_Empresa;
                        $data['Telefono'] = $proveedor->Telefono;
                        $data['Correo'] = $proveedor->Correo;
                        $data['Agente_Ventas'] = $proveedor->Agente_Ventas;
                    }
                }
            } else {
                $data['Codigo'] = $this->input->post('codigo');
                $data['Nombre_Empresa'] = $this->input->post('nombre');
                $data['Telefono'] = $this->input->post('telefono');
                $data['Correo'] = $this->input->post('correo');
                $data['Agente_Ventas'] = $this->input->post('agente');
            }
            $data['Boton'] = " <button class='btn-primary  btn-lg' type='submit'><span class='glyphicon glyphicon-edit'></span> Editar</button>";
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('proveedores/agregar', $data);
            } else {
                $this->modelo_proveedores->editar_proveedor($id_proveedor, array(
                    'Codigo' => $data['Codigo'], 'Nombre_Empresa' => $data['Nombre_Empresa'], 'Telefono' => $data['Telefono'],
                    'Correo' => $data['Correo'], 'Agente_Ventas' => $data['Agente_Ventas']));
                redirect('controlador_proveedores');
            }
        } else {
            redirect('controlador_proveedores');
        }
    }

    public function buscar_proveedor() {
        $valor = $this->input->post('busqueda');
        if ($valor == "") {
            $data['proveedores'] = $this->modelo_proveedores->get_todos_los_proveedores_activos();
        } else {
            $data['proveedores'] = $this->modelo_proveedores->buscar_proveedor($valor);
        }

        $this->load->view('proveedores/index', $data);
    }

    public function eliminar_proveedor($id = '') {

        $this->modelo_proveedores->eliminar_proveedor($id);
        redirect('controlador_proveedores');
    }

}
