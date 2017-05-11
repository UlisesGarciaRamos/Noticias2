<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('crud_usuarios');
    }

    public function index(){
        $this->vista_login();
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

    //Funcion para agregar usuario, se comprueba si es una peticion ajax para acceso a datos
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
            if( $op == 0){     //si la op retorna 0 ,usuario y contraseñas inexistentes, no se puede logear
                $this->respuesta_metodo(false);
            }else if( $op == 1){  // op =1 el usuario logueado es un cliente o usuario
                $this->sesion_usuario($usuario);
                $respuesta = array("respuesta" => "usuario");
                echo json_encode($respuesta);
            }else if( $op == 2){ //op = 2 el usuario logueado es el administrador del sistema
                $this->sesion_usuario($usuario);
                $respuesta = array("respuesta" => "admin");
                echo json_encode($respuesta);
            }else if( $op == 3){  // si op retorna 3 el usuario esta bloqueado por exceder limite de intentos
                $respuesta = array("respuesta" => "block");
                echo json_encode($respuesta);
            }else if( $op == 4) {  //  el usuario existe pero la contraseña es incorrecta
                $this->respuesta_metodo(false);
            }
        }
    }

    public function sesion_usuario($usuario){
        $usuario = $this->crud_usuarios->obtener_usuario($usuario);
        if($usuario){
            $usuario_datos = array(
                'id_usuario' => $usuario->idUsuario,
                'nombre' => $usuario->nombre,
                'apellidos' => $usuario->apellidos,
                'rol' => $usuario->rol
            );
            $this->session->set_userdata($usuario_datos);
        }else{
        }
    }

    public function vista_login(){
        $this->load->view('usuarios/login_view');
    }

    public function cerrar_sesion(){
        $this->session->sess_destroy();
        $this->vista_login();
    }

    public function vista_admin(){
        if($this->session->userdata('rol') == "admin"){
            $dato['vista'] =  $this->load->view('usuarios/principal_admin_view',NULL,TRUE);
            $this->load->view('usuarios/admin_view',$dato);
        }else{
            $this->load->view('usuarios/restringido_view');
        }
    }

    public function vista_usuario(){
        if($this->session->userdata('rol') == "usuario"){
            $this->load->view('usuarios/user_view');
        }else{
            $this->load->view('usuarios/restringido_view');
        }
    }


    public function eliminar_usuario(){
        if($this->input->is_ajax_request()){
            $id_usuario = $this->input->post('id_usuario');
            $this->crud_usuarios->eliminar_usuario($id_usuario);
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

    public function cont_principal_admin(){
        $dato['vista'] =  $this->load->view('usuarios/principal_admin_view',NULL,TRUE);
        $this->load->view('usuarios/admin_view',$dato);
    }
    public function tabla_usuario_admin(){
        $usuario['usuarios'] = $this->crud_usuarios->obtener_usuarios($this->session->userdata('id_usuario'));
        $dato['vista'] =  $this->load->view('usuarios/tabla_usuario_view',$usuario,TRUE);
        $this->load->view('usuarios/admin_view',$dato);
    }


} //fin del controlador usuario

?>