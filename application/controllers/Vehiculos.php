<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vehiculos extends CI_Controller {

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
		$this->load->model("Personas_Model");
		$this->load->model("Vehiculos_Model");
		$this->load->model("Tarjeta_Model");
	}
	

	public function index(){
		$this->permisos = $this->backend_lib->control();
		$id_secretaria = $this->session->userdata('id_secretaria');
		if ($this->session->userdata('rol') == 1 || $this->session->userdata('rol') == 8 || $this->session->userdata('rol') == 9 || $this->session->userdata('rol') == 10) {
		$a = array(
			'vehiculos' =>$this->Vehiculos_Model->getVehiculossinsec(),
			'sec' => $this->Personas_Model->getSecretarias()
		);	
		}else{
		$a = array(
			'vehiculos' =>$this->Vehiculos_Model->getVehiculos($id_secretaria),
			'sec' => $this->Personas_Model->getSecretarias()
		);
	}
		$this->load->view("layouts/header");
		$this->load->view("vistas/vehiculos/list", $a);
		$this->load->view("layouts/footer");
	}

	public function add($marca, $modelo, $dominio, $secretaria, $direccion, $area, $id_tarjeta, $id_row_tarjeta, $num_llavero, $estado, $tipo_vehiculo, $m3_gnc){
		
		if ($num_llavero==0) {
			
		}else{
			$this->Tarjeta_Model->setearId($id_row_tarjeta);
		}
		


		$vehiculo = array(
			'marca' => strtoupper($marca) ,
			'modelo' => strtoupper($modelo) ,
			'id_tarjeta' => $id_tarjeta,
			'dominio' => strtoupper($dominio) ,
			'id_sec' => $secretaria,
			'id_dir' => $direccion,
			'id_are' => $area,
			'estado' => $estado,
			'num_llavero' => $num_llavero,
			'tipo_vehiculo' => $tipo_vehiculo,
			'm3_gnc' => $m3_gnc
		);
		if ($this->Vehiculos_Model->insertVehiculo($vehiculo)) {
			return true;
		}
	}

	public function detalleVehiculos(){
		if ($this->session->userdata('rol') == 9) {
			$id_dependencia = $this->session->userdata('id_dependencia');
			$data = array(
				'detalle' => $this->Vehiculos_Model->getDetallesbydependencia($id_dependencia)
			);
			$this->load->view("layouts/header");
			$this->load->view("vistas/vehiculos/listDetalles", $data);
			$this->load->view("layouts/footer");
		}else if($this->session->userdata('rol') == 8 || $this->session->userdata('rol') == 1){
			$data = array(
				'detalle' => $this->Vehiculos_Model->getDetalles()
			);
			$this->load->view("layouts/header");
			$this->load->view("vistas/vehiculos/listDetalles", $data);
			$this->load->view("layouts/footer");
		}else{
			redirect(base_url().'Login/logout');
		}
	}

	public function detallesfiltradosxsec(){
		$id_sec=$this->session->userdata("id_secretaria");
		$data = array(
			'detalle' => $this->Vehiculos_Model->getDetallesxsec($id_sec),
			'sec' => $this->Vehiculos_Model->getSecretaria($id_sec)
		);
		$this->load->view("layouts/header");
		$this->load->view("vistas/vehiculos/listDetalles", $data);
		$this->load->view("layouts/footer");

	}


	public function editV($id){
		//$id = $this->input->post("id");
		$id_sec = $this->Vehiculos_Model->getIdSecretaria($id);
		$id_dir = $this->Vehiculos_Model->getIdDireccion($id_sec, $id);

		$a = array(
			'v' =>$this->Vehiculos_Model->getV($id),
			'sec' => $this->Personas_Model->getSecretarias(),
			'dir' => $this->Vehiculos_Model->getDirecciones($id_sec),
			'ar' => $this->Vehiculos_Model->getAreasID($id_sec, $id_dir)
		);
		

		$this->load->view("layouts/header");
		$this->load->view("vistas/vehiculos/edit", $a);
		$this->load->view("layouts/footer");
	}

	public function detalleV($id){

		$data= array(
			'vehiculo' => $this->Vehiculos_Model->getVehiculo($id),
			'detalle_vehiculo' => $this->Vehiculos_Model->getDetallePorV($id),
			'dependencias' => $this->Vehiculos_Model->getDependencias()
		);

		$this->load->view("layouts/header");
		$this->load->view("vistas/vehiculos/detalle_veh", $data);
		$this->load->view("layouts/footer");
	}

	public function guardar_detalle(){
		$id_usuario=$this->session->userdata("id");
		$id_vehiculo = $this->input->post("id_vehiculo");
		$id_persona = $this->input->post("id_persona");
		$detalle = $this->input->post("detalle");
		$id_dependencia = $this->input->post("id_dependencia");
		$fecha_detalle = date("Y-m-d H:i:s");
		$data = array(
			'id_vehiculo' => $id_vehiculo,
			'id_persona' => $id_persona,
			'id_usuario' => $id_usuario,
			'descripcion' => $detalle,
			'id_dependencia' => $id_dependencia,
			'fecha_detalle' => $fecha_detalle
		);
		$this->Vehiculos_Model->insertar_detalleV($data);

		$data2 = array(
			'id_vehiculo' => $id_vehiculo,
			'id_dependencia' => $id_dependencia
		);
		$this->Vehiculos_Model->insertUbicacionVehiculo($data2);
		echo "true";
		
	}
	public function update(){
		$id = $this->input->post("id_v");
		$marca = $this->input->post("marca");
		$modelo = $this->input->post("modelo");
		$dominio = $this->input->post("dominio");
		$secretaria=$this->input->post("id_sec");
		$direccion=$this->input->post("id_dir");
		$area=$this->input->post("id_area");
		$num_llavero=$this->input->post("num_llavero");
		$id_tarjeta=$this->input->post("id_tarjeta");
		$tipo_vehiculo=$this->input->post("tipo_vehiculo");
		$m3_gnc=$this->input->post("m3_gnc");

		if($id_tarjeta==""){
			$vehiculo = array(
				'marca' => strtoupper($marca),
				'modelo' => strtoupper($modelo) ,
				'dominio' => $dominio ,
				'id_sec' => $secretaria,
				'id_dir' => $direccion,
				'id_are' => $area,
				'num_llavero' => $num_llavero,
				'tipo_vehiculo' => $tipo_vehiculo,
				'm3_gnc' => $m3_gnc
			);
		}else{
			$vehiculo = array(
			'marca' => strtoupper($marca),
			'modelo' => strtoupper($modelo) ,
			'dominio' => $dominio ,
			'id_sec' => $secretaria,
			'id_dir' => $direccion,
			'id_are' => $area,
			'num_llavero' => $num_llavero,
			'id_tarjeta' => $id_tarjeta,
			'tipo_vehiculo' => $tipo_vehiculo,
			'm3_gnc' => $m3_gnc
		);
		}
		

	
		 if ($this->Vehiculos_Model->updateVehiculo($id,$vehiculo)) {
		 	sleep(2);
		 	redirect(base_url()."Vehiculos");
		 }
	}

	public function getDominio($id){
		$dominio = $this->Vehiculos_Model->getDominio($id);
		echo $dominio;
	}

	public function delete($id){

		$detalle = $this->input->post("detalle");
		$detalle=array(
			'id_vehiculo' => $id,
			'id_usuario' => $this->session->userdata("id"),
			'descripcion' => $detalle,
			'id_dependencia' => 3,
			'fecha_detalle' => date("Y-m-d H:i:s")
		);

		
		$ar = array('estado' =>'0');
		if ($this->Vehiculos_Model->delete($id,$ar, $detalle)) {
			//$this->session->set_flashdata('document_status', mensaje('El vehiculo ha sido eliminado correctamente','success'));
			//redirect(base_url("Vehiculos"));
			return true;
		}
	}

	public function getDirecciones(){
		$id_secretaria = $this->input->post("id_sec");
		$data = $this->Personas_Model->getDirecciones($id_secretaria);
		?>
		<option value="0">Seleccionar:</option>
		<option value="1">SIN DIRECCION</option>
		<?php
		foreach ($data as $d) {
			?>
			<option value="<?php echo $d->id_dir ?>"><?php echo $d->nombre ?></option>
			<?php
		}

	}

	public function nuevo_detalle($id_vehiculo){
		$data=array(
			'dependencias' => $this->Vehiculos_Model->getDependencias(),
			'vehiculo' => $id_vehiculo,
			'vehiculodatos' => $this->Vehiculos_Model->getVehiculo($id_vehiculo)
		);
		$this->load->view("layouts/header");
		$this->load->view("vistas/vehiculos/nuevo_detalle", $data);
		$this->load->view("layouts/footer");
	}


	public function getAreas(){
		$id_direccion = $this->input->post("id_dir");
		$id_secretaria = $this->input->post("id_sec");

		$dato = $this->Personas_Model->getAreas($id_direccion, $id_secretaria);

		?>
		<option value="0">Seleccionar:</option>
		<option value="1">SIN AREA</option>
		<?php
		foreach ($dato as $a) {
			?>
			<option value="<?php echo $a->id_area ?>"><?php echo $a->nombre_ar ?></option>
			<?php
		}

	}

	public function getVehiculosForEmitirTicket(){
		$id_secretaria = $this->input->post('id_secretaria');
		$vehi = array('veh' =>$this->Vehiculos_Model->getVehiculosforSecretaria($id_secretaria),);
		$this->load->view("vistas/ticket/modal-vehiculos",$vehi);
	}

	public function solicitarSaldo(){
			$this->load->view('layouts/header');
			$this->load->view('vistas/vehiculos/solicitarSaldo');
			$this->load->view('layouts/footer');
	}

	public function ingresarMaximoVehiculo(){
		$id_solicitud= $this->input->post("id_solicitud");
		$monto= $this->input->post("monto");
		$suma= $this->input->post("suma");
		$id_vehiculo= $this->input->post("id_vehiculo");
		$maximo_mensual= $this->input->post("maximo_mensual");
		$hoy=date("Y-m-d H:i:s");

		$solicitud = array(
			'saldo' => $suma,
			'fecha_confirmacion' => $hoy,
			'estado' => "Confirmado"
		);

		$movimientos_tope=array(
			'id_vehiculo' => $id_vehiculo,
			'fecha_movimiento' => $hoy,
			'id_usuario' => $this->session->userdata('id'),
			'nuevo_saldo' => $suma,
			'saldo_anterior' => $maximo_mensual,
		);

		$upatevehiculos = array(
			'maximo_mensual' => $suma
		);

		$this->Vehiculos_Model->confirmarSolicitudMaximo($solicitud, $id_solicitud, $upatevehiculos, $id_vehiculo, $movimientos_tope);
		echo "true";

	}

	public function solicitudesEmitidas(){
		$id_secretaria=$this->session->userdata("id_secretaria");

		$solicitudes = array(
			'solicitudes' => $this->Vehiculos_Model->SolicitudesPorSecretaria($id_secretaria)
		);

		$this->load->view("layouts/header");
		$this->load->view("vistas/vehiculos/solicitudesPorSecretaria", $solicitudes);
		$this->load->view("layouts/footer");

	}

	public function rechazarSolicitud($id_solicitud){
		$hoy=date("Y-m-d H:i:s");
		$rechazo=array(
			'fecha_confirmacion' => $hoy,
			'estado' => "Rechazado"
		);

		$this->Vehiculos_Model->rechazarSolicitud($rechazo, $id_solicitud);
		echo "true";
	}

	public function getVehiculosSolicitarSaldo(){
		$id_secretaria=$this->session->userdata("id_secretaria");
		$vehi = array('veh' =>$this->Vehiculos_Model->getVehiculosSolicitarSaldo($id_secretaria),);
		$this->load->view("vistas/ticket/modal-vehiculos",$vehi);

	}

	public function otorgarSaldoVehiculos($id_solicitud){
		$data = array('v' =>$this->Vehiculos_Model->getDatosSolicitud($id_solicitud),);
	
		$this->load->view("vistas/vehiculos/modal-saldo-vehiculos",$data);
	
	}

	public function listSolicitudes(){
		if($this->session->userdata("rol")!=1){
			redirect(base_url().'Login/logout');
		}
		$data=array(
			'soli'=> $this->Vehiculos_Model->listSolicitudes()
		);

		$this->load->view('layouts/header');
			$this->load->view('vistas/vehiculos/solicitudes_vehiculos', $data);
			$this->load->view('layouts/footer');
	}

	public function Solicitudes(){
		if($this->session->userdata("rol")!=1){
			redirect(base_url().'Login/logout');
		}
		$data=array(
			'solicitudes'=> $this->Vehiculos_Model->Solicitudes()
		);

			$this->load->view('layouts/header');
			$this->load->view('vistas/vehiculos/Solicitudes', $data);
			$this->load->view('layouts/footer');
	}

	public function confirmarSolicitud(){
		$id_vehiculo = $this->input->post("id_vehiculo");
		$motivo = $this->input->post("motivo");
		$hoy=date("Y-m-d H:i:s");

		$data=array(
			'id_vehiculo' => $id_vehiculo,
			'motivo' => $motivo,
			'fecha_solicitud' => $hoy,
			'estado' => "En espera"
		);

		
		$tieneSolicitud = $this->Vehiculos_Model->tieneSolicitud($id_vehiculo);
		if(isset($tieneSolicitud)){
			echo "tiene";
		}else{
			$this->Vehiculos_Model->confirmarSolicitud($data);
		echo "true";
		}
		
	}

	public function nuevadependencia(){
		$data = array(
			'dependencias' => $this->Vehiculos_Model->getDependencias()
		);
		$this->load->view("layouts/header");
		$this->load->view("vistas/vehiculos/nuevadependencia", $data);
		$this->load->view("layouts/footer");
	}

	public function crear_dependencia(){
		$dependencia = $this->input->post('dependencia');
		$data = array(
			'dependencia' => $dependencia
		);
		$this->Vehiculos_Model->insertDependencia($data);
		echo "true";
	}

	public function ver_vehiculos_dependencia(){
		$id_dependencia = $this->session->userdata('id_dependencia');
		$a = array(
			'vehiculos' => $this->Vehiculos_Model->getVehiculosDependencia($id_dependencia),
		);
		$this->load->view("layouts/header");
		$this->load->view("vistas/vehiculos/list", $a);
		$this->load->view("layouts/footer");
	}

	public function establecerMaximo(){
		$id_vehiculo = $this->input->post("id_vehiculo");

		$datos= array(
			'v' => $this->Vehiculos_Model->buscarDatosMaximo($id_vehiculo)
		);

		$this->load->view("vistas/vehiculos/modal-tope", $datos);
	}

	public function nuevoMaximo(){
		$id_vehiculo = $this->input->post("id_vehiculo");
		$nuevo_maximo= $this->input->post("nuevo_maximo");
		$maximo_actual= $this->input->post("maximo_actual");
		$hoy=date("Y-m-d H:i:s");

		$vehiculos=array(
			'maximo_mensual' => $nuevo_maximo
		);

		$movimientos_tope=array(
			'id_vehiculo' => $id_vehiculo,
			'fecha_movimiento' => $hoy,
			'id_usuario' => $this->session->userdata('id'),
			'nuevo_saldo' => $nuevo_maximo,
			'saldo_anterior' => $maximo_actual,
		);

		if($this->Vehiculos_Model->actualizarMaximoMensual($vehiculos, $movimientos_tope, $id_vehiculo)){
			echo true;
		}
	}

}
