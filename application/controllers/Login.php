<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model("Login_Model");
		$this->load->model("Personas_Model");
	}


	public function index()
	{
		if ($this->session->userdata("login")) {
			$rol = $this->session->userdata("rol");
			switch ($rol) {
				case '4':
					redirect(base_url() . "Ticket/rendir");
					break;
				case '2':
					//redirect(base_url()."Ticket/listEmitidos");
					redirect(base_url() . "Reportes/dashboard");
					break;
				case '1':
					//redirect(base_url()."Ticket/listEmitidos");
					redirect(base_url() . "Reportes/dashboard");
					break;
				case '3':
					redirect(base_url() . "Reportes/dashboard");
					break;
				case '4':
					redirect(base_url() . "Ticket/rendir");
					break;
				case '5':
					//redirect(base_url()."Ticket/listSolicitudesForSecretario");
					redirect(base_url() . "Reportes/dashboard");
					break;
				case '6':
					redirect(base_url() . "Ticket/listSolicitudesContaduria");
					break;
				case '7':
					redirect(base_url() . "Ticket/cargaCombustible");
					break;
				case '8':
					redirect(base_url() . "Reportes/dashboard");
					break;
				case '9':
					redirect(base_url() . "Vehiculos");
					break;
				case '10':
					redirect(base_url() . "Reportes/dashboard");
					break;
			}
		} else {
			$this->load->view("vistas/login/login");
		}
	}

	public function login()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$res = $this->Login_Model->login($username, sha1($password));




		if ($res == false) {
			echo "false";
		} else {
			$auditoria = array(
				'id_usuario' => $res->id,
				'motivo' => 'Log in',
				'fecha_hora' => date("Y-m-d H:i:s")
			);
			$this->Personas_Model->insertAuditoria($auditoria);
			$id_persona = $res->id_per;
			$rol = $res->rol_id;
			$id_secretaria = $this->Personas_Model->getIdSecretariaByIdPersona($id_persona);
			$id_direccion = $this->Personas_Model->getIdDireccionByIdPersona($id_persona);
			$nombre_apellido = $this->Personas_Model->getNombreById($id_persona);
			$nombre_secretaria = $this->Personas_Model->getNombreSecretaria($id_secretaria);
			$nombre_direccion = $this->Personas_Model->getNombreDir($id_direccion);
			$string = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

			if ($rol == 9) {
				$dependencia = $this->Personas_Model->getDependenciabyidpersona($id_persona);
				$data = array(
					'id' => $res->id,
					'id_persona' => $id_persona,
					'username' => $res->username,
					'nombre_apellido' => $nombre_apellido,
					'rol' => $rol,
					'password' => $res->password,
					'id_secretaria' => $id_secretaria,
					'id_direccion' => $id_direccion,
					'nombre_secretaria' => $nombre_secretaria,
					'nombre_direccion' => $nombre_direccion,
					'login' => TRUE,
					'string' => $string,
					'dependencia' => $dependencia->dependencia,
					'id_dependencia' => $dependencia->id_dependencia
				);
			} else {
				$data = array(
					'id' => $res->id,
					'id_persona' => $id_persona,
					'username' => $res->username,
					'nombre_apellido' => $nombre_apellido,
					'rol' => $rol,
					'password' => $res->password,
					'id_secretaria' => $id_secretaria,
					'id_direccion' => $id_direccion,
					'nombre_secretaria' => $nombre_secretaria,
					'nombre_direccion' => $nombre_direccion,
					'login' => TRUE,
					'string' => $string,
				);
			}


			$data2 = array(
				'string' => $string
			);

			$this->Login_Model->updateLogin($data2, $res->id);
			$this->session->set_userdata($data);
			return true;
		}
	}

	public function logout()
	{
		$id = $this->session->userdata('id');
		if (isset($id)) {
			$auditoria = array(
				'id_usuario' => $id,
				'motivo' => 'Log out',
				'fecha_hora' => date("Y-m-d H:i:s")
			);
			$this->Personas_Model->insertAuditoria($auditoria);
			$this->session->sess_destroy();
			redirect(base_url());
		} else {
			redirect(base_url());
		}
	}

	public function vista($r)
	{

		$busqueda = array(
			'busca' => $r
		);
		$this->load->view("vistas/login/nwpass", $busqueda);
	}
	public function newpass($username, $password)
	{
		//$username = "palacios";
		//$data = array('username' => "palacios");
		$res = $this->Login_Model->login($username, $password);
		if ($res == false) {
			echo "false";
		} else {
			$busqueda =  $this->Personas_Model->getUsername($username);
			if ($busqueda == null) {
				echo "false";
			} else {
				echo $busqueda;
				// $this->load->view("vistas/login/nwpass", $busqueda);
				//redirect(base_url());
			}
		}
	}

	public function generar_contrasena($username, $password)
	{
		$data = array(
			"password" => sha1($password)
		);

		$this->Personas_Model->generar_contrasena($data, $username);
		echo "true";
	}
}
