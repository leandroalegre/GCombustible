<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Login_Model");
		$id_usuario=$this->session->userdata("id");
		$string_user=$this->session->userdata("string");
		$string = $this->Login_Model->getString($id_usuario);
		
		if($string_user==null){
			redirect(base_url().'Login/logout');
		}else if($string!=$string_user){
		redirect(base_url().'Login/logout');
	}
		$this->load->model("Ticket_Model");
	}

	public function index(){
		$this->permisos = $this->backend_lib->control();
		$this->load->view('layouts/header');
		$this->load->view('vistas/principal');
		$this->load->view('layouts/footer');
	}
}
