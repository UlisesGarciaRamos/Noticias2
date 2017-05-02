<?php

Class Crud_usuarios extends CI_MODEL {

    public $llave_aes;
    public function __construct(){
        parent::__construct();
        $this->llave_aes = $this->config->item('aes_key');
    }

    public function registrar_usuario($usuario){
        $this->db->set('nombre',$usuario['nombre']);
        $this->db->set('apellidos',$usuario['apellidos']);
        $this->db->set('usuario',$usuario['usuario']);
        $this->db->set('email',$usuario['email']);
        $password = $usuario['password'];
        $this->db->set('password',"AES_ENCRYPT('{$password}','$this->llave_aes')",FALSE);
        $this->db->set('estado','0');
        $this->db->set('rol','cliente');
        if($this->db->insert('usuario')){
            return true;
        }else{
            return false;
        }
    }

    public function buscar_usuario($usuario , $email){
        $query = $this->db->query("select * from usuario where usuario = '$usuario' and email = '$email' ");
    
        if($query->num_rows() > 0){
            return true;    
        }else{
            return false;
        }
    }

    public function sesion_usuario($usuario){
        $password = $usuario['password'];
        $user = $usuario['usuario'];
        $query = $this->db->select('*')->from('usuario')->where("usuario = '$user' ")->get();

        if ($query->num_rows() > 0) {
            $id_usuario = $query->row()->idUsuario;
            $estado = $query->row()->estado;

            $query = $this->db->select('*')->from('usuario')
            ->where("password = AES_ENCRYPT('$password','$this->llave_aes') and usuario = '$user' ")->get();

            if(($query->num_rows() > 0)  && ($query->row()->estado < 3) && ($query->row()->rol == "usuario")){
                return 1;
            }else if(($query->num_rows() > 0)  && ($query->row()->estado < 3) && ($query->row()->rol == "admin")){
                return 2;
            }else if(($query->num_rows() > 0)  && ($query->row()->estado > 2)){
                return 3;
            }else{
                $this->db->set('estado',$estado + 1)->where('idUsuario',$id_usuario);
                $this->db->update('usuario');
                return 4;
            }    
            return 1;        
        }else{
            return 0;
        }
    }

    public function obtener_usuario($id_usuario){

    }

    public function actualizar_usuario($id_usuario){

    }

    public function eliminar_usuario($usuarios){

    }

    public function obtener_usuarios(){

    }



}

?>