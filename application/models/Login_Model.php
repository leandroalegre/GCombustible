<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

	public function login($username, $password){
        $resultado = $this->db->query("SELECT * FROM usuarios as u WHERE u.username = '$username' and u.password = '$password'");
        if($resultado){
            return $resultado->row();
        }
        else{
            return false;
        }
    }

    public function getString($id_usuario){
        $resultado = $this->db->query("SELECT string from usuarios where id='$id_usuario'");
        return $resultado->row("string");
    }

    public function updateLogin($data, $id_usuario){
        $this->db->where('id', $id_usuario);
        $this->db->update('usuarios', $data);
    }


}