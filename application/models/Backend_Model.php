<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_Model extends CI_Model {

	public function getID($link){

		$this->db->like("link",$link);
		$resultado = $this->db->get("menus");
		return $resultado->row();

	}

	public function getPermisos($menu,$rol){
		$this->db->where("menu_id",$menu);
		$this->db->where("rol_id",$rol);
		$resultado = $this->db->get("permisos");
		if ($resultado->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
		// return $resultado->row();
	}

	public function rowCount($tabla){

		if($tabla != "ventas"){
			$this->db->where("estado","1");
		}

		$resultado = $this->db->get($tabla);
		return $resultado->num_rows();
	}
}