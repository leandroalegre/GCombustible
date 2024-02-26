<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculos_Model extends CI_Model {

	public function getVehiculo($id_vehiculo){
		$r = $this->db->query("SELECT * from vehiculos where id='$id_vehiculo'");
		return $r->result();
	}

	public function getVehiculos($id_secretaria){
		$r = $this->db->query("SELECT v.*, s.nombre from vehiculos v, secretarias s where id_sec='$id_secretaria' and v.id_sec=s.id");
		return $r->result();
	}

	public function getVehiculosPrint($id_secretaria){
		$r = $this->db->query("SELECT v.*, s.nombre from vehiculos v, secretarias s where id_sec='$id_secretaria' and v.id_sec=s.id and v.estado=1");
		return $r->result();
	}

	public function getSecretaria($id_sec){
		$r = $this->db->query("SELECT * from secretarias where id='$id_sec'");
		return $r->row('nombre');
	}

	public function getVehiculossinsec(){
		$r = $this->db->query("SELECT v.*, s.nombre from vehiculos v, secretarias s where v.id_sec=s.id");
		return $r->result();
	}

	public function getDetalles(){
		$resultado= $this->db->query("select t1.*, v.dominio, v.marca, v.modelo, d.dependencia, u.username, IF(t1.id_persona=0, 'SIN PERSONA', (select per.nombre from personas per where t1.id_persona=per.id)) as nombre from usuarios u, dependencias d, vehiculos v, detalle_vehiculo t1 join (select id_vehiculo, max(fecha_detalle) as latest from detalle_vehiculo GROUP by id_vehiculo) as t2 on t1.id_vehiculo=t2.id_vehiculo and t1.fecha_detalle=t2.latest where v.id=t1.id_vehiculo and t1.id_dependencia=d.id_dependencia and u.id=t1.id_usuario");
		return $resultado->result();
	}

	public function getDetallesbydependencia($id_dependencia){
		$resultado= $this->db->query("select t1.*, u.username, v.dominio, v.marca, v.modelo, d.dependencia,  IF(t1.id_persona=0, 'SIN PERSONA', (select per.nombre from personas per where t1.id_persona=per.id)) as nombre from dependencias d, usuarios u, vehiculos v, detalle_vehiculo t1 join (select id_vehiculo, max(fecha_detalle) as latest from detalle_vehiculo GROUP by id_vehiculo) as t2 on t1.id_vehiculo=t2.id_vehiculo and t1.fecha_detalle=t2.latest where v.id=t1.id_vehiculo and t1.id_dependencia=d.id_dependencia and t1.id_dependencia = $id_dependencia and u.id=t1.id_usuario");
		return $resultado->result();
	}

	public function getDetallesxsec($id_sec){
		$resultado= $this->db->query("select t1.*, v.dominio, v.marca, v.modelo, d.dependencia, u.username,  IF(t1.id_persona=0, 'SIN PERSONA', (select per.nombre from personas per where t1.id_persona=per.id)) as nombre from usuarios u, dependencias d, vehiculos v, detalle_vehiculo t1 join (select id_vehiculo, max(fecha_detalle) as latest from detalle_vehiculo GROUP by id_vehiculo) as t2 on t1.id_vehiculo=t2.id_vehiculo and t1.fecha_detalle=t2.latest where v.id=t1.id_vehiculo and t1.id_dependencia=d.id_dependencia and v.id_sec ='$id_sec' and u.id=t1.id_usuario");
		return $resultado->result();
	}

	public function getVehiculosforSecretaria($id_secretaria){
		$r = $this->db->query("SELECT * from vehiculos where id_sec='$id_secretaria' AND estado = '1'");
		return $r->result();
	 }

	 public function listSolicitudes(){
		$r = $this->db->query("SELECT sv.*, v.*, s.nombre FROM solicitud_vehiculos sv, vehiculos v, secretarias s where v.id=sv.id_vehiculo and v.id_sec=s.id and sv.estado='En espera'");
		return $r->result();
	 }

	 public function Solicitudes(){
		$r = $this->db->query("SELECT sv.*, v.*, s.nombre, sv.estado as estado_soli FROM solicitud_vehiculos sv, vehiculos v, secretarias s where v.id=sv.id_vehiculo and v.id_sec=s.id and (sv.estado='Rechazado' or sv.estado='Confirmado')");
		return $r->result();
	 }
	 
	 public function getVehiculosSolicitarSaldo($id_secretaria){
		$r = $this->db->query("SELECT * from vehiculos where id_sec='$id_secretaria' AND estado = '1' and (tipo_vehiculo='1' or flag_litros='1')");
		return $r->result();
	 }
	 
	 public function confirmarSolicitud($data){
		 $this->db->insert("solicitud_vehiculos", $data);
	 }

	 public function SolicitudesPorSecretaria($id_secretaria){
		$r = $this->db->query("SELECT sv.*, sv.estado as estado_soli, v.marca, v.modelo, v.dominio FROM solicitud_vehiculos sv, vehiculos v WHERE sv.id_vehiculo=v.id and v.id_sec='$id_secretaria'");
		return $r->result();
	 }

	 public function tieneSolicitud($id_vehiculo){
		 $resultado = $this->db->query("SELECT id_solicitud FROM `solicitud_vehiculos` WHERE id_vehiculo='$id_vehiculo' and estado='En espera'");
		 return $resultado->row("id_solicitud");
	 }

	public function insertVehiculo($a){
		if ($this->db->insert("vehiculos", $a)) {
			return true;
		}else{
			return false;
		}
	}

	public function buscarDatosMaximo($id_vehiculo){
		$resultado = $this->db->query("SELECT * FROM `vehiculos` where id='$id_vehiculo'");
		return $resultado->row();
	}

	public function actualizarMaximoMensual($vehiculos, $movimientos_tope, $id_vehiculo){
		$this->db->where('id', $id_vehiculo);
		$this->db->update('vehiculos', $vehiculos);
		$this->db->insert("movimiento_tope_vehiculos", $movimientos_tope);
		
	}

	public function insertar_detalleV($data){
		$this->db->insert("detalle_vehiculo", $data);
	}

	public function getDependencias(){
		$resultado = $this->db->query("Select * from dependencias");
		return $resultado->result();
	}

	public function getDetallePorV($id){
		$resultado = $this->db->query("SELECT dv.*, v.*, u.username, d.dependencia, IF(dv.id_persona=0, 'SIN PERSONA', (select per.nombre from personas per where dv.id_persona=per.id)) as nombre FROM detalle_vehiculo dv, usuarios u, vehiculos v, dependencias d WHERE v.id=dv.id_vehiculo and dv.id_dependencia=d.id_dependencia AND id_vehiculo='$id' and u.id=dv.id_usuario ORDER BY dv.fecha_detalle DESC");
		return $resultado->result();
	}

	public function getIdByIdTarjeta($id){
		$r = $this->db->query("SELECT id as id_v from vehiculos where id_tarjeta = '$id'");
		return $r->row("id_v");
	}

public function getIdSecretaria($id){
		$r = $this->db->query("SELECT v.id_sec FROM vehiculos v, secretarias s, direcciones d, areas a WHERE v.id = '$id' AND v.id_sec=s.id AND v.id_dir=d.id AND v.id_are=a.id");
		return $r->row("id_sec");
	}

	public function getIdDireccion($id_sec, $id){
		$r = $this->db->query("SELECT v.id_dir FROM vehiculos v, secretarias s, direcciones d, areas a WHERE v.id = '$id' AND v.id_sec='$id_sec' AND v.id_sec=s.id AND v.id_dir=d.id AND v.id_are=a.id");
		return $r->row("id_dir");
	}

	public function getAreasID($id_sec, $id_dir){
		$r=$this->db->query("SELECT o.*, d.nombre as nombre_dir, a.nombre as nombre_ar
FROM organigrama o, direcciones d, areas a
WHERE o.id_sec='$id_sec' and o.id_dir='$id_dir' and o.id_dir=d.id and o.id_area=a.id");
		return $r->result();

	}
	

	public function getV($id){
		$r = $this->db->query("SELECT v.id, v.num_llavero, v.marca, v.modelo, v.id_tarjeta, v.id_sec, v.id_dir, v.id_are, v.m3_gnc, v.dominio, s.nombre as nom_sec, d.nombre as nom_dir, a.nombre as nom_ar, v.tipo_vehiculo, tv.tipo FROM vehiculos v, secretarias s, direcciones d, areas a, tipo_vehiculo tv WHERE v.id = '$id' AND v.id_sec=s.id AND v.id_dir=d.id AND v.id_are=a.id and v.tipo_vehiculo=tv.id_tipo");
		return $r->row();
	}
	

	public function getDirecciones($id_sec){
		$r = $this->db->query("SELECT DISTINCT o.id_dir, o.id_sec, d.nombre
FROM organigrama o, direcciones d
WHERE o.id_sec='$id_sec' and o.id_dir=d.id");
		return $r->result();
	}

	public function updateVehiculo($id, $a){
		$this->db->where("id", $id);
		$this->db->update("vehiculos", $a);
		return true;
	}

	public function getDominio($id){
		$r = $this->db->query("SELECT dominio FROM vehiculos where id = '$id'");
		return $r->row("dominio");
	}

	public function delete($id, $a, $detalle){
		$this->db->where("id", $id);
		$this->db->update("vehiculos", $a);
$this->db->insert("detalle_vehiculo", $detalle);
		return true;
	}

	public function getDatosSolicitud($id_solicitud){
		$r = $this->db->query("SELECT sv.*, v.*, s.nombre FROM solicitud_vehiculos sv, vehiculos v, secretarias s where v.id=sv.id_vehiculo and v.id_sec=s.id and id_solicitud='$id_solicitud'");
		return $r->row();
	}

	public function confirmarSolicitudMaximo($solicitud, $id_solicitud, $upatevehiculos, $id_vehiculo, $movimientos_tope){
		$this->db->where("id_solicitud", $id_solicitud);
		$this->db->update("solicitud_vehiculos", $solicitud);

		$this->db->where("id", $id_vehiculo);
		$this->db->update("vehiculos", $upatevehiculos);

		$this->db->insert("movimiento_tope_vehiculos", $movimientos_tope);
	}

	public function rechazarSolicitud($rechazo, $id_solicitud){
		$this->db->where("id_solicitud", $id_solicitud);
		$this->db->update("solicitud_vehiculos", $rechazo);
	}

	public function insertDependencia($data){
		$this->db->insert('dependencias', $data);
	}

	public function getVehiculosDependencia($id_dependencia){
		$r = $this->db->query("SELECT vehiculos.*, secretarias.nombre FROM vehiculos, vehiculos_dependencia, secretarias WHERE vehiculos.id = vehiculos_dependencia.id_vehiculo and vehiculos_dependencia.id_dependencia = $id_dependencia and secretarias.id = vehiculos.id_sec");
		return $r->result();
	}

	public function insertUbicacionVehiculo($data){
		$this->db->insert('vehiculos_dependencia', $data);
	}

}
