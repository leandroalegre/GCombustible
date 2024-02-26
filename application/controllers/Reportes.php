<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reportes extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model("Login_Model");
		$id_usuario = $this->session->userdata("id");
		$string_user = $this->session->userdata("string");
		$string = $this->Login_Model->getString($id_usuario);

		if ($string_user == null) {
			redirect(base_url() . 'Login/logout');
		} else if ($string != $string_user) {
			redirect(base_url() . 'Login/logout');
		}
		$this->load->model("Reportes_Model");
		$this->load->model("Personas_Model");
		$this->load->model("Vehiculos_Model");
	}

	public function TicketsPorPersona()
	{
		if ($this->session->userdata("rol") == 1 || $this->session->userdata("nombre_secretaria") == "INTENDENCIA") {
			$reporte = array(
				'rep' => $this->Reportes_Model->TicketsPorPersona()
			);

			$this->load->view('layouts/header');
			$this->load->view('reportes/porPersona', $reporte);
			$this->load->view('layouts/footer');
		} else {
			redirect(base_url() . 'Login/logout');
		}
	}

	public function TicketsPorVehiculo()
	{
		if ($this->session->userdata("rol") == 1 || $this->session->userdata("nombre_secretaria") == "INTENDENCIA") {
			$reporte = array(
				'rep' => $this->Reportes_Model->TicketsPorVehiculo()
			);

			$this->load->view('layouts/header');
			$this->load->view('reportes/porVehiculo', $reporte);
			$this->load->view('layouts/footer');
		} else {
			redirect(base_url() . 'Login/logout');
		}
	}

	public function TicketsPorVehiculoSec()
	{

		$id_secretaria = $this->session->userdata('id_secretaria');

		$reporte = array(
			'rep' => $this->Reportes_Model->TicketsPorVehiculoSec($id_secretaria)
		);

		$this->load->view('layouts/header');
		$this->load->view('reportes/porVehiculoSec', $reporte);
		$this->load->view('layouts/footer');
	}

	public function porSecretaria()
	{
		if ($this->session->userdata("rol") != 1) {
			redirect(base_url() . 'Login/logout');
		}
		$reporte = array(
			'rep' => $this->Reportes_Model->porSecretaria()
		);

		$this->load->view('layouts/header');
		$this->load->view('reportes/porSecretaria', $reporte);
		$this->load->view('layouts/footer');
	}

	public function GastadoPorSecretariaFecha()
	{
		$desde = $this->input->post('desde');
		$hasta = $this->input->post('hasta');

		$reporte = array(
			'rep' => $this->Reportes_Model->GastadoPorSecretariaFecha($desde, $hasta),
			'fechadesde' => $desde,
			'fechahasta' => $hasta
		);


		$this->load->view('layouts/header');
		$this->load->view('reportes/porSecretaria', $reporte);
		$this->load->view('layouts/footer');
	}

	public function TicketsPorPersonaSec()
	{
		$id_secretaria = $this->session->userdata('id_secretaria');

		$reporte = array(
			'rep' => $this->Reportes_Model->TicketsPorPersonaSec($id_secretaria)
		);

		$this->load->view('layouts/header');
		$this->load->view('reportes/porPersonaSec', $reporte);
		$this->load->view('layouts/footer');
	}

	public function GastadoPorVehiculoFechaSec()
	{
		$desde = $this->input->post('desde');
		$hasta = $this->input->post('hasta');
		$id_secretaria = $this->session->userdata('id_secretaria');

		$reporte = array(
			'rep' => $this->Reportes_Model->GastadoPorVehiculoFechaSec($desde, $hasta, $id_secretaria),
			'fechadesde' => $desde,
			'fechahasta' => $hasta,
			'secretaria' => $this->Reportes_Model->buscarSecretaria($id_secretaria)

		);


		$this->load->view('layouts/header');
		$this->load->view('reportes/porVehiculoSec', $reporte);
		$this->load->view('layouts/footer');
	}

	public function TicketsPorVehiculoLitros()
	{
		if ($this->session->userdata("rol") == 1 || $this->session->userdata("nombre_secretaria") == "INTENDENCIA") {
			$reporte = array(
				'rep' => $this->Reportes_Model->TicketsPorVehiculoLitros()
			);

			$this->load->view('layouts/header');
			$this->load->view('reportes/porVehiculoLitros', $reporte);
			$this->load->view('layouts/footer');
		} else {
			redirect(base_url() . 'Login/logout');
		}
	}

	public function TicketsPorTipoComb()
	{
		if ($this->session->userdata("rol") == 1 || $this->session->userdata("nombre_secretaria") == "INTENDENCIA") {
			$reporte = array(
				'rep' => $this->Reportes_Model->TicketsPorTipoComb()
			);

			$this->load->view('layouts/header');
			$this->load->view('reportes/porTipoComb', $reporte);
			$this->load->view('layouts/footer');
		} else {
			redirect(base_url() . 'Login/logout');
		}
	}

	public function TicketsPorDevolucion()
	{
		if ($this->session->userdata("rol") == 1 || $this->session->userdata("nombre_secretaria") == "INTENDENCIA") {
			$reporte = array(
				'rep' => $this->Reportes_Model->TicketsPorDev()
			);

			$this->load->view('layouts/header');
			$this->load->view('reportes/porTicketdevolucion', $reporte);
			$this->load->view('layouts/footer');
		} else {
			redirect(base_url() . 'Login/logout');
		}
	}

	public function TicketDevFecha()
	{
		$desde = $this->input->post('desde');
		$hasta = $this->input->post('hasta');
		$id_secretaria = $this->input->post('id_secretaria');

		if ($id_secretaria == 0 && $desde == TRUE && $hasta == TRUE) {
			$reporte = array(
				'rep' => $this->Reportes_Model->TicketsDevFecha($desde, $hasta),
				'fechadesde' => $desde,
				'fechahasta' => $hasta
			);
		} else {
			$reporte = array(
				'rep' => $this->Reportes_Model->TicketsDevFechaSec($desde, $hasta, $id_secretaria),
				'fechadesde' => $desde,
				'fechahasta' => $hasta,
				'secretaria' => $this->Reportes_Model->buscarSecretaria($id_secretaria)

			);
		}



		$this->load->view('layouts/header');
		$this->load->view('reportes/porTicketdevolucion', $reporte);
		$this->load->view('layouts/footer');
	}

	public function GastadoPorPersonaFecha()
	{
		$desde = $this->input->post('desde');
		$hasta = $this->input->post('hasta');
		$id_secretaria = $this->input->post('id_secretaria');

		if ($id_secretaria == 0 && $desde == TRUE && $hasta == TRUE) {
			$reporte = array(
				'rep' => $this->Reportes_Model->GastadoPorPersonaFecha($desde, $hasta),
				'fechadesde' => $desde,
				'fechahasta' => $hasta
			);
		} else {
			$reporte = array(
				'rep' => $this->Reportes_Model->GastadoPorPersonaFechaySec($desde, $hasta, $id_secretaria),
				'fechadesde' => $desde,
				'fechahasta' => $hasta,
				'secretaria' => $this->Reportes_Model->buscarSecretaria($id_secretaria)

			);
		}



		$this->load->view('layouts/header');
		$this->load->view('reportes/porPersona', $reporte);
		$this->load->view('layouts/footer');
	}

	public function GastadoPorPersonaFechaSec()
	{
		$desde = $this->input->post('desde');
		$hasta = $this->input->post('hasta');
		$id_secretaria = $this->session->userdata('id_secretaria');

		$reporte = array(
			'rep' => $this->Reportes_Model->GastadoPorPersonaFechaSec($desde, $hasta, $id_secretaria),
			'fechadesde' => $desde,
			'fechahasta' => $hasta,
			'secretaria' => $this->Reportes_Model->buscarSecretaria($id_secretaria)

		);


		$this->load->view('layouts/header');
		$this->load->view('reportes/porPersonaSec', $reporte);
		$this->load->view('layouts/footer');
	}


	public function reportePorExpediente()
	{
		$this->load->model("Ticket_Model");

		$expediente = $this->input->post("expediente");
		$data = array(
			'expedientes' => $this->Ticket_Model->getExpedientes(),
			'pordir' => $this->Reportes_Model->buscarExpedientesPorDir($expediente),
			'porsec' => $this->Reportes_Model->buscarExpedientesPorSec($expediente),
			'total' =>$this->Reportes_Model->totalExpediente($expediente),
			'seleccionado' => $expediente
		);

		$this->load->view('layouts/header');
		$this->load->view('reportes/expedienteReport', $data);
		$this->load->view('layouts/footer');
	}



	public function LitrosCargadosFecha()
	{
		$desde = $this->input->post('desde');
		$hasta = $this->input->post('hasta');
		$id_secretaria = $this->input->post('id_secretaria');

		if ($id_secretaria == 0 && $desde == TRUE && $hasta == TRUE) {
			$reporte = array(
				'rep' => $this->Reportes_Model->TicketsPorTipoCombFecha($desde, $hasta),
				'fechadesde' => $desde,
				'fechahasta' => $hasta
			);
		} else {
			$reporte = array(
				'rep' => $this->Reportes_Model->TicketsPorTipoCombFechaySec($desde, $hasta, $id_secretaria),
				'fechadesde' => $desde,
				'fechahasta' => $hasta,
				'secretaria' => $this->Reportes_Model->buscarSecretaria($id_secretaria)

			);
		}



		$this->load->view('layouts/header');
		$this->load->view('reportes/porTipoComb', $reporte);
		$this->load->view('layouts/footer');
	}

	public function GastadoPorVehiculoFecha()
	{
		$desde = $this->input->post('desde');
		$hasta = $this->input->post('hasta');
		$id_secretaria = $this->input->post('id_secretaria');
		$tipo_vehiculo = $this->input->post("tipo_vehiculo");

		if ($tipo_vehiculo == 5) {

			if ($id_secretaria == 0 && $desde == TRUE && $hasta == TRUE) {
				$reporte = array(
					'rep' => $this->Reportes_Model->GastadoPorVehiculoFecha($desde, $hasta),
					'fechadesde' => $desde,
					'fechahasta' => $hasta
				);
			} else {
				$reporte = array(
					'rep' => $this->Reportes_Model->GastadoPorVehiculoFechaySec($desde, $hasta, $id_secretaria),
					'fechadesde' => $desde,
					'fechahasta' => $hasta,
					'secretaria' => $this->Reportes_Model->buscarSecretaria($id_secretaria)

				);
			}
		} else {
			if ($id_secretaria == 0 && $desde == TRUE && $hasta == TRUE) {
				$reporte = array(
					'rep' => $this->Reportes_Model->GastadoPorVehiculoFechaTipo($desde, $hasta, $tipo_vehiculo),
					'fechadesde' => $desde,
					'fechahasta' => $hasta
				);
			} else {
				$reporte = array(
					'rep' => $this->Reportes_Model->GastadoPorVehiculoFechaySecTipo($desde, $hasta, $id_secretaria, $tipo_vehiculo),
					'fechadesde' => $desde,
					'fechahasta' => $hasta,
					'secretaria' => $this->Reportes_Model->buscarSecretaria($id_secretaria)

				);
			}
		}

		$this->load->view('layouts/header');
		$this->load->view('reportes/porVehiculo', $reporte);
		$this->load->view('layouts/footer');
	}


	public function LitrosPorVehiculoFecha()
	{
		$desde = $this->input->post('desde');
		$hasta = $this->input->post('hasta');
		$id_secretaria = $this->input->post('id_secretaria');

		if ($id_secretaria == 0 && $desde == TRUE && $hasta == TRUE) {
			$reporte = array(
				'rep' => $this->Reportes_Model->LitrosPorVehiculoFecha($desde, $hasta),
				'fechadesde' => $desde,
				'fechahasta' => $hasta
			);
		} else {
			$reporte = array(
				'rep' => $this->Reportes_Model->LitrosPorVehiculoFechaySec($desde, $hasta, $id_secretaria),
				'fechadesde' => $desde,
				'fechahasta' => $hasta,
				'secretaria' => $this->Reportes_Model->buscarSecretaria($id_secretaria)

			);
		}



		$this->load->view('layouts/header');
		$this->load->view('reportes/porVehiculoLitros', $reporte);
		$this->load->view('layouts/footer');
	}

	public function dashboard()
	{
		$rol = $this->session->userdata("rol");

		if ($rol != 10) {


			switch ($rol) {
				case '2': //ADMIN DE SEC
					$id_sec = $this->session->userdata("id_secretaria");
					$reportes = array(
						'lic' => $this->Reportes_Model->getVencimientoLicenciasByIdSec($id_sec),
						'solicitudes' => $this->Reportes_Model->cant_solis_for_adminsec($id_sec),
						'personas' => $this->Reportes_Model->cantidadPersonasByIdSec($id_sec),
						'tickets' => $this->Reportes_Model->cant_tickets_emitidos_by_id_sec($id_sec),
						'vehiculos' => $this->Reportes_Model->cant_vehi_by_sec($id_sec),
						'personas_print' => $this->Personas_Model->getPersonasPrint($id_sec),
						'vehiculos_print' => $this->Vehiculos_Model->getVehiculosPrint($id_sec)
					);
					break;


				case '3': //ADMIN DE DIR
					$id_sec = $this->session->userdata("id_secretaria");
					$reportes = array(
						'lic' => $this->Reportes_Model->getVencimientoLicenciasByIdSec($id_sec),
						'solicitudes' => $this->Reportes_Model->cant_solis_for_adminsec($id_sec),
						'personas' => $this->Reportes_Model->cantidadPersonasByIdSec($id_sec),
						'tickets' => $this->Reportes_Model->cant_tickets_emitidos_by_id_sec($id_sec),
						'vehiculos' => $this->Reportes_Model->cant_vehi_by_sec($id_sec)
					);
					break;


				case '5': // SECRETARIO
					$id_sec = $this->session->userdata("id_secretaria");
					$reportes = array(
						'lic' => $this->Reportes_Model->getVencimientoLicenciasByIdSec($id_sec),
						'solicitudes' => $this->Reportes_Model->cant_solis_for_secretario($id_sec),
						'personas' => $this->Reportes_Model->cantidadPersonasByIdSec($id_sec),
						'tickets' => $this->Reportes_Model->cant_tickets_emitidos_by_id_sec($id_sec),
						'vehiculos' => $this->Reportes_Model->cant_vehi_by_sec($id_sec)
					);
					break;



				case '1': //ADMIN TOTAL
					$reportes = array(
						'lic' => $this->Reportes_Model->getVencimientoLicencias(),
						'solicitudesVe' => $this->Reportes_Model->getSolicitudesVe(),
					);
					break;

				case '8': //RRHH
					$id_sec = $this->session->userdata("id_secretaria");
					$reportes = array(
						'lic' => $this->Reportes_Model->getVencimientoLicencias()
					);
					break;
			}


			$this->load->view('layouts/header');
			$this->load->view('reportes/dashboard', $reportes);
			$this->load->view('layouts/footer');
		} else {
			$this->load->view('layouts/header');
			$this->load->view('reportes/dashboard');
			$this->load->view('layouts/footer');
		}
	}

	public function tabla_precios()
	{
		$data = array(
			'precios' => $this->Reportes_Model->getPreciosCombustible(),
		);

		$this->load->view('layouts/header');
		$this->load->view('reportes/tabla_precios', $data);
		$this->load->view('layouts/footer');
	}

	public function modificar_modal()
	{
		$data = array(
			'precios' => $this->Reportes_Model->getPreciosCombustible(),
		);
		$this->load->view('reportes/modificar_precios_modal', $data);
	}
	public function modificar_precios()
	{

		$data = array(
			'precio1' => $this->input->post('nafta'),
			'precio2' => $this->input->post('nafta_premium'),
			'precio3' => $this->input->post('gasoil'),
			'precio4' => $this->input->post('gasoil_premium'),
			'precio5' => $this->input->post('gnc')
		);

		for ($i = 1; $i < 6; $i++) {
			$p = "precio" . $i;
			$data2 = array(
				'precio_litro' => $data[$p],
			);
			$data3 = array(
				'id_precio_combustible' => $i,
				'precio_litro' => $data[$p],
				'fecha_movimiento' => date("Y-m-d H:i:s")
			);
			$this->Reportes_Model->actualizar_precio($data2, $p);
			$this->Reportes_Model->insertar_precio_historico($data3);
		}
		redirect(base_url() . "Reportes/tabla_precios");
	}

	public function ver_historico($id_precio)
	{
		$data = array(
			'combustible' => $this->Reportes_Model->getHistoricoCombustible($id_precio),
			'cuenta' => $this->Reportes_Model->contarRegistrosxcombustible($id_precio),
		);
		$this->load->view('layouts/header');
		$this->load->view('reportes/historico_combustible', $data);
		$this->load->view('layouts/footer');
	}
}
