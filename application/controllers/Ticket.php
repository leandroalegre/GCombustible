<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ticket extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("id") != 8) {
			$this->load->model("Reportes_Model");
			$this->load->model("Login_Model");
			$id_usuario = $this->session->userdata("id");
			$string_user = $this->session->userdata("string");
			$string = $this->Login_Model->getString($id_usuario);
			if ($string_user == null) {
				redirect(base_url() . 'Login/logout');
			} else if ($string != $string_user) {
				redirect(base_url() . 'Login/logout');
			}
		}

		$this->load->model("Ticket_Model");
		$this->load->model("Personas_Model");
	}

	public function index()
	{
		$this->permisos = $this->backend_lib->control();
		$rol = $this->session->userdata("rol");

		if ($rol == 2) {
			$id_sec = $this->session->userdata("id_secretaria");
			$ar = array('cantTickets' => $this->Ticket_Model->getCantTicketsSEC($id_sec),);
			$this->load->view('layouts/header');
			$this->load->view('vistas/ticket/emitir', $ar);
			$this->load->view('layouts/footer');
		} elseif ($rol == 3) {
			$id_dir = $this->session->userdata("id_direccion");
			$ar = array('cantTickets' => $this->Ticket_Model->getCantTickets($id_dir),);
			$this->load->view('layouts/header');
			$this->load->view('vistas/ticket/emitir', $ar);
			$this->load->view('layouts/footer');
		}
	}

	// public function sendmail()
	// {
	// 	//cargamos la libreria email de ci
	// 	$this->load->library("email");

	// 	//configuracion para gmail
	// 	$configGmail = array(
	// 		'protocol' => 'smtp',
	// 		'smtp_host' => 'mail.villacarlospaz.gov.ar',
	// 		'smtp_port' => 26,
	// 		'smtp_user' => 'ticketscarga@villacarlospaz.gov.ar',
	// 		'smtp_pass' => 'f1c5QpbDzkm1',
	// 		'mailtype' => 'html',
	// 		'charset' => 'utf-8',
	// 		'newline' => "\r\n"
	// 	);

	// 	// $configGmail = array(
	// 	// 	'protocol' => 'smtp',
	// 	// 	'smtp_host' => 'ssl://smtp.googlemail.com',
	// 	// 	'smtp_port' => 465,
	// 	// 	'smtp_user' => 'wilsonwilson1024@gmail.com',
	// 	// 	'smtp_pass' => 'dxkkivfnemhykgjr',
	// 	// 	'mailtype' => 'html',
	// 	// 	'charset' => 'utf-8',
	// 	// 	'newline' => "\r\n"
	// 	// );

	// 	//cargamos la configuración para enviar con gmail
	// 	$this->email->initialize($configGmail);

	// 	$this->email->from('ticketscarga@villacarlospaz.gov.ar');
	// 	$this->email->to("wilsonwilson1024@gmail.com");
	// 	$this->email->subject('Esto es una prueba');
	// 	$this->email->message('<h2>Correo con imagen</h2>
	// 		<hr><br>
	// 		Kurt Cobain
	// 		<br>
	// 		<img src="'.base_url().'public/images/logo-muni.jpg" height="248" width="700">
	// 		<h3>Click en la imagen y dale like a mi pagina :D</h3>'
	// 	);



	// 	if ($this->email->send()) {
	// 		echo "Enviado";
	// 	}else{
	// 		show_error($this->email->print_debugger());
	// 	}


	// }

	public function cargadoPorVehiculos()
	{

		$this->load->view('layouts/header');
		$this->load->view('vistas/ticket/cargadoPorVehiculos');
		$this->load->view('layouts/footer');
	}

	public function cargadoPorPersona()
	{
		if ($this->session->userdata("rol") != 1) {
			redirect(base_url() . 'Login/logout');
		}
		$this->load->view('layouts/header');
		$this->load->view('vistas/ticket/cargadoPorPersona');
		$this->load->view('layouts/footer');
	}

	public function buscarCargado()
	{
		$dominio = $this->input->post("dominio");
		$id_sec = $this->session->userdata("id_secretaria");


		$data = array(
			'movtickets' => $this->Ticket_Model->getMovimientosCargadoPorVehiculo($dominio, $id_sec),
			'vehiculo' => $this->Ticket_Model->BuscarTipo($dominio),
			'suma' => $this->Ticket_Model->buscarTotal($dominio, $id_sec)
		);

		if ($data['movtickets'] == FALSE) {
			$this->load->view('layouts/header');
			$this->load->view('vistas/ticket/cargadoPorVehiculos');
			$this->load->view('layouts/footer');
		} else {
			$this->load->view('layouts/header');
			$this->load->view('vistas/ticket/cargadoPorVehiculos', $data);
			$this->load->view('layouts/footer');
		}
	}

	public function buscarPersonaCargada()
	{
		$id_persona = $this->input->post("id_persona");
		if ($id_persona == null) {
			$this->load->view('layouts/header');
			$this->load->view('vistas/ticket/cargadoPorPersona');
			$this->load->view('layouts/footer');
		} else {
			$nombre = $this->Personas_Model->getNombreById($id_persona);
			$data = array(
				'movtickets' => $this->Ticket_Model->getMovimientosCargadoPorPersona($id_persona),
				'nombre' => $nombre,
				'suma' => $this->Ticket_Model->buscarTotalIdPer($id_persona)
			);

			if ($data['movtickets'] == FALSE) {
				$this->load->view('layouts/header');
				$this->load->view('vistas/ticket/cargadoPorPersona');
				$this->load->view('layouts/footer');
			} else {
				$this->load->view('layouts/header');
				$this->load->view('vistas/ticket/cargadoPorPersona', $data);
				$this->load->view('layouts/footer');
			}
		}
	}

	public function getMovimientosporTicket($nit)
	{
		$array = array(
			'mov' => $this->Ticket_Model->buscarMovimientosTickets($nit)
		);

		$this->load->view('vistas/ticket/modal-movimientos', $array);
	}

	public function ConsultarMontoVehiculos()
	{
		$id_vehiculo = $this->input->post("id_vehiculo");
		$importe_ticket = $this->input->post("importe");

		$mesactual = date("m");

		$flag_litros = $this->Ticket_Model->consultarFlag($id_vehiculo);

		if ($flag_litros == 1) {

			$litros_emitidos = $this->Ticket_Model->consultarMontoLitros($id_vehiculo, $mesactual);
			$maximo_mensual = $this->Ticket_Model->consultarMaximoLitros($id_vehiculo);

			if (isset($litros_emitidos)) {
				echo $litros_emitidos . "-" . $maximo_mensual;
			} else {
				$litros_emitidos = 0;
				echo $litros_emitidos . "-" . $maximo_mensual;
			}
		} else {


			$monto = $this->Ticket_Model->consultarMonto($id_vehiculo, $mesactual);
			$maximo_mensual = $this->Ticket_Model->consultarMaximo($id_vehiculo);

			if (isset($monto)) {
				echo $monto . "-" . $maximo_mensual;
			} else {
				$monto = 0;
				echo $monto . "-" . $maximo_mensual;
			}
		}
	}

	public function subirActualizacion()
	{



		$id_persona = $this->input->post("id_persona");
		$vencimiento_licencia = $this->input->post("vencimiento_licencia");
		$nuevo_vencimiento = $this->input->post("nuevo_vencimiento");
		$hoy = date("Y-m-d H:i:s");

		//print_r($_FILES);
		$this->load->library("upload");

		$archivo = $this->input->post("archivo");

		$config = array(
			"upload_path" => "./public/images",
			'allowed_types' => "jpg|png|jpeg",
			'maintain_ratio' => FALSE,
			'create_thumb' => TRUE
		);
		$variablefile = $_FILES;
		$info = array();


		$_FILES['archivo']['name'] = rand() . "_" . $variablefile['archivo']['name'];
		$_FILES['archivo']['type'] = $variablefile['archivo']['type'];
		$_FILES['archivo']['tmp_name'] = $variablefile['archivo']['tmp_name'];
		$_FILES['archivo']['error'] = $variablefile['archivo']['error'];
		$_FILES['archivo']['size'] = $variablefile['archivo']['size'];
		$this->upload->initialize($config);
		if ($this->upload->do_upload('archivo') == true) {
			$data = array("upload_data" => $this->upload->data());
			$actualizacion = array(
				'vencimiento_licencia' => $nuevo_vencimiento
			);

			$historico = array(
				'name' => $data['upload_data']['file_name'],
				'fecha_anterior' => $vencimiento_licencia,
				'fecha_nueva' => $nuevo_vencimiento,
				'id_usuario' => $this->session->userdata("id"),
				'fecha_movimiento' => $hoy,
				'id_persona' => $id_persona
			);
			$datos = array(
				"name" => $data['upload_data']['file_name'],
				"id_persona" => $id_persona
			);
			$this->Ticket_Model->guardarIMG($datos, $actualizacion, $id_persona, $historico);

			$uploadedImage = $this->upload->data();
			$archivo = $uploadedImage['file_name'];


			//////////////////////////////////////

			# establecer limite de tiempo máx ejecutandose
			//set_time_limit(200);
			## CONFIGURACION #############################

			$ancho_nuevo = 600;
			$alto_nuevo = 383;

			# directorio
			$path = "./public/images/";
			$path2 = "./public/images/licencias";

			## FIN CONFIGURACION ############################# 

			$directorio = dir($path);

			$ruta1 = $path . '/' . $archivo;
			$ruta2 = $path2 . '/' . $archivo;
			$ancho = $ancho_nuevo;
			$alto = $alto_nuevo;

			$datos = getimagesize($ruta1);

			$ancho_orig = $datos[0]; # Anchura de la imagen original 
			$alto_orig = $datos[1]; # Altura de la imagen original 
			$tipo = $datos[2];

			if ($tipo == 1) { # GIF 
				if (function_exists("imagecreatefromgif"))
					$img = imagecreatefromgif($ruta1);
				else
					echo "No function GIF";
			} else if ($tipo == 2) { # JPG 
				if (function_exists("imagecreatefromjpeg"))
					$img = imagecreatefromjpeg($ruta1);
				else
					echo "No function JPG";
			} else if ($tipo == 3) { # PNG 
				if (function_exists("imagecreatefrompng"))
					$img = imagecreatefrompng($ruta1);
				else
					echo "No function PNG";
			}

			$ancho_dest = 600;
			$alto_dest = 383;

			$img2 = @imagecreatetruecolor($ancho_dest, $alto_dest) or $img2 = imagecreate($ancho_dest, $alto_dest);
			@imagecopyresampled($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig) or imagecopyresized($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig);

			if ($tipo == 1) // GIF 
				if (function_exists("imagegif"))
					imagegif($img2, $ruta2);
				else
					echo "No GIF";
			if ($tipo == 2) // JPG 
				if (function_exists("imagejpeg"))
					imagejpeg($img2, $ruta2);
				else
					echo "No JPG";
			if ($tipo == 3) // PNG 
				if (function_exists("imagepng"))
					imagepng($img2, $ruta2);
				else
					echo "No PNG¡";


			unlink($ruta1);


			$directorio->close();


			//////////////////



			echo true;
		} else {
			echo false;
		}
	}

	public function store()
	{
		$fecha_emision = date("Y-m-d H:i:s");
		$numero_ticket = $this->Ticket_Model->getUltimoNumeroTicket();
		$id_persona_receptor = $this->input->post("id_persona");
		$id_vehiculo = $this->input->post("id_vehiculo");
		$importe = $this->input->post("importe");
		$cant_litros = $this->input->post("cant_litros");
		$tipo_comb = $this->input->post("tipo_comb");
		$id_usuario = $this->session->userdata("id");
		$id_direccion = $this->session->userdata("id_direccion");
		$id_secretaria = $this->session->userdata("id_secretaria");
		$rol = $this->session->userdata("rol");

		if (isset($tipo_comb)) {
		} else {
			$tipo_comb = "";
		}

		if (isset($cant_litros)) {
		} else {
			$cant_litros = 0;
		}
		$ticket = array(
			'nit' => $numero_ticket + 1,
			'id_per' => $id_persona_receptor,
			'id_ve' => $id_vehiculo,
			'importe' => $importe,
			'estado' => 'Emitido',
			'fecha_emitido' => $fecha_emision,
			'id_user' => $id_usuario,
			'litros_emitidos' => $cant_litros,
			'id_comb_cargado' => $tipo_comb
		);

		$movimiento = array(
			'nit' => $numero_ticket + 1,
			'tipo_movimiento' => 'Emision de ticket',
			'fecha_movimiento' => $fecha_emision,
			'id_usuario' => $id_usuario,
			'importe' => $importe,
			'id_per' => $id_persona_receptor,
			'id_ve' => $id_vehiculo

		);

		if ($this->Ticket_Model->insertNewTicket($ticket, $movimiento)) {

			//si es operador de direccion hace esto
			if ($rol == 3) {
				$cant_actual = $this->Ticket_Model->getCantTickets2($id_direccion);
				$a = array('saldo' => ($cant_actual - $importe),);
				$this->Ticket_Model->descontarCantTicketRestantes($id_direccion, $a);
				echo "true";

				//si es administrador de secretaria hace esto
			} elseif ($rol == 2) {
				$cant_actual = $this->Ticket_Model->getCantTickets2SEC($id_secretaria);
				$a = array('saldo' => ($cant_actual - $importe),);
				$this->Ticket_Model->descontarCantTicketRestantesSEC($id_secretaria, $a);
				echo "true";
			}
		} else {
			echo "false";
		}
	}

	public function buscarTicketsPorVehiculo()
	{
		$id_vehiculo = $this->input->post('id_vehiculo');

		$array = array(
			't' => $this->Ticket_Model->buscarTicketsPorVehiculo($id_vehiculo)
		);

		$this->load->view('vistas/ticket/modal-carga', $array);
	}

	public function confirmarCarga($id_ticket, $importe_cargado, $id_comb_cargado)
	{

		if ($id_comb_cargado != 0) {
			$precio_litro = $this->Ticket_Model->getPrecio($id_comb_cargado);
			$litroscargados = $importe_cargado / $precio_litro;
		}

		$fecha_cargado = date("Y-m-d H:i:s");
		$array = array(
			'importe_cargado' => $importe_cargado,
			'estado' => "Cargado",
			'fecha_cargado' => $fecha_cargado,
			'litros_emitidos' => $litroscargados
		);

		$id_usuario = $this->session->userdata("id");
		$datosticket = $this->Ticket_Model->getDatosTicket($id_ticket);

		$movimiento = array(
			'nit' => $datosticket->nit,
			'tipo_movimiento' => 'Carga de ticket',
			'fecha_movimiento' => $fecha_cargado,
			'id_usuario' => $id_usuario,
			'importe' => $datosticket->importe,
			'id_per' => $datosticket->id_per,
			'id_ve' => $datosticket->id_ve

		);
		$id_persona = $datosticket->id_per;
		$id_vehiculo = $datosticket->id_ve;
		$mail = $this->Ticket_Model->obtenerEmail($id_persona);
		$vehiculo = $this->Ticket_Model->obtenerVehiculo($id_vehiculo);

		if ($this->Ticket_Model->ticketCargado($id_ticket, $array, $movimiento)) {
			echo "true";



			//--------------------------------------------------Envio de email---------------------------------------------------

			$this->load->library("email");

			$mail_config['smtp_host'] = 'modernizacionvcp.gob.ar';
			$mail_config['smtp_port'] = '587';
			$mail_config['smtp_user'] = 'ticketscarga@modernizacionvcp.gob.ar';
			$mail_config['_smtp_auth'] = TRUE;
			$mail_config['smtp_pass'] = 'VZCJ}8Vc[9b{';
			$mail_config['smtp_crypto'] = 'tls';
			$mail_config['protocol'] = 'smtp';
			$mail_config['mailtype'] = 'html';
			$mail_config['send_multipart'] = FALSE;
			$mail_config['charset'] = 'utf-8';
			$mail_config['wordwrap'] = TRUE;
			$this->email->initialize($mail_config);

			$this->email->set_newline("\r\n");


			$this->email->from('ticketscarga@modernizacionvcp.gob.ar');
			$this->email->to($mail->mail);
			$this->email->subject('Notificacion de carga de combustible');
			$this->email->message(
				'<h2>Carga de combustible</h2>
				<hr>
				<br>
				Se realizo la carga de combustible con ticket Nº ' . $datosticket->nit . ' en el vehiculo: ' . $vehiculo->marca . ' ' . $vehiculo->modelo . ' con dominio ' . $vehiculo->dominio . ' a nombre de la persona ' . $mail->nombre . ' por el monto de $' . $importe_cargado . ' en el dia ' . $fecha_cargado . ', si usted no realizo la carga de combustible informe directamente a las autoridades. Por favor no responda este correo.
				<br>
				<img src="' . base_url() . 'public/images/logo-muni.jpg" height="248" width="700">
				'
			);

			$this->email->send();


			//-----------------------------------------------fin envio email------------------------------------


		} else {
			echo "false";
		}
	}


	public function confirmarCargaSec($id_ticket, $importe_cargado, $diferencia, $id_comb_cargado)
	{


		if ($id_comb_cargado != 0) {
			$precio_litro = $this->Ticket_Model->getPrecio($id_comb_cargado);
			$litroscargados = $importe_cargado / $precio_litro;
		}

		$fecha_cargado = date("Y-m-d H:i:s");
		$array = array(
			'importe_cargado' => $importe_cargado,
			'estado' => "Cargado",
			'fecha_cargado' => $fecha_cargado,
			'litros_emitidos' => $litroscargados
		);

		$getSecretaria = $this->Ticket_Model->getSecretariaRendir($id_ticket);
		$id_usuario = $this->session->userdata("id");
		$datosticket = $this->Ticket_Model->getDatosTicket($id_ticket);

		$saldoSec = $this->Ticket_Model->obtenerSaldo($getSecretaria);

		$nuevosaldo = $saldoSec + $diferencia;

		$actualizarSaldo = array(
			'saldo' => $nuevosaldo
		);


		$movimiento = array(
			'nit' => $datosticket->nit,
			'tipo_movimiento' => 'Carga de ticket',
			'fecha_movimiento' => $fecha_cargado,
			'id_usuario' => $id_usuario,
			'importe' => $datosticket->importe,
			'devolucion' => $diferencia,
			'id_per' => $datosticket->id_per,
			'id_ve' => $datosticket->id_ve

		);

		$movimientoSaldoSec = array(
			'nit' => $datosticket->nit,
			'tipo_movimiento' => 'Devolucion de saldo',
			'fecha_movimiento' => $fecha_cargado,
			'id_usuario' => $id_usuario,
			'importe' => $datosticket->importe,
			'devolucion' => $diferencia,
			'id_per' => $datosticket->id_per,
			'id_ve' => $datosticket->id_ve,
			'id_secretaria' => $getSecretaria

		);


		$id_persona = $datosticket->id_per;
		$id_vehiculo = $datosticket->id_ve;
		$mail = $this->Ticket_Model->obtenerEmail($id_persona);
		$vehiculo = $this->Ticket_Model->obtenerVehiculo($id_vehiculo);

		if ($this->Ticket_Model->ticketCargado($id_ticket, $array, $movimiento)) {
			$this->Ticket_Model->actualizarSaldo($actualizarSaldo, $getSecretaria, $movimientoSaldoSec);
			echo "true";



			//--------------------------------------------------Envio de email---------------------------------------------------

			$this->load->library("email");

			$mail_config['smtp_host'] = 'modernizacionvcp.gob.ar';
			$mail_config['smtp_port'] = '587';
			$mail_config['smtp_user'] = 'ticketscarga@modernizacionvcp.gob.ar';
			$mail_config['_smtp_auth'] = TRUE;
			$mail_config['smtp_pass'] = 'VZCJ}8Vc[9b{';
			$mail_config['smtp_crypto'] = 'tls';
			$mail_config['protocol'] = 'smtp';
			$mail_config['mailtype'] = 'html';
			$mail_config['send_multipart'] = FALSE;
			$mail_config['charset'] = 'utf-8';
			$mail_config['wordwrap'] = TRUE;
			$this->email->initialize($mail_config);

			$this->email->set_newline("\r\n");


			$this->email->from('ticketscarga@modernizacionvcp.gob.ar');
			$this->email->to($mail->mail);
			$this->email->subject('Notificacion de carga de combustible');
			$this->email->message(
				'<h2>Carga de combustible</h2>
				<hr>
				<br>
				Se realizo la carga de combustible con ticket Nº ' . $datosticket->nit . ' en el vehiculo: ' . $vehiculo->marca . ' ' . $vehiculo->modelo . ' con dominio ' . $vehiculo->dominio . ' a nombre de la persona ' . $mail->nombre . ' por el monto de $' . $importe_cargado . ' en el dia ' . $fecha_cargado . ', si usted no realizo la carga de combustible informe directamente a las autoridades. Por favor no responda este correo.
				<br>
				<img src="' . base_url() . 'public/images/logo-muni.jpg" height="248" width="700">
				'
			);

			$this->email->send();


			//-----------------------------------------------fin envio email------------------------------------


		} else {
			echo "false";
		}
	}



	public function cargaCombustible()
	{


		$this->load->view('vistas/ticket/cargaCombustible');
		$this->load->view('layouts/footer');
	}

	public function verMovimientosTickets()
	{
		if ($this->session->userdata("rol") == 1 || $this->session->userdata("rol") == 5 || $this->session->userdata("rol") == 6) {
			$mov = array(
				'movtickets' => $this->Ticket_Model->getMovimientosTickets()
			);

			$this->load->view('layouts/header');
			$this->load->view('vistas/ticket/listMovimientos', $mov);
			$this->load->view('layouts/footer');
		} else {
			redirect(base_url() . 'Login/logout');
		}
	}

	public function verMovimientosSoli()
	{
		if ($this->session->userdata("rol") == 1 || $this->session->userdata("rol") == 5 || $this->session->userdata("rol") == 6) {


			$mov = array(
				'movtickets' => $this->Ticket_Model->getMovimientosSoli()
			);
			$this->load->view('layouts/header');
			$this->load->view('vistas/ticket/listMovimientosSoli', $mov);
			$this->load->view('layouts/footer');
		} else {

			redirect(base_url() . 'Login/logout');
		}
	}


	public function rendir()
	{
		$this->permisos = $this->backend_lib->control();
		$this->load->view('layouts/header');
		$this->load->view('vistas/ticket/rendir');
		$this->load->view('layouts/footer');
	}

	public function getTickets()
	{
		$tickets = array('tic' => $this->Ticket_Model->getTickets());
		$this->load->view("vistas/ticket/modal-ticket", $tickets);
	}

	public function rendirTicket($id, $cant_litros, $tipo_comb, $expediente)
	{
		$fecha_rendido = date("Y-m-d h:i:s");
		//$id=$this->input->post('id');
		$id_usuario = $this->session->userdata("id");
		$datosticket = $this->Ticket_Model->getDatosTicket($id);
		//$cant_litros=$this->input->post("cant_litros");
		//$tipo_comb=$this->input->post("tipo_comb");
		//$importe_cargado=$this->input->post("importe_cargado");


		$nuevotipo = (explode("%20", $tipo_comb));


		$rendir = array(
			'estado' => 'Rendido',
			'fecha_rendido' => $fecha_rendido,
			'tipo_comb' => $nuevotipo[0] . " " . $nuevotipo[1],
			'cant_litros' => $cant_litros,
			'expediente' => $expediente
		);


		$movimiento = array(
			'nit' => $datosticket->nit,
			'tipo_movimiento' => 'Rendicion de ticket',
			'fecha_movimiento' => $fecha_rendido,
			'id_usuario' => $id_usuario,
			'importe' => $datosticket->importe_cargado,
			'id_per' => $datosticket->id_per,
			'id_ve' => $datosticket->id_ve

		);


		$this->Ticket_Model->insertRendido($id, $rendir, $movimiento);
	}

	// public function rendirTicketSec($id, $cant_litros, $tipo_comb, $importe_cargado, $diferencia){
	// 	$fecha_rendido = date("Y-m-d h:i:s");
	// 	$id_usuario = $this->session->userdata("id");
	// 	$datosticket=$this->Ticket_Model->getDatosTicket($id);
	// 	$nuevotipo=(explode("%20", $tipo_comb));
	// 	$getSecretaria=$this->Ticket_Model->getSecretariaRendir($id);

	// 	$saldoSec=$this->Ticket_Model->obtenerSaldo($getSecretaria);

	// 	$nuevosaldo=$saldoSec+$diferencia;

	// 	$actualizarSaldo= array(
	// 		'saldo' => $nuevosaldo
	// 	);

	// 	$rendir = array(
	// 		'importe_cargado' => $importe_cargado,
	// 		'estado' => 'Rendido',
	// 		'fecha_rendido' => $fecha_rendido,
	// 		'tipo_comb' => $nuevotipo[0]." ".$nuevotipo[1],
	// 		'cant_litros' => $cant_litros
	// 	);


	// 	$movimiento = array(
	// 		'nit' => $datosticket->nit,
	// 		'tipo_movimiento' => 'Rendicion de ticket',
	// 		'fecha_movimiento' => $fecha_rendido,
	// 		'id_usuario' => $id_usuario,
	// 		'importe' => $datosticket->importe,
	// 		'devolucion' => $diferencia,
	// 		'id_per' => $datosticket->id_per,
	// 		'id_ve' => $datosticket->id_ve

	// 	);

	// 	$movimientoSaldoSec = array(
	// 		'nit' => $datosticket->nit,
	// 		'tipo_movimiento' => 'Devolucion de saldo',
	// 		'fecha_movimiento' => $fecha_rendido,
	// 		'id_usuario' => $id_usuario,
	// 		'importe' => $datosticket->importe,
	// 		'devolucion' => $diferencia,
	// 		'id_per' => $datosticket->id_per,
	// 		'id_ve' => $datosticket->id_ve,
	// 		'id_secretaria' => $getSecretaria

	// 	);


	// 	if ($this->Ticket_Model->insertRendido($id, $rendir, $movimiento)) {
	// 		$this->Ticket_Model->actualizarSaldo($actualizarSaldo, $getSecretaria, $movimientoSaldoSec);
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}


	// }

	public function reintegroSaldo()
	{

		$id_sec = $this->session->userdata("id_secretaria");
		if ($this->session->userdata('rol') == 1) {
			$data = array(
				'movtickets' => $this->Ticket_Model->listReintegroadmin()
			);
		} else {
			$data = array(
				'movtickets' => $this->Ticket_Model->listReintegro($id_sec)
			);
		}



		$this->load->view('layouts/header');
		$this->load->view('vistas/ticket/listMovimientosReintegro', $data);
		$this->load->view('layouts/footer');
	}

	public function listEmitidos()
	{
		$this->permisos = $this->backend_lib->control();
		$permiso = $this->session->userdata("rol");
		$id_secretaria = $this->session->userdata("id_secretaria");

		if ($permiso == 6 || $permiso == 1) {
			$emitidos = array('emi' => $this->Ticket_Model->getTicketsEmitidos());
		} else {
			$emitidos = array('emi' => $this->Ticket_Model->getTicketsEmitidosPorSecretaria($id_secretaria));
		}

		$this->load->view('layouts/header');
		$this->load->view('vistas/ticket/listEmitidos', $emitidos);
		$this->load->view('layouts/footer');
	}

	public function listRendidos()
	{
		$this->permisos = $this->backend_lib->control();
		$trendidos = array(
			'rendidos' => $this->Ticket_Model->listTicketsrendidos(),
			'expedientes' => $this->Ticket_Model->getExpedientes()
		);
		$this->load->view('layouts/header');
		$this->load->view('vistas/ticket/listRendidos', $trendidos);
		$this->load->view('layouts/footer');
	}

	public function getRendidosID($id)
	{
		$rendidos = array(
			'r' => $this->Ticket_Model->getRendidosId($id)
		);

		$this->load->view('vistas/ticket/modal-info-rendido', $rendidos);
	}

	public function listPorExpediente()
	{
		$expediente = $this->input->post("expediente");
		$porExpediente = array(
			'porExpediente' => $this->Ticket_Model->listPorExpediente($expediente),
			'expediente' => $expediente,
			'fechas' => $this->Ticket_Model->listFecha($expediente)
		);
		$this->load->view('layouts/header');
		$this->load->view('vistas/ticket/porExpediente', $porExpediente);
		$this->load->view('layouts/footer');
	}

	public function getInfoTicketById($id)
	{
		$ticket = array('t' => $this->Ticket_Model->getInfoTicketById($id),);
		$this->load->view('vistas/ticket/modal-info-ticket', $ticket);
	}

	public function getInfoTicketByIdCancelar($id)
	{
		$ticket = array('t' => $this->Ticket_Model->getInfoTicketById($id),);
		$this->load->view('vistas/ticket/modal-cancelar-ticket', $ticket);
	}

	public function cancelarTicket($id_ticket)
	{

		$motivo = $this->input->post('motivo');
		$fecha_cancelado = date("Y-m-d H:i:s");

		$array = array(
			'estado' => 'cancelado',
			'motivo' => $motivo,
			'fecha_cargado' => $fecha_cancelado

		);


		$getSecretaria = $this->Ticket_Model->getSecretariaRendir($id_ticket);
		$id_usuario = $this->session->userdata("id");
		$datosticket = $this->Ticket_Model->getDatosTicket($id_ticket);

		$saldoSec = $this->Ticket_Model->obtenerSaldo($getSecretaria);

		$nuevosaldo = $saldoSec + $datosticket->importe;

		$actualizarSaldo = array(
			'saldo' => $nuevosaldo
		);


		$movimiento = array(
			'nit' => $datosticket->nit,
			'tipo_movimiento' => 'Ticket cancelado',
			'fecha_movimiento' => $fecha_cancelado,
			'id_usuario' => $id_usuario,
			'importe' => $datosticket->importe,
			'devolucion' => $datosticket->importe,
			'id_per' => $datosticket->id_per,
			'id_ve' => $datosticket->id_ve

		);

		$movimientoSaldoSec = array(
			'nit' => $datosticket->nit,
			'tipo_movimiento' => 'Devolucion de saldo',
			'fecha_movimiento' => $fecha_cancelado,
			'id_usuario' => $id_usuario,
			'importe' => $datosticket->importe,
			'devolucion' => $datosticket->importe,
			'id_per' => $datosticket->id_per,
			'id_ve' => $datosticket->id_ve,
			'id_secretaria' => $getSecretaria

		);



		if ($this->Ticket_Model->ticketCargado($id_ticket, $array, $movimiento)) {
			$this->Ticket_Model->actualizarSaldo($actualizarSaldo, $getSecretaria, $movimientoSaldoSec);
			echo "true";
		}
	}

	public function litrosPorSec()
	{
		$this->load->model("Reportes_Model");
		$secretaria = $this->input->post("secretaria");
		$ano_filtro = $this->input->post("ano_filtro");
		$data = array(
			'enero' => $this->Reportes_Model->getSecLitrosenero($secretaria, $ano_filtro),
			'febrero' => $this->Reportes_Model->getSecLitrosfebrero($secretaria, $ano_filtro),
			'marzo' => $this->Reportes_Model->getSecLitrosmarzo($secretaria, $ano_filtro),
			'abril' => $this->Reportes_Model->getSecLitrosabril($secretaria, $ano_filtro),
			'mayo' => $this->Reportes_Model->getSecLitrosmayo($secretaria, $ano_filtro),
			'junio' => $this->Reportes_Model->getSecLitrosjunio($secretaria, $ano_filtro),
			'julio' => $this->Reportes_Model->getSecLitrosjulio($secretaria, $ano_filtro),
			'agosto' => $this->Reportes_Model->getSecLitrosagosto($secretaria, $ano_filtro),
			'septiembre' => $this->Reportes_Model->getSecLitrosseptiembre($secretaria, $ano_filtro),
			'octubre' => $this->Reportes_Model->getSecLitrosoctubre($secretaria, $ano_filtro),
			'noviembre' => $this->Reportes_Model->getSecLitrosnoviembre($secretaria, $ano_filtro),
			'diciembre' => $this->Reportes_Model->getSecLitrosdiciembre($secretaria, $ano_filtro),
		//	'litros' => $this->Reportes_Model->totalLitros($secretaria, $ano_filtro),
			'sec' => $this->Reportes_Model->getSec($secretaria),
			'ano' => $ano_filtro
		);
		$this->load->view('layouts/header');
		$this->load->view('reportes/litrosPorSec', $data);
		$this->load->view('layouts/footer');
	}

	public function getLitrosMes()
	{
		$this->load->view('layouts/header');
		$this->load->view('reportes/litrosMesVe');
		$this->load->view('layouts/footer');
	}

	public function litrosMes()
	{
		$dominio = $this->input->post("dominio");
		$mes = $this->input->post("mes");
		$data = array(
			'litros' =>	$this->Reportes_Model->getLitrosMes($dominio, $mes),
			'ticket' => $this->Reportes_Model->getTicketsMes($dominio, $mes),
			'dominio' => $dominio,
			'mes' => $mes
		);

		$this->load->view('layouts/header');
		$this->load->view('reportes/litrosMesVe', $data);
		$this->load->view('layouts/footer');
	}

	// public function litrosPorSecFecha(){
	// 	$this->load->model("Reportes_Model");
	// 	$fechadesde=$this->input->post("desde");
	// 	$fechahasta=$this->input->post("hasta");
	// 	$data = array(
	// 		'secLitros' => $this->Reportes_Model->getSecLitrosFecha($fechadesde, $fechahasta),
	// 		'litros' => $this->Reportes_Model->totalLitrosFecha($fechadesde, $fechahasta),
	// 		'fechadesde'=>$fechadesde,
	// 		'fechahasta'=>$fechahasta,
	// 	);

	//    $this->load->view('layouts/header');
	//    $this->load->view('reportes/litrosPorSec', $data);
	//    $this->load->view('layouts/footer');
	// }

	public function consultarPrecios()
	{
		$tipo_comb = $this->input->post("tipo_comb");
		$precio_litro = $this->Ticket_Model->consultarPrecios($tipo_comb);
		echo $precio_litro;
	}

	public function solicitarSaldo()
	{
		$a = $this->input->post("aContaduria");

		if ($a == "a sec") {
			$id_direccion = $this->session->userdata("id_direccion");
			$id_secretaria = $this->session->userdata("id_secretaria");
			$id_usuario = $this->session->userdata("id");
			$hoy = date("Y-m-d");
			$fecha_emision = date("Y-m-d H:i:s");
			$solicitud = array(
				'id_direccion' => $id_direccion,
				'id_secretaria' => $id_secretaria,
				'fecha_solicitud' => $hoy,
				'estado' => 'Emitida',
				'flag' => '0'
			);

			$movimiento = array(
				'tipo_movimiento' => "Solicitud saldo",
				'fecha_movimiento' =>  $fecha_emision,
				'id_usuario' => $id_usuario,
				'id_direccion' => $id_direccion,
				'id_secretaria' => $id_secretaria
			);

			if ($this->Ticket_Model->ifSolicitado($id_direccion) == true) {
				if ($this->Ticket_Model->insertSolicitud($solicitud, $movimiento) == true) {
					echo "true";
				} else {
					echo "false";
				}
			} else {
				echo "false";
			}
		} else {
			$id_secretaria = $this->session->userdata("id_secretaria");
			$id_usuario = $this->session->userdata("id");
			$hoy = date("Y-m-d");
			$fecha_emision = date("Y-m-d H:i:s");

			$solicitud = array(
				'id_direccion' => '0',
				'id_secretaria' => $id_secretaria,
				'fecha_solicitud' => $hoy,
				'estado' => 'Emitida',
				'flag' => '1'
			);

			$movimiento = array(
				'tipo_movimiento' => "Solicitud saldo a contaduria",
				'fecha_movimiento' =>  $fecha_emision,
				'id_usuario' => $id_usuario,
				'id_direccion' => '0',
				'id_secretaria' => $id_secretaria
			);
			if ($this->Ticket_Model->ifSolicitadoContaduria($id_secretaria) == true) {
				if ($this->Ticket_Model->insertSolicitud($solicitud, $movimiento) == true) {
					echo "true";
				} else {
					echo "false";
				}
			} else {
				echo "false";
			}
		}
	}

	public function listSolicitudes()
	{
		$this->permisos = $this->backend_lib->control();
		$id_secretaria = $this->session->userdata("id_secretaria");
		$solicitudes = array(
			'soli' => $this->Ticket_Model->getSolicitudesByIdSec($id_secretaria),
			'saldo' => $this->Ticket_Model->getSaldoByIdSecretaria($id_secretaria),
			'direcciones' => $this->Ticket_Model->getDirConSaldoByIdSec($id_secretaria)
		);
		$this->load->view('layouts/header');
		$this->load->view('vistas/solicitudes/listSolicitudes', $solicitudes);
		$this->load->view('layouts/footer');
	}

	public function otorgarSaldoDesdeSecToDirSinSolicitud()
	{
		$id_dir = $this->input->post("id_dir");
		$monto = $this->input->post("monto");
		$id_usuario = $this->session->userdata("id");
		$id_secretaria = $this->session->userdata("id_secretaria");
		$hoyfechahora = date("Y-m-d H:i:s");
		$otorgando = $this->input->post("otorgando");
		$saldo_actual_sec = $this->input->post("saldo_actual_sec");

		$total_for_sec = ($saldo_actual_sec - $otorgando);
		$sec = array('saldo' => $total_for_sec);


		$ar = array('saldo' => $monto,);
		if ($this->Ticket_Model->updateDir($id_dir, $ar)) {
			$movimiento = array(
				'tipo_movimiento' => "Alta de saldo",
				'fecha_movimiento' => $hoyfechahora,
				'id_usuario' => $id_usuario,
				'id_direccion' => $id_dir,
				'id_secretaria' => $id_secretaria,
				'importe' => $otorgando
			);
			if ($this->Ticket_Model->updateSec($id_secretaria, $sec)) {
				$this->Ticket_Model->insertMovimiento($movimiento);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function otorgarSaldoModalSecDir($id)
	{
		$info = array(
			'd' => $this->Ticket_Model->getInfoSolicitudSecDirById($id),
		);
		$this->load->view('vistas/solicitudes/modal-otorgarSaldo-sec-dir', $info);
	}


	public function ingresarMontoSolicitudSecDir()
	{
		$id_soli = $this->input->post("id_soli");
		$id_dir = $this->input->post("id_dir");
		$id_sec = $this->input->post("id_sec");
		$saldo_dir = $this->input->post("saldo_dir");
		$saldo_sec = $this->input->post("saldo_sec");
		$monto = $this->input->post("monto");
		$hoy = date("Y-m-d");
		$hoyfechahora = date("Y-m-d H:i:s");
		$id_usuario = $this->session->userdata("id");

		$s = array(
			'fecha_ingreso_monto' => $hoy,
			'monto' => $monto,
			'estado' => 'En espera de confirmacion',
		);

		$movimiento = array(
			'tipo_movimiento' => "Solicitud en espera de aprobacion por secretario",
			'fecha_movimiento' => $hoyfechahora,
			'id_usuario' => $id_usuario,
			'importe' => $monto,
			'id_direccion' => $id_dir,
			'id_secretaria' => $id_sec

		);
		if ($this->Ticket_Model->updateSolicitudSecDir($id_soli, $s, $movimiento)) {
			echo "true";
		} else {
			echo "false";
		}
	}

	public function rechazarSolicitud($id)
	{
		$hoy = date("Y-m-d");
		$id_usuario = $this->session->userdata("id");
		$hoyfechahora = date("Y-m-d H:i:s");
		$id_sec = $this->session->userdata("id_secretaria");
		$miniarray = $this->Ticket_Model->getInfoSolicitudSecDirById($id);
		$id_dir = $miniarray->id_dir;

		$ar = array(
			'estado' => 'Recahazada',
			'fecha_confirmacion' => $hoy
		);
		$movimiento = array(
			'tipo_movimiento' => "Solicitud rechazada",
			'fecha_movimiento' => $hoyfechahora,
			'id_usuario' => $id_usuario,
			'id_direccion' => $id_dir,
			'id_secretaria' => $id_sec

		);
		if ($this->Ticket_Model->updateSolicitudSecDir($id, $ar, $movimiento)) {
			echo "true";
		} else {
			echo "false";
		}
	}

	/////////////////////////////////// SOLICITUDES A CONFIRMAR POR SECRETARIO /////////////////////////////////////////////

	public function listSolicitudesForSecretario()
	{
		$this->permisos = $this->backend_lib->control();
		$id_secretaria = $this->session->userdata("id_secretaria");
		$solicitudes = array(
			'soli' => $this->Ticket_Model->getSolicitudesForSecretarioByIdSec($id_secretaria),
			'saldo' => $this->Ticket_Model->getSaldoByIdSecretaria($id_secretaria)
		);
		$this->load->view('layouts/header');
		$this->load->view('vistas/solicitudes/listSolicitudesSecDir', $solicitudes);
		$this->load->view('layouts/footer');
	}

	public function confirmSoliForSecretario()
	{
		$hoy = date("Y-m-d");
		$id_soli = $this->input->post("id_soli");
		$monto = $this->input->post("monto");
		$saldo_sec = $this->input->post("saldo_sec");
		$id_dir = $this->input->post("id_dir");
		$id_sec = $this->session->userdata("id_secretaria");
		$id_usuario = $this->session->userdata("id");
		$ahora = date("Y-m-d H:i:s");

		$saldo_dir = $this->Ticket_Model->getCantTickets2($id_dir);

		$totalForDir = ($saldo_dir + $monto);
		$totalForSec = ($saldo_sec - $monto);

		$dir = array('saldo' => $totalForDir,);
		if ($this->Ticket_Model->updateDir($id_dir, $dir)) {
			$sec = array('saldo' => $totalForSec,);
			if ($this->Ticket_Model->updateSec($id_sec, $sec)) {
				$soli = array(
					'estado' => 'Aprobada',
					'fecha_confirmacion' => $hoy,
				);

				$movimiento = array(
					'tipo_movimiento' => "Solicitud aprobada por secretario",
					'fecha_movimiento' => $ahora,
					'id_usuario' => $id_usuario,
					'importe' => $monto,
					'id_direccion' => $id_dir,
					'id_secretaria' => $id_sec
				);
				$this->Ticket_Model->updateSolicitudSecDir($id_soli, $soli, $movimiento);
				echo "true";
			} else {
				echo "false";
			}
		} else {
			echo "false";
		}
	}

	public function rechazarSolicitudForSecretario($id)
	{
		$hoy = date("Y-m-d");
		$id_usuario = $this->session->userdata("id");
		$hoyfechahora = date("Y-m-d H:i:s");
		$id_sec = $this->session->userdata("id_secretaria");
		$miniarray = $this->Ticket_Model->getInfoSolicitudSecDirById($id);
		$id_dir = $miniarray->id_dir;

		$ar = array(
			'estado' => 'Recahazada',
			'fecha_confirmacion' => $hoy
		);
		$movimiento = array(
			'tipo_movimiento' => "Solicitud rechazada por secretario",
			'fecha_movimiento' => $hoyfechahora,
			'id_usuario' => $id_usuario,
			'id_direccion' => $id_dir,
			'id_secretaria' => $id_sec

		);
		if ($this->Ticket_Model->updateSolicitudSecDir($id, $ar, $movimiento)) {
			echo "true";
		} else {
			echo "false";
		}
	}

	/////////////////////////////////// SOLICITUDES EN CONTADURIA /////////////////////////////////////////////

	public function ingresarSaldoByCont()
	{
		$id_soli = $this->input->post("id_soli");
		$id_sec = $this->input->post("id_sec");
		$saldo_sec = $this->input->post("saldo_sec");
		$nombre_sec = $this->input->post("nombre_sec");
		$ar = array(
			'id_soli' => $id_soli,
			'id_sec' => $id_sec,
			'saldo_sec' => $saldo_sec,
			'nombre_sec' => $nombre_sec,
		);
		$this->load->view('vistas/solicitudes_cont/modal-ingresar-saldo-solicitado', $ar);
	}

	public function ingresarMontoAprobarSolicitud()
	{
		$id_soli = $this->input->post("id_soli");
		$id_sec = $this->input->post("id_sec");
		$saldo_sec = $this->input->post("saldo_sec");
		$monto = $this->input->post("monto");

		$total = ($saldo_sec + $monto);
		$hoy = date("Y-m-d");
		$hoyfechahora = date("Y-m-d H:i:s");
		$id_usuario = $this->session->userdata("id");

		$s = array(
			'fecha_ingreso_monto' => $hoy,
			'fecha_confirmacion' => $hoy,
			'monto' => $monto,
			'estado' => 'Aprobada',
		);
		$sec = array('saldo' => $total,);
		$movimiento = array(
			'nit' => '0',
			'tipo_movimiento' => 'Solicitud aprobada por contaduria',
			'fecha_movimiento' => $hoyfechahora,
			'id_usuario' => $id_usuario,
			'id_secretaria' => $id_sec,
			'id_direccion' => '1',
			'importe' => $monto
		);

		if ($this->Ticket_Model->updateSolicitudSecDir($id_soli, $s, $movimiento)) {
			if ($this->Ticket_Model->updateSec($id_sec, $sec)) {
				echo "true";
			} else {
				echo "false";
			}
		} else {
			echo "false";
		}
	}


	public function listSolicitudesContaduria()
	{
		$this->permisos = $this->backend_lib->control();
		$solicitudes = array(
			'soli' => $this->Ticket_Model->getSolicitudesForContaduria(),
			'sec' => $this->Ticket_Model->getSecretarias()
		);
		$this->load->view('layouts/header');
		$this->load->view('vistas/solicitudes_cont/list', $solicitudes);
		$this->load->view('layouts/footer');
	}

	public function rechazarSolicitudContaduria($id)
	{
		$hoy = date("Y-m-d");
		$id_usuario = $this->session->userdata("id");
		$hoyfechahora = date("Y-m-d H:i:s");
		$miniarray = $this->Ticket_Model->getInfoSolicitudContaduriaById($id);
		$id_sec = $miniarray->id_secretaria;

		$ar = array(
			'estado' => 'Recahazada',
			'fecha_confirmacion' => $hoy
		);
		$movimiento = array(
			'tipo_movimiento' => "Solicitud rechazada por contaduria",
			'fecha_movimiento' => $hoyfechahora,
			'id_usuario' => $id_usuario,
			'id_direccion' => '1',
			'id_secretaria' => $id_sec

		);
		if ($this->Ticket_Model->updateSolicitudSecDir($id, $ar, $movimiento)) {
			echo "true";
		} else {
			echo "false";
		}
	}

	public function otorgarSaldoDesdeContaduria()
	{
		$id_sec = $this->input->post("id_sec");
		$monto = $this->input->post("monto");
		$id_usuario = $this->session->userdata("id");
		$hoyfechahora = date("Y-m-d H:i:s");
		$otorgando = $this->input->post("otorgando");


		$ar = array('saldo' => $monto,);
		if ($this->Ticket_Model->updateSec($id_sec, $ar)) {
			$movimiento = array(
				'tipo_movimiento' => "Alta de saldo por contaduria",
				'fecha_movimiento' => $hoyfechahora,
				'id_usuario' => $id_usuario,
				'id_secretaria' => $id_sec,
				'id_direccion' => '1',
				'importe' => $otorgando
			);
			if ($this->Ticket_Model->insertMovimiento($movimiento)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
