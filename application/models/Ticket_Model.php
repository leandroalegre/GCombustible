<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_Model extends CI_Model {


	public function getUltimoNumeroTicket(){
		$r = $this->db->query("SELECT MAX(t.nit) as num FROM tickets as t");
		return $r->row("num");
	}

	public function getCantTickets($id){
		$r = $this->db->query("SELECT saldo as num from direcciones where id = '$id'");
		return $r->row();
	}

	public function getCantTicketsSEC($id){
		$r = $this->db->query("SELECT saldo as num from secretarias where id = '$id'");
		return $r->row();
	}

	public function getCantTickets2($id){ //se usan las 2
		$r = $this->db->query("SELECT saldo as num from direcciones where id = '$id'");
		return $r->row("num");
	}

	public function ticketCargado($id_ticket, $array, $movimiento){
		$this->db->where('id', $id_ticket);
		if ($this->db->update('tickets', $array)) {
			$this->db->insert("movimientos_ticket", $movimiento);
			return true;
		}else{
			return false;
		}
		

	}

	public function cancelarTicket($data, $id_ticket){

		$this->db->where('id', $id_ticket);
		if ($this->db->update('tickets', $data)) {
			return true;
		}else{
			return false;
		}
		
	}

	public function buscarVehiculo($id_vehiculo){
		$resultado = $this->db->query("SELECT marca, modelo, dominio FROM vehiculos WHERE id='$id_vehiculo'");
	}

	public function obtenerEmail($id_persona){
		$resultado = $this->db->query("SELECT mail, nombre FROM `personas` WHERE id='$id_persona'");
		return $resultado->row();
	}

	public function obtenerVehiculo($id_vehiculo){
		$resultado = $this->db->query("SELECT marca, modelo, dominio FROM vehiculos WHERE id='$id_vehiculo'");
    return $resultado->row();
	}

	public function getCantTickets2SEC($id){ //se usan las 2
		$r = $this->db->query("SELECT saldo as num from secretarias where id = '$id'");
		return $r->row("num");
	}

public function getSecretariaRendir($id){
	$r=$this->db->query("SELECT relaciones.id_sec FROM `tickets`, personas, relaciones WHERE tickets.id='$id' and tickets.id_per=personas.id AND personas.id=relaciones.id_per");
		return $r->row("id_sec");
}

public function obtenerSaldo($id){
	$r=$this->db->query("SELECT saldo FROM `secretarias` WHERE id='$id'");
	return $r->row("saldo");
}
	public function getDatosTicket($id){
		$result=$this->db->query("SELECT * FROM tickets WHERE id='$id'");
		return $result->row();
	}

	public function insertNewTicket($a, $movimiento){
		if ($this->db->insert("tickets", $a)) {
			$this->db->insert("movimientos_ticket", $movimiento);
			return true;
		}else{
			return false;
		}
	}

	public function getPrecio($id_comb_cargado){
		$resultado=$this->db->query("SELECT precio_litro FROM `precio_combustible` where id_precio='$id_comb_cargado'");
		return $resultado->row("precio_litro");
	}

public function buscarTicketsPorVehiculo($id_vehiculo){
	$resultado = $this->db->query("SELECT t.id, t.nit, t.importe, t.estado, t.fecha_emitido, t.fecha_rendido, v.id as id_ve, t.tipo_comb, t.id_comb_cargado, pc.combustible, v.marca, v.modelo, v.dominio, p.id as id_per, p.nombre, p.dni,p.foto_persona as foto, t.estado FROM tickets t, vehiculos v, personas p, precio_combustible pc WHERE t.id_ve='$id_vehiculo' and t.id_ve=v.id AND t.id_per=p.id AND t.estado='Emitido' and pc.id_precio=t.id_comb_cargado");
	return $resultado->result();
}


	public function getSecretarias(){
		$r = $this->db->query("SELECT * FROM secretarias");
		return $r->result();
	}

	public function getMovimientosTickets(){
		$id_sec=$this->session->userdata('id_secretaria');
		if ($this->session->userdata('rol')==5) {
			$resultado= $this->db->query("SELECT mt.id, mt.nit, mt.tipo_movimiento, mt.fecha_movimiento, mt.importe, mt.devolucion, u.username, p.nombre, v.marca, v.modelo, v.dominio, r.id_sec FROM movimientos_ticket mt, usuarios u, personas p, vehiculos v, relaciones r WHERE mt.id_usuario=u.id and mt.id_per=p.id and mt.id_ve=v.id and r.id_per=p.id and r.id_sec='$id_sec'");
		return $resultado->result();
		}else{
			$resultado= $this->db->query("SELECT mt.id, mt.nit, mt.tipo_movimiento, mt.fecha_movimiento, mt.importe, mt.devolucion, u.username, p.nombre, v.marca, v.modelo, v.dominio
FROM movimientos_ticket mt, usuarios u, personas p, vehiculos v
WHERE mt.id_usuario=u.id and mt.id_per=p.id and mt.id_ve=v.id");
		return $resultado->result();
		}
		
	}

	public function guardarIMG($datos, $actualizacion, $id_persona, $historico){

		$resultado = $this->db->query("SELECT id_imagen FROM `imagenes_licencias` WHERE id_persona='$id_persona'");
		$existe = $resultado->row("id_imagen");

		$this->db->insert("historico_licencias", $historico);
		if($existe==null){
			$this->db->insert("imagenes_licencias", $datos);
		}else{
			$this->db->where("id_persona", $id_persona);
			$this->db->update("imagenes_licencias", $datos);
		}
		
		$this->db->where("id", $id_persona);
		$this->db->update("personas", $actualizacion);
	}

	public function buscarMovimientosTickets($nit){
		$resultado = $this->db->query("SELECT mt.*, t.importe_cargado FROM movimientos_ticket mt, tickets t WHERE t.nit=mt.nit and mt.nit='$nit'");
		return $resultado->result();
	}

	public function consultarMonto($id_vehiculo, $mesactual){
		$resultado = $this->db->query("select sum(CASE WHEN estado='Cargado' or estado='Rendido' or estado='cancelado' then importe_cargado else importe end) as monto FROM `tickets` where fecha_emitido like '2021-$mesactual-%' and id_ve='$id_vehiculo'");
		return $resultado->row("monto");
	}

	public function consultarMontoLitros($id_vehiculo, $mesactual){
		$resultado = $this->db->query("select sum(CASE WHEN estado='Cargado' or estado='Rendido' or estado='Emitido' then litros_emitidos else 0 end) as litros_emitidos FROM `tickets` where fecha_emitido like '2021-$mesactual-%' and id_ve='$id_vehiculo'");
		return $resultado->row("litros_emitidos");
	}

	public function consultarFlag($id_vehiculo){
		$resultado = $this->db->query("SELECT flag_litros from vehiculos where id='$id_vehiculo'");
		return $resultado->row("flag_litros");
	}

	public function consultarMaximo($id_vehiculo){
		$resultado = $this->db->query("select maximo_mensual from vehiculos where id='$id_vehiculo'");
		return $resultado->row("maximo_mensual");
	}

	public function consultarMaximoLitros($id_vehiculo){
		$resultado = $this->db->query("select maximo_mensual from vehiculos where id='$id_vehiculo'");
		return $resultado->row("maximo_mensual");
	}

	

	public function getMovimientosCargadoPorVehiculo($dominio, $id_sec){
		$resultado=$this->db->query("SELECT mt.id, mt.nit, mt.tipo_movimiento, mt.fecha_movimiento, mt.importe, mt.devolucion, u.username, p.nombre, v.marca, v.modelo, v.dominio
		FROM movimientos_ticket mt, usuarios u, personas p, vehiculos v
		WHERE mt.id_usuario=u.id and mt.id_per=p.id and v.id_sec='$id_sec' and mt.id_ve=v.id and v.dominio='$dominio' and (mt.tipo_movimiento='Carga de ticket')");
		return $resultado->result();
	}

	public function getMovimientosCargadoPorPersona($id_persona){
		$resultado=$this->db->query("SELECT mt.id, mt.nit, mt.tipo_movimiento, mt.fecha_movimiento, mt.importe, mt.devolucion, v.dominio, v.tipo_vehiculo, v.marca, v.modelo, t.importe_cargado FROM movimientos_ticket mt, personas p, vehiculos v, tickets t WHERE mt.id_per = '$id_persona' and t.nit=mt.nit and (mt.tipo_movimiento='Carga de ticket') and mt.id_ve=v.id GROUP BY mt.id ORDER BY mt.nit DESC");
		return $resultado->result();
	}


	public function buscarTotal($dominio, $id_sec){
		$resultado = $this->db->query("SELECT sum(mt.importe) as suma, sum(mt.devolucion) as devolucion FROM movimientos_ticket mt, vehiculos v WHERE mt.id_ve=v.id and v.dominio='$dominio' and v.id_sec='$id_sec' and tipo_movimiento='Carga de ticket'");
		return $resultado->row();
	}

	public function BuscarTipo($dominio){
		$resultado = $this->db->query("SELECT dominio, tipo_vehiculo FROM `vehiculos` WHERE dominio='$dominio'");
		return $resultado->row();
	}

	public function buscarTotalIdPer($id_persona){
		$resultado = $this->db->query("SELECT sum(mt.importe) as suma, sum(mt.devolucion) as devolucion FROM movimientos_ticket mt, personas p WHERE mt.id_per=p.id and p.id='$id_persona' and tipo_movimiento='Carga de ticket'");
		return $resultado->row();
	}

	public function consultarPrecios($tipo_comb){
		$resultado = $this->db->query("SELECT precio_litro FROM `precio_combustible` WHERE id_precio='$tipo_comb'");
		return $resultado->row("precio_litro");

	}

		public function getMovimientosSoli(){
		$resultado= $this->db->query("SELECT mt.tipo_movimiento, mt.fecha_movimiento, u.username, mt.importe, d.nombre as nom_dir, s.nombre as nom_sec FROM movimientos_ticket mt, usuarios u, direcciones d, secretarias s WHERE mt.id_usuario=u.id and mt.id_direccion=d.id and mt.id_secretaria=s.id");
		return $resultado->result();
	}

	
	public function insertRendido($id, $rendir, $movimiento){
		if ($this->db->WHERE('id', $id)) {
		$this->db->update('tickets', $rendir);
		$this->db->insert("movimientos_ticket", $movimiento);
		return true;
		};
		
	}

	public function listReintegro($id_sec){
		$resultado = $this->db->query("SELECT mt.id, mt.nit, mt.tipo_movimiento, mt.fecha_movimiento, u.username, mt.importe, mt.devolucion, p.nombre as nom_per, v.*, s.nombre as nom_sec FROM movimientos_ticket mt, usuarios u, personas p, vehiculos v, secretarias s WHERE mt.tipo_movimiento='Devolucion de saldo' AND u.id=mt.id_usuario AND mt.id_per=p.id AND mt.id_ve=v.id AND mt.id_secretaria=s.id AND mt.id_secretaria='$id_sec'");
		return $resultado->result();
	}

	public function listReintegroadmin(){
		$resultado = $this->db->query("SELECT mt.id, mt.nit, mt.tipo_movimiento, mt.fecha_movimiento, u.username, mt.importe, mt.devolucion, p.nombre as nom_per, v.*, s.nombre as nom_sec FROM movimientos_ticket mt, usuarios u, personas p, vehiculos v, secretarias s WHERE mt.tipo_movimiento='Devolucion de saldo' AND u.id=mt.id_usuario AND mt.id_per=p.id AND mt.id_ve=v.id AND mt.id_secretaria=s.id");
		return $resultado->result();
	}

	public function actualizarSaldo($actualizarSaldo, $getSecretaria, $movimientoSaldoSec){
		if ($this->db->WHERE('id', $getSecretaria)) {
			$this->db->update('secretarias', $actualizarSaldo);
$this->db->insert("movimientos_ticket", $movimientoSaldoSec);
		return true;
		};
		
	
	}

	public function getTickets(){
		$resultado = $this->db->query("SELECT pe.nombre, pe.legajo, pe.dni, ve.marca, ve.modelo, ve.dominio, ti.importe_cargado, ti.nit, ti.fecha_emitido, ti.id, ti.fecha_cargado
FROM tickets ti, personas pe, vehiculos ve
WHERE ti.id_per=pe.id and ti.id_ve=ve.id and ti.estado='Cargado' ORDER BY ti.nit DESC");
		return $resultado->result();
	}

	public function getTicketsEmitidos(){
		$r = $this->db->query("SELECT t.nit as num, p.nombre as per, v.dominio as ve, t.importe as imp, t.fecha_emitido as fecha, t.id as id, s.nombre as sec
			FROM tickets as t, personas as p, vehiculos as v, secretarias as s
			WHERE t.id_per = p.id and t.id_ve = v.id AND v.id_sec=s.id and t.estado = 'Emitido'");
		return $r->result();
	}

	public function getTicketsEmitidosPorSecretaria($id_secretaria){
		$r = $this->db->query("SELECT t.nit as num, p.nombre as per, v.dominio as ve, t.importe as imp, t.fecha_emitido as fecha, t.id as id, secretarias.nombre, secretarias.id as id_secretaria FROM tickets as t, personas as p, vehiculos as v, secretarias, relaciones WHERE t.id_per = p.id and t.id_ve = v.id and t.estado = 'Emitido' AND relaciones.id_per=p.id AND relaciones.id_sec=secretarias.id AND secretarias.id='$id_secretaria'");
		return $r->result();
	}

	public function listTicketsrendidos(){
	$query = $this->db->query("SELECT t.nit as num, p.nombre as per, v.dominio as ve, t.importe_cargado as imp, t.fecha_emitido as fecha, t.fecha_rendido as fecha_rendido, t.id as id, t.expediente, s.nombre as sec
FROM tickets as t, personas as p, vehiculos as v, secretarias s
WHERE t.id_per = p.id and t.id_ve = v.id and v.id_sec=s.id and t.estado= 'Rendido'");
		return $query->result();
	}

	public function listPorExpediente($expediente){
		$query= $this->db->query("SELECT t.nit as num, p.nombre as per, v.dominio as ve, v.marca, v.modelo, t.cant_litros, t.importe_cargado as imp, t.fecha_emitido as fecha, t.fecha_rendido as fecha_rendido, t.id as id, t.expediente FROM tickets as t, personas as p, vehiculos as v WHERE t.id_per = p.id and t.id_ve = v.id and t.estado= 'Rendido' AND t.expediente='$expediente'");
		return $query->result();
	}

	public function listFecha($expediente){
	$query= $this->db->query("SELECT MAX(tickets.fecha_rendido) as maxfecha, MIN(tickets.fecha_rendido) as minfecha FROM tickets WHERE expediente='$expediente'");
	return $query->row();
}

	public function getExpedientes(){
		$resultado = $this->db->query("SELECT DISTINCT expediente FROM tickets where (expediente !='') ");
		return $resultado->result();
	}

	public function getInfoTicketById($id){
		$r = $this->db->query("SELECT t.nit as num, t.id as id_ticket, p.nombre as per, p.legajo as legajo, p.dni as dni, v.dominio as ve, v.marca as marca, v.modelo as modelo, t.importe as imp, t.fecha_emitido as fecha_emitido, t.fecha_rendido as fecha_rendido, t.id as id, t.estado as estado
		FROM tickets as t, personas as p, vehiculos as v
		WHERE t.id_per = p.id and t.id_ve = v.id and t.id = '$id'");
		return $r->row();
	}

	public function getRendidosid($id){
		$r = $this->db->query("SELECT t.nit as num, p.nombre as per, p.legajo as legajo, p.dni as dni, v.dominio as ve, v.marca as marca, v.modelo as modelo, t.importe_cargado as imp, t.fecha_emitido as fecha_emitido, t.fecha_rendido as fecha_rendido, t.id as id, t.expediente, t.estado as estado
		FROM tickets as t, personas as p, vehiculos as v
		WHERE t.id_per = p.id and t.id_ve = v.id and t.id = '$id'");
		return $r->row();
	}

	public function descontarCantTicketRestantes($id, $a){
		$this->db->where("id", $id);
		$this->db->update("direcciones", $a);
	}

	public function descontarCantTicketRestantesSEC($id, $a){
		$this->db->where("id", $id);
		$this->db->update("secretarias", $a);
	}

	public function updateDir($id, $a){
		$this->db->where("id", $id);
		if ($this->db->update("direcciones", $a)) {
			return true;
		}else{
			return false;
		}
	}

	public function updateSec($id, $a){
		$this->db->where("id", $id);
		if ($this->db->update("secretarias", $a)) {
			return true;
		}else{
			return false;
		}
	}

	public function ifSolicitado($id){
		$r = $this->db->query("SELECT * FROM solicitud_ticket WHERE id_direccion = '$id' AND (estado = 'Emitida' or estado = 'En espera de confirmacion')");
		if ($r->num_rows() == 0) {
			return true;
		}else{
			return false;
		}
	}

	public function ifSolicitadoContaduria($id){
		$r = $this->db->query("SELECT * FROM solicitud_ticket WHERE id_secretaria = '$id' AND (estado = 'Emitida' or estado = 'En espera de confirmacion') AND flag = '1'");
		if ($r->num_rows() == 0) {
			return true;
		}else{
			return false;
		}
	}

	public function insertSolicitud($a, $movimiento){
		if ($this->db->insert("solicitud_ticket",$a) == true) {
			$this->db->insert("movimientos_ticket", $movimiento);
			return true;
		}else{
			return false;
		}
	}

	public function insertMovimiento($a){
		if ($this->db->insert("movimientos_ticket", $a)) {
			return true;
		}else{
			return false;
		}
	}

	public function getSolicitudesByIdSec($id){
		$r = $this->db->query("SELECT d.nombre as nombre, st.fecha_solicitud as fecha, st.id as id
		from solicitud_ticket as st, direcciones as d
		where st.estado = 'Emitida' and st.id_secretaria = '$id' and st.id_direccion = d.id and st.flag = '0'");
		return $r->result();
	}

	public function getSolicitudesForSecretarioByIdSec($id){
		$r = $this->db->query("SELECT d.nombre as nombre, st.fecha_ingreso_monto as fecha, st.id as id, st.id_direccion as id_dir, st.monto as monto
		from solicitud_ticket as st, direcciones as d
		where st.estado = 'En espera de confirmacion' and st.id_secretaria = '$id' and st.id_direccion = d.id and st.flag = '0'");
		return $r->result();
	}
	
	public function getSaldoByIdSecretaria($id){ 
		$r = $this->db->query("SELECT saldo as num from secretarias where id = '$id'");
		return $r->row();
	}

	public function getInfoSolicitudSecDirById($id){
		$r = $this->db->query("SELECT s.id as id_soli, d.id as id_dir, se.id as id_sec, d.nombre as nombre, d.saldo as saldo_actual_direccion, se.saldo as saldo_actual_secretaria
		FROM solicitud_ticket as s, direcciones as d, secretarias as se
		WHERE s.id_direccion = d.id and s.id_secretaria = se.id and s.id = '$id' and s.flag = '0'");
		return $r->row();
	}

	public function getInfoSolicitudContaduriaById($id){
		$r = $this->db->query("SELECT * FROM solicitud_ticket as s WHERE s.id = '$id'");
		return $r->row();
	}

	public function updateSolicitudSecDir($id, $a, $movimiento){
		$this->db->where("id", $id);
		if ($this->db->update("solicitud_ticket", $a)) {
			$this->db->insert("movimientos_ticket", $movimiento);
			return true;
		}else{
			return false;
		}
	}


	public function getSolicitudesForContaduria(){
		$r = $this->db->query("SELECT s.id as id, se.nombre as nombre, se.saldo as saldo_actual, se.id as id_sec, s.fecha_solicitud as fecha FROM solicitud_ticket as s, secretarias as se
		WHERE s.id_secretaria = se.id AND s.flag = '1' AND s.estado = 'Emitida'");
		return $r->result();
  }

	public function buscarSolicitud($id){
		$resultado = $this->db->query("SELECT st.* FROM solicitud_ticket st, direcciones d, secretarias s WHERE st.id='$id' and st.id_direccion=d.id and st.id_secretaria=s.id");
		return $resultado->row();
	}

	public function getDirConSaldoByIdSec($id_sec){
		$r = $this->db->query("SELECT DISTINCT d.nombre as nombre, d.saldo as saldo, d.id as id
		FROM organigrama as o, secretarias as s, direcciones as d
		WHERE o.id_sec = s.id AND o.id_dir = d.id AND s.id = '$id_sec' AND d.id != '1'");
		return $r->result();
	}

}
