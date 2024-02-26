<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tarjeta_Model extends CI_Model {

	public function insertPrueba($a){
		$this->db->insert("prueba_tarjeta", $a);
		
	}

	public function insertPruebaAbm($a){
		$this->db->insert("prueba_tarjetaabm", $a);
		
	}

	public function getLastID(){
		$r = $this->db->query("SELECT id as id_tarjeta, id_row from prueba_tarjeta where id_row in (SELECT MAX(id_row) from prueba_tarjeta where estado = '0')");
		return $r->row();
	}

	public function getLastIDAbm(){
		$r = $this->db->query("SELECT id as id_tarjeta, id_row from prueba_tarjetaabm where id_row in (SELECT MAX(id_row) from prueba_tarjetaabm where estado = '0')");
		return $r->row();
	}

	public function ifExiste($id){
		$r = $this->db->query("SELECT * FROM vehiculos where id_tarjeta = '$id' and estado = '1'");
		if ($r->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function ifExisteAbm($id){
		$r = $this->db->query("SELECT * FROM vehiculos where id_tarjeta = '$id' and estado = '1'");
		if ($r->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function setearId($id){
		$this->db->query("UPDATE prueba_tarjeta SET estado = '1' WHERE prueba_tarjeta.id_row <= '$id'");
	}

	public function setearIdAbm($id){
		$this->db->query("UPDATE prueba_tarjetaabm SET estado = '1' WHERE prueba_tarjetaabm.id_row <= '$id'");
	}

	public function setearTodas(){
		$this->db->query("UPDATE prueba_tarjeta SET estado = '1'");
	}

	public function setearTodasAbm(){
		$this->db->query("UPDATE prueba_tarjetaabm SET estado = '1'");
	}



}