<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PantallaCarga extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$data = array(
			'id' => '8',
			'nombre'=> 'Pantalla Carga',
			'username' => 'pantallaplayero',
			'password' => 'ba24bebf99503dfb071e77f62fe23f8058f15d26',
			'rol' => '7',
			'login' => TRUE
		);
		$this->session->set_userdata($data);
		redirect(base_url()."Ticket/cargaCombustible/");
	}

}	
