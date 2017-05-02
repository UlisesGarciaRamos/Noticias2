<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('crud_usuarios');
    }

    public function index(){
        $this->load->view('usuarios/login_view');
        //$this->load->view('usuarios/alta_usuario_view');
    }

    public function form_usuario(){
        $this->load->view('usuarios/alta_usuario_view');
    }

    public function respuesta_metodo($estado){
        if($estado){
            $respuesta = array('respuesta' => 'ok');
            echo json_encode($respuesta);
        }else{
            $respuesta = array('respuesta' => 'error');
            echo json_encode($respuesta);
        }
    }

    //Funcion para agregar usuario, se comprueba si es una peticion ajax de peticion de datos
    //con la sentencia is_ajax_request
    public function agregar_usuario(){
        if($this->input->is_ajax_request()){
            $usuario = array(
                'nombre' => $this->input->post('c_nombre'),
                'apellidos' => $this->input->post('c_apellidos'),
                'usuario' => $this->input->post('c_usuario'),
                'email' => $this->input->post('c_email'),
                'password' => $this->input->post('c_password')
            );

            if($this->crud_usuarios->buscar_usuario($usuario['usuario'],$usuario['email'])){
                 $respuesta = array("respuesta" => "existe");
                 echo json_encode($respuesta);
            }else{
                 if($this->crud_usuarios->registrar_usuario($usuario)){
                        $respuesta = array("respuesta" => "ok");
                        echo json_encode($respuesta);
                  }else{
                        $respuesta = array("respuesta" => "error");
                        echo json_encode($respuesta);
                  }
            }
        } 
    }


    public function login_usuario(){
        if($this->input->is_ajax_request()){
            $usuario = array(
                'usuario' => $this->input->post('c_usuario'),
                'password' => $this->input->post('c_password')
            );
            $op = $this->crud_usuarios->sesion_usuario($usuario);
            if( $op == 0){     //si la op retorna 0 ,usuario y contraseñas incorrectos, no se puede logear
                $this->respuesta_metodo(false);
            }else if( $op == 1){  // 
                $respuesta = array("respuesta" => "usuario");
                echo json_encode($respuesta);
            }else if($op == 2){
                $respuesta = array("respuesta" => "admin");
                echo json_encode($respuesta);
            }else if( $op == 3){  // si op retorna 3 el usuario esta bloqueado por exceder limite de intentos
                $respuesta = array("respuesta" => "block");
                echo json_encode($respuesta);
            }else if( $op == 4) {  // 
                $this->respuesta_metodo(false);
            }
        }
    }

    public function vista_admin(){
        $this->load->view('usuarios/admin_view');
    }

    public function vista_usuario(){
        $this->load->view('usuarios/user_view');
    }

    public function obtener_usuario(){
        $this->crud_usuarios->obtener_usuarios;
    }

    public function eliminar_usuario(){
        if($this->input->is_ajax_request()){
            $usuario = $this->input->post('id_usuario');
            if($this->crud_usuarios->borrar_usuario($usuario)){
                respuesta_metodo(true);
            }else{
                respuesta_metodo(false);
            }
        }
    }

    public function editar_usuario(){
        if($this->input->is_ajax_request()){
            $usuario = array(
                'id_usuario' => $this->input->post('c_idusuario'),
                'nombre' => $this->input->post('c_nombre'),
                'apellidos' => $this->input->post('c_apellidos'),
                'usuario' => $this->input->post('c_usuario'),
                'password' => $this->input->post('c_password')
            );
            if($this->crud_usuarios->actualizar_usuario($usuario)){
                respuesta_metodo(true);
            }else{
                respuesta_metodo(false);
            }
        }
    }


} //fin del controlador usuario

?>