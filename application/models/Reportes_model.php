<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_Model extends CI_Model {

	public function TicketsPorPersona(){
		$resultado=$this->db->query("SELECT p.nombre, t.id, t.nit, t.id_per, t.id_ve, t.id_user, SUM(t.importe_cargado) as importe_cargado, t.estado, t.fecha_emitido, t.fecha_rendido, s.nombre as nomb_sec FROM tickets t, personas p, relaciones r, secretarias s WHERE r.id_per=p.id AND r.id_sec=s.id AND t.id_per=p.id and (t.estado='Rendido' or t.estado='Cargado') GROUP BY t.id_per ORDER BY importe_cargado DESC");
		return $resultado->result();
	}

	public function TicketsPorPersonaSec($id_secretaria){
		$resultado=$this->db->query("SELECT p.nombre, t.id, t.nit, t.id_per, t.id_ve, t.id_user, SUM(t.importe_cargado) as importe_cargado, t.estado, t.fecha_emitido, t.fecha_rendido, s.nombre as nomb_sec FROM tickets t, personas p, relaciones r, secretarias s WHERE r.id_per=p.id AND r.id_sec=s.id AND t.id_per=p.id and (t.estado='Rendido' or t.estado='Cargado') AND s.id=r.id_sec and r.id_sec='$id_secretaria' GROUP BY t.id_per ORDER BY importe_cargado DESC");
		return $resultado->result();
	}

	public function TicketsPorVehiculo(){
		$resultado=$this->db->query("SELECT v.marca, v.modelo, v.dominio, v.tipo_vehiculo, t.id, t.nit, t.id_per, t.id_ve, t.id_user, SUM(t.importe_cargado) as importe_cargado, t.estado, t.fecha_emitido, t.fecha_rendido, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE t.id_ve=v.id and (t.estado='Rendido' or t.estado='Cargado') AND s.id=v.id_sec GROUP BY t.id_ve ORDER BY importe_cargado DESC");
		return $resultado->result();
	}

	public function porSecretaria(){
		$resultado=$this->db->query("SELECT SUM(t.importe_cargado) as total, s.nombre
		FROM tickets t, secretarias s, personas p, relaciones r
		WHERE t.id_per=p.id and p.id=r.id_per and r.id_sec=s.id and (t.estado='Cargado' or t.estado='Rendido') group by s.nombre order by total DESC");
		return $resultado->result();
	}

	public function GastadoPorSecretariaFecha($desde, $hasta){
		$resultado=$this->db->query("SELECT SUM(t.importe_cargado) as total, s.nombre FROM tickets t, secretarias s, personas p, relaciones r WHERE t.id_per=p.id and p.id=r.id_per and r.id_sec=s.id and ((t.estado='Rendido' and t.fecha_rendido BETWEEN '$desde%' and '$hasta%') or (t.estado='Cargado' and t.fecha_cargado BETWEEN '$desde%' and '$hasta%')) group by s.nombre order by total DESC");
		return $resultado->result();
	}

	public function TicketsPorVehiculoSec($id_secretaria){
		$resultado=$this->db->query("SELECT v.marca, v.modelo, v.dominio, v.tipo_vehiculo, t.id, t.nit, t.id_per, t.id_ve, t.id_user, SUM(t.importe_cargado) as importe_cargado, t.estado, t.fecha_emitido, t.fecha_rendido, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE t.id_ve=v.id and (t.estado='Rendido' or t.estado='Cargado') AND s.id=v.id_sec and v.id_sec='$id_secretaria' GROUP BY t.id_ve ORDER BY importe_cargado DESC");
		return $resultado->result();
	}

	public function GastadoPorVehiculoFechaSec($desde, $hasta, $id_secretaria){
		$resultado=$this->db->query("SELECT v.marca, v.modelo, v.tipo_vehiculo, v.dominio, t.id, t.nit, t.id_per, t.id_ve, t.id_user, SUM(t.importe_cargado) as importe_cargado, t.estado, t.fecha_emitido, t.fecha_rendido, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE t.id_ve=v.id and ((t.estado='Rendido' and t.fecha_rendido BETWEEN '$desde%' and '$hasta%') or (t.estado='Cargado' and t.fecha_cargado BETWEEN '$desde%' and '$hasta%')) AND s.id=v.id_sec and v.id_sec='$id_secretaria' GROUP BY t.id_ve ORDER BY importe_cargado DESC");
		return $resultado->result();
	}

	public function TicketsPorVehiculoLitros(){
		$resultado=$this->db->query("SELECT v.marca, v.modelo, v.dominio, t.id, t.nit, t.id_per, t.id_ve, t.id_user, SUM(t.cant_litros) as litros, t.tipo_comb, t.estado, t.fecha_emitido, t.fecha_rendido, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE t.id_ve=v.id and t.estado=('Rendido') AND s.id=v.id_sec GROUP BY t.id_ve ORDER BY litros DESC");
		return $resultado->result();
	}

	public function TicketsPorDev(){
		$resultado = $this->db->query("SELECT p.nombre, SUM(mt.devolucion) as SUMA FROM personas as p, movimientos_ticket as mt WHERE p.id = mt.id_per AND mt.tipo_movimiento = 'Devolucion de saldo' GROUP BY p.nombre ORDER BY suma DESC");
		return $resultado->result();
	}

	public function TicketsDevFecha($desde, $hasta){
		$resultado = $this->db->query("SELECT p.nombre, SUM(mt.devolucion) as SUMA FROM personas as p, movimientos_ticket as mt WHERE p.id = mt.id_per AND mt.tipo_movimiento = 'Devolucion de saldo' AND mt.fecha_movimiento in (select mt.fecha_movimiento from movimientos_ticket mt where mt.fecha_movimiento BETWEEN '$desde%' and '$hasta%') GROUP BY p.nombre ORDER BY suma DESC");
		return $resultado->result();
	}

	public function TicketsDevFechaSec($desde, $hasta, $id_secretaria){
		$resultado = $this->db->query("SELECT p.nombre, SUM(mt.devolucion) as SUMA FROM personas as p, movimientos_ticket as mt WHERE p.id = mt.id_per AND mt.tipo_movimiento = 'Devolucion de saldo' AND mt.id_secretaria = '$id_secretaria' AND mt.fecha_movimiento in (select mt.fecha_movimiento from movimientos_ticket mt where mt.fecha_movimiento BETWEEN '$desde%' and '$hasta%') GROUP BY p.nombre ORDER BY suma DESC");
		return $resultado->result();
	}
	
	public function TicketsPorTipoComb(){
		$resultado=$this->db->query("SELECT SUM(importe_cargado) AS total_cargado, tipo_comb, SUM(cant_litros) as total_litros FROM tickets WHERE tickets.estado=('Rendido') GROUP BY tipo_comb");
		return $resultado->result();
	}

	public function TicketsPorTipoCombFecha($desde, $hasta){
		$resultado = $this->db->query("SELECT SUM(importe_cargado) AS total_cargado, tipo_comb, SUM(cant_litros) as total_litros FROM tickets t WHERE t.estado=('Rendido') and t.fecha_rendido in (select t.fecha_rendido from tickets t where t.fecha_rendido BETWEEN '$desde%' and '$hasta%') GROUP BY tipo_comb");
	return $resultado->result();
	}

	public function TicketsPorTipoCombFechaySec($desde, $hasta, $id_secretaria){
		$resultado = $this->db->query("SELECT SUM(importe_cargado) AS total_cargado, tipo_comb, SUM(cant_litros) as total_litros, r.id_sec FROM tickets t, personas p, relaciones r WHERE r.id_per=p.id AND p.id=t.id_per AND t.estado=('Rendido') and r.id_sec='$id_secretaria' AND t.fecha_rendido in (select t.fecha_rendido from tickets t where t.fecha_rendido BETWEEN '$desde%' and '$hasta%') GROUP BY tipo_comb");
	return $resultado->result();
	}

	public function GastadoPorPersonaFecha($desde, $hasta){
		$resultado = $this->db->query("SELECT p.nombre, t.id, t.nit, t.id_per, t.id_ve, t.id_user, t.estado, t.fecha_emitido, t.fecha_rendido, SUM(importe_cargado) AS importe_cargado, s.nombre as nomb_sec FROM tickets t, personas p, relaciones r, secretarias s WHERE r.id_per=p.id AND r.id_sec=s.id AND t.id_per=p.id and ((t.estado='Rendido' and t.fecha_rendido BETWEEN '$desde%' and '$hasta%') or (t.estado='Cargado' and t.fecha_cargado BETWEEN '$desde%' and '$hasta%')) GROUP by t.id_per order by importe DESC");
	return $resultado->result();
	}

	public function GastadoPorPersonaFechaSec($desde, $hasta, $id_secretaria){
		$resultado = $this->db->query("SELECT p.nombre, t.id, t.nit, t.id_per, t.id_ve, t.id_user, t.estado, t.fecha_emitido, t.fecha_rendido, SUM(importe_cargado) AS importe_cargado, s.nombre as nomb_sec FROM tickets t, personas p, relaciones r, secretarias s WHERE r.id_per=p.id AND r.id_sec=s.id AND t.id_per=p.id and ((t.estado='Rendido' and t.fecha_rendido BETWEEN '$desde%' and '$hasta%') or (t.estado='Cargado' and t.fecha_cargado BETWEEN '$desde%' and '$hasta%')) AND s.id=r.id_sec and r.id_sec='$id_secretaria' GROUP by t.id_per order by importe DESC");
	return $resultado->result();
	}

	public function GastadoPorVehiculoFecha($desde, $hasta){
		$resultado = $this->db->query("SELECT v.marca, v.modelo, v.dominio, t.id, t.nit, v.tipo_vehiculo, t.importe, t.importe_cargado, t.id_per, t.id_ve, t.id_user, t.estado, t.fecha_emitido, t.fecha_rendido, SUM(importe_cargado) AS importe_cargado, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE v.id_sec=s.id AND t.id_ve=v.id and  ((t.estado='Rendido' and t.fecha_rendido BETWEEN '$desde%' and '$hasta%') or (t.estado='Cargado' and t.fecha_cargado BETWEEN '$desde%' and '$hasta%')) GROUP by t.id_ve order by importe_cargado DESC ");
		return $resultado->result();
	}

	public function GastadoPorVehiculoFechaTipo($desde, $hasta, $tipo_vehiculo){
		$resultado = $this->db->query("SELECT v.marca, v.modelo, v.dominio, t.id, t.nit, v.tipo_vehiculo, t.importe, t.importe_cargado, t.id_per, t.id_ve, t.id_user, t.estado, t.fecha_emitido, t.fecha_rendido, SUM(importe_cargado) AS importe_cargado, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE v.id_sec=s.id AND t.id_ve=v.id and  ((t.estado='Rendido' and t.fecha_rendido BETWEEN '$desde%' and '$hasta%') or (t.estado='Cargado' and t.fecha_cargado BETWEEN '$desde%' and '$hasta%')) and v.tipo_vehiculo='$tipo_vehiculo' GROUP by t.id_ve order by importe_cargado DESC ");
		return $resultado->result();
	}

	public function LitrosPorVehiculoFecha($desde, $hasta){
		$resultado = $this->db->query("SELECT v.marca, v.modelo, v.dominio, t.id, t.nit, t.id_per, t.id_ve, t.id_user, SUM(t.cant_litros) as litros, t.tipo_comb, t.estado, t.fecha_emitido, t.fecha_rendido, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE t.id_ve=v.id and t.estado=('Rendido') and t.fecha_rendido in (select t.fecha_rendido from tickets t where t.fecha_rendido BETWEEN '$desde%' and '$hasta%') AND s.id=v.id_sec GROUP BY t.id_ve ORDER BY litros DESC ");
		return $resultado->result();

	}

		public function LitrosPorVehiculoFechaySec($desde, $hasta, $id_secretaria){
		$resultado = $this->db->query("SELECT v.marca, v.modelo, v.dominio, t.id, t.nit, t.id_per, t.id_ve, t.id_user, SUM(t.cant_litros) as litros, t.tipo_comb, t.estado, t.fecha_emitido, t.fecha_rendido, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE t.id_ve=v.id and t.estado=('Rendido') AND v.id_sec='$id_secretaria' and t.fecha_rendido in (select t.fecha_rendido from tickets t where t.fecha_rendido BETWEEN '$desde%' and '$hasta%') AND s.id=v.id_sec GROUP BY t.id_ve ORDER BY litros DESC");
		return $resultado->result();
	}
	

	public function GastadoPorPersonaFechaySec($desde, $hasta, $id_secretaria){
		$resultado = $this->db->query("SELECT p.nombre, t.id, t.nit, t.id_per, t.id_ve, t.id_user, t.estado, t.fecha_emitido, t.fecha_rendido, SUM(importe_cargado) AS importe_cargado, s.nombre as nomb_sec FROM tickets t, personas p, relaciones r, secretarias s WHERE r.id_per=p.id AND r.id_sec=s.id AND t.id_per=p.id AND r.id_sec='$id_secretaria' and ((t.estado='Rendido' and t.fecha_rendido BETWEEN '$desde%' and '$hasta%') or (t.estado='Cargado' and t.fecha_cargado BETWEEN '$desde%' and '$hasta%')) GROUP by t.id_per order by importe DESC");
		return $resultado->result();
	}

	public function GastadoPorVehiculoFechaySec($desde, $hasta, $id_secretaria){
		$resultado = $this->db->query("SELECT v.marca, v.modelo, v.dominio, v.tipo_vehiculo, t.id, t.nit, t.importe, t.importe_cargado, t.id_per, t.id_ve, t.id_user, t.estado, t.fecha_emitido, t.fecha_rendido, SUM(importe_cargado) AS importe_cargado, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE t.id_ve=v.id AND v.id_sec='$id_secretaria' AND v.id_sec=s.id AND ((t.estado='Rendido' and t.fecha_rendido BETWEEN '$desde%' and '$hasta%') or (t.estado='Cargado' and t.fecha_cargado BETWEEN '$desde%' and '$hasta%')) GROUP by t.id_ve order by importe_cargado DESC");
		return $resultado->result();
	}

	public function GastadoPorVehiculoFechaySecTipo($desde, $hasta, $id_secretaria, $tipo_vehiculo){
		$resultado = $this->db->query("SELECT v.marca, v.modelo, v.dominio, v.tipo_vehiculo, t.id, t.nit, t.importe, t.importe_cargado, t.id_per, t.id_ve, t.id_user, t.estado, t.fecha_emitido, t.fecha_rendido, SUM(importe_cargado) AS importe_cargado, s.nombre as nomb_sec FROM tickets t, vehiculos v, secretarias s WHERE t.id_ve=v.id AND v.id_sec='$id_secretaria' AND v.id_sec=s.id AND ((t.estado='Rendido' and t.fecha_rendido BETWEEN '$desde%' and '$hasta%') or (t.estado='Cargado' and t.fecha_cargado BETWEEN '$desde%' and '$hasta%')) and v.tipo_vehiculo='$tipo_vehiculo' GROUP by t.id_ve order by importe_cargado DESC");
		return $resultado->result();
	}

	public function getSolicitudesVe(){
		$resultado=$this->db->query("SELECT COUNT(id_solicitud) as cant FROM `solicitud_vehiculos` where estado='En espera'");
		return $resultado->row("cant");
	}

	public function getSec($secretaria){
		$resultado=$this->db->query("Select nombre from secretarias where id='$secretaria'");
		return $resultado->row("nombre");
	}

	public function getSecLitrosenero($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-01-01%' and '$ano_filtro-01-31%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosfebrero($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-02-01%' and '$ano_filtro-02-28%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosmarzo($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-03-01%' and '$ano_filtro-03-31%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosabril($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-04-01%' and '$ano_filtro-04-30%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosmayo($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-05-01%' and '$ano_filtro-05-31%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosjunio($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-06-01%' and '$ano_filtro-06-30%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosjulio($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-07-01%' and '$ano_filtro-07-31%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosagosto($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-08-01%' and '$ano_filtro-08-31%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosseptiembre($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-09-01%' and '$ano_filtro-09-30%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosoctubre($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-10-01%' and '$ano_filtro-10-31%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosnoviembre($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-11-01%' and '$ano_filtro-11-30%') group by s.nombre");
		return $resultado->row();
	}
	public function getSecLitrosdiciembre($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, month(t.fecha_cargado) as mes  FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_cargado BETWEEN '$ano_filtro-12-01%' and '$ano_filtro-12-31%') group by s.nombre");
		return $resultado->row();
	}

	public function totalLitros($secretaria, $ano_filtro){
		$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros FROM tickets t, vehiculos v, secretarias s WHERE s.id='$secretaria' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_rendido BETWEEN '$ano_filtro-01-01%' and '$ano_filtro-12-31%')");
		return $resultado->row('litros');
	}

		// public function totalLitrosFecha($fechadesde, $fechahasta){
	// 	$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros FROM tickets t, vehiculos v, secretarias s WHERE v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_rendido BETWEEN '$fechadesde%' and '$fechahasta%')");
	// 	return $resultado->row('litros');
	// }

	public function getLitrosMes($dominio, $mes){
		$resultado = $this->db->query("SELECT SUM(t.cant_litros) as litros, v.dominio FROM tickets t, vehiculos v, secretarias s WHERE v.dominio='$dominio' and t.fecha_cargado like '%-$mes-%' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido'");
	return $resultado->row("litros");		
	}

	public function getTicketsMes($dominio, $mes){
		$resultado = $this->db->query("SELECT t.*, v.dominio, mt.*, p.nombre FROM tickets t, movimientos_ticket mt, vehiculos v, secretarias s, personas p WHERE p.id=t.id_per and v.dominio='$dominio' and mt.nit=t.nit and t.fecha_cargado like '%-$mes-%' and v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and mt.tipo_movimiento='Carga de ticket'");
	return $resultado->result();		
	}

	
	// public function getSecLitrosFecha($fechadesde, $fechahasta){
	// 	$resultado=$this->db->query("SELECT SUM(t.cant_litros) as litros, s.nombre FROM tickets t, vehiculos v, secretarias s WHERE v.id_sec=s.id and t.id_ve=v.id and t.estado='rendido' and (t.fecha_rendido BETWEEN '$fechadesde%' and '$fechahasta%') group by s.nombre");
	// 	return $resultado->result();
	// }



	public function buscarSecretaria($id_secretaria){
		$resultado=$this->db->query("SELECT id, nombre from secretarias where id='$id_secretaria'");
		return $resultado->row();
	}

	

	public function getVencimientoLicencias(){
		$r = $this->db->query("SELECT p.id, p.nombre, p.legajo, p.vencimiento_licencia as venc_lic, DATEDIFF(p.vencimiento_licencia, NOW()) as dif FROM personas as p WHERE estado = '1' or estado = '2'");
		return $r->result();
	}

	public function getVencimientoLicenciasByIdSec($id_sec){
		$r = $this->db->query("SELECT p.id, p.nombre, p.legajo, p.vencimiento_licencia as venc_lic, DATEDIFF(p.vencimiento_licencia, NOW()) as dif
		FROM personas as p, relaciones as r
		WHERE estado = '1' AND r.id_per = p.id AND r.id_sec = '$id_sec'
		ORDER BY DATEDIFF(p.vencimiento_licencia, NOW()) ASC");
		return $r->result();
	}

	public function cant_solis_for_secretario($id_sec){
		$r = $this->db->query("SELECT count(d.nombre) as cant_soli
		from solicitud_ticket as st, direcciones as d
		where st.estado = 'En espera de confirmacion' and st.id_secretaria = '$id_sec' and st.id_direccion = d.id and st.flag = '0'");
		return $r->row();
	}

	public function cant_solis_for_adminsec($id_sec){
		$r = $this->db->query("SELECT count(d.nombre) as cant_soli
		from solicitud_ticket as st, direcciones as d
		where st.estado = 'Emitida' and st.id_secretaria = '$id_sec' and st.id_direccion = d.id and st.flag = '0'");
		return $r->row();
	}

	public function cantidadPersonasByIdSec($id_sec){
		$r = $this->db->query("SELECT count(p.id) as cant 
		FROM personas as p, relaciones as r 
		WHERE p.id = r.id_per AND p.estado = '1' AND r.id_sec = '$id_sec'");
		return $r->row();
	}

	public function cant_tickets_emitidos_by_id_sec($id_sec){
		$r = $this->db->query("SELECT count(t.nit) as cant FROM tickets as t, personas as p, vehiculos as v, secretarias, relaciones WHERE t.id_per = p.id and t.id_ve = v.id and t.estado = 'Emitido' AND relaciones.id_per=p.id AND relaciones.id_sec=secretarias.id AND secretarias.id='$id_sec'");
		return $r->row();
	}

	public function cant_vehi_by_sec($id_sec){
		$r = $this->db->query("SELECT count(id) as cant from vehiculos where id_sec = '$id_sec' AND estado = '1'");
		return $r->row();
	}

	public function getPreciosCombustible(){
		$r = $this->db->query("SELECT * FROM precio_combustible where id_precio!=0");
		return $r->result();
	}

	public function actualizar_precio($data2, $p){
		if ($p == "precio1") {
			$this->db->where('combustible', 'Nafta');
			$this->db->update('precio_combustible', $data2);
		}else if($p == "precio2"){
			$this->db->where('combustible', 'Nafta premium');
			$this->db->update('precio_combustible', $data2);
		}else if($p == "precio3"){
			$this->db->where('combustible', 'Gasoil');
			$this->db->update('precio_combustible', $data2);
		}else if($p == "precio4"){
			$this->db->where('combustible', 'Gasoil premium');
			$this->db->update('precio_combustible', $data2);
		}else if($p == "precio5"){
			$this->db->where('combustible', 'GNC');
			$this->db->update('precio_combustible', $data2);
		}
	}

	public function insertar_precio_historico($data3){
		$this->db->insert('movimientos_precio_combustible', $data3);
	}
	public function getHistoricoCombustible($id_precio){
		$r = $this->db->query("SELECT pc.combustible, mv.precio_litro, mv.fecha_movimiento FROM movimientos_precio_combustible as mv, precio_combustible as pc WHERE mv.id_precio_combustible = $id_precio AND mv.id_precio_combustible = pc.id_precio ORDER BY mv.fecha_movimiento DESC");
		return $r->result();
	}

	public function contarRegistrosxcombustible($id_precio){
		$r = $this->db->query("SELECT COUNT(mv.id_movimiento) as cuenta FROM movimientos_precio_combustible as mv WHERE mv.id_precio_combustible = $id_precio");
		return $r->row('cuenta');
	}

	public function buscarExpedientesPorDir($expediente){
		$r = $this->db->query("SELECT  sum(t.importe_cargado) as importe_cargado, s.nombre as nombresec , d.nombre as nombredir FROM tickets t, secretarias s, direcciones d, vehiculos v where t.expediente = '$expediente'AND v.id_sec=s.id and t.id_ve=v.id and v.id_dir=d.id group by nombresec, nombredir");
		return $r->result();
	}

	public function buscarExpedientesPorSec($expediente){
		$r = $this->db->query("SELECT  sum(t.importe_cargado) as importe_cargado, s.nombre as nombresec FROM tickets t, secretarias s, vehiculos v where t.expediente = '$expediente'AND v.id_sec=s.id and t.id_ve=v.id group by nombresec");
		return $r->result();
	}

	public function totalExpediente($expediente){
		$r = $this->db->query("SELECT sum(importe_cargado) as total from tickets t where expediente = '$expediente'");
		return $r->row('total');
	}


	
	

}
