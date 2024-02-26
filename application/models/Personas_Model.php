<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Personas_Model extends CI_Model {

	var $table = "personas";  
	var $select_column = array("p.id", "p.nombre", "p.dni", "p.legajo", "p.mail", "p.telefono", "p.vencimiento_licencia", "p.estado", "p.foto_persona", "r.id as id_r", "r.id_sec", "r.id_dir", "r.id_sub", "r.id_cor", "r.id_subco", "r.id_are", "r.id_per", "s.nombre as nombresec", "s.id as id_secretaria");  
	var $order_column = array(null, "p.id", "p.nombre", "p.dni", "p.legajo", "p.mail", "p.telefono", "p.vencimiento_licencia", "p.estado", null, null);
	

///////////////////////////////////////////////////////////abm


	function make_query()  
	{  
		if ($this->session->userdata('rol') == 1 || $this->session->userdata('rol') == 8 || $this->session->userdata('rol') == 10) {
			$busqueda = $_POST["search"]["value"];
			$id_sec=$this->session->userdata('id_secretaria');
			$this->db->select($this->select_column);  
			$this->db->from('personas as p');
			$this->db->join('relaciones as r', 'p.id = r.id_per');
			$this->db->join('secretarias as s', 's.id = r.id_sec') ;
			
		

			if($busqueda != null)  
			{  
				
				$this->db->like("p.nombre", $busqueda);
				
				$this->db->or_like("p.legajo", $busqueda);
			
				$this->db->or_like("p.dni", $busqueda);
		
				$this->db->or_like("p.mail", $busqueda);
				
				// //$this->db->or_like("s.nombre", $_POST["search"]["value"]);

			}else{
				

			}

			if(isset($_POST["order"]))  
			{  
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
			}  
			else  
			{  
				$this->db->order_by('p.id', 'DESC');  
				
			}  
		}else{
			$busqueda = $_POST["search"]["value"];
			$id_sec=$this->session->userdata('id_secretaria');
			$this->db->select($this->select_column);  
			$this->db->from('personas as p');
			$this->db->join('relaciones as r', 'p.id = r.id_per');
			$this->db->join('secretarias as s', 's.id = r.id_sec');
			$this->db->where('p.estado', 1);
			

			if($busqueda != null)  
			{  
				
				$this->db->like("p.nombre", $busqueda);
				$this->db->where('r.id_sec', $id_sec);
				$this->db->where('p.estado', 1);
				$this->db->or_like("p.legajo", $busqueda);
				$this->db->where('r.id_sec', $id_sec);
				$this->db->where('p.estado', 1);
				$this->db->or_like("p.dni", $busqueda);
				$this->db->where('r.id_sec', $id_sec);
				$this->db->where('p.estado', 1);
				$this->db->or_like("p.mail", $busqueda);
				$this->db->where('r.id_sec', $id_sec);
				$this->db->where('p.estado', 1);
				// //$this->db->or_like("s.nombre", $_POST["search"]["value"]);

			}else{
				$this->db->where('r.id_sec', $id_sec);
			} 
			if(isset($_POST["order"]))  
			{  
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
			}  
			else  
			{  
				$this->db->order_by('p.estado', 'DESC');  
				
			}  
		}
	}  
	function make_datatables(){  
		
		$this->make_query();  
		if($_POST["length"] != -1)  
		{  
			$this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();  
	}  
	function get_filtered_data(){  
		$this->make_query();  
		$query = $this->db->get();  
		return $query->num_rows();  
	}       
	function get_all_data()  
	{  
		$this->db->select("*");  
		$this->db->from($this->table);  
		return $this->db->count_all_results();  
	}  
	function insert_crud($data, $relacion)  
	{  
		$this->db->insert('personas', $data); 
		$this->db->insert('relaciones', $relacion);
	}  

	
	function fetch_single_user($user_id)  
	{  
		$r=$this->db->query("SELECT p.id, p.nombre, p.vencimiento_licencia, p.foto_persona, p.mail, p.telefono, p.estado, p.dni, p.legajo, p.estado, s.nombre as nom_sec, d.nombre as nom_dir, a.nombre as nom_ar, r.id_sec, r.id_dir, r.id_are FROM personas as p, relaciones r, secretarias s, direcciones d, areas a WHERE r.id_per = '$user_id' AND p.id=r.id_per AND r.id_sec=s.id AND r.id_dir=d.id AND r.id_are=a.id");
		return $r->result(); 
	}  
	function update_crud($user_id, $data)  
	{  
		$this->db->where("id", $user_id);  
		$this->db->update("personas", $data);  
	} 

	function update_relacion($user_id, $data)  
	{  
		$this->db->where("id_per", $user_id);  
		$this->db->update("relaciones", $data);  
	} 

	


	function delete_single_user($user_id, $deshabilitar)  
	{  
		$this->db->where("id", $user_id);  
		$this->db->update("personas", $deshabilitar);  
           //DELETE FROM users WHERE id = '$user_id'  
	}  

	public function getDireccionesa(){
		$r = $this->db->query("SELECT * from direcciones");
		return $r->result();
	}
	public function getAreasa(){
		$r = $this->db->query("SELECT * from areas");
		return $r->result();
	}

public function getRoles(){
	$resultado=$this->db->query("SELECT * FROM roles");
	return $resultado->result();
}

public function getDependencias(){
	$resultado=$this->db->query("SELECT * FROM dependencias");
	return $resultado->result();
}

public function insertUsuario($data){
	$this->db->insert("usuarios", $data);
}


  /////////////////////////////////////////////////abm
	public function getPersonasEliminar($id){
		$r = $this->db->query("SELECT nombre FROM personas where id = '$id'");
		return $r->row("nombre");
	}

	public function delete($id, $a){
		$this->db->where("id", $id);
		$this->db->update("personas", $a);
		return true;
	}


	public function getIdDir($id_sec, $id){
		$r = $this->db->query("SELECT r.id_dir FROM relaciones r, secretarias s, direcciones d, areas a, personas p WHERE p.id='$id' AND r.id_sec='$id_sec' AND r.id_sec=s.id AND r.id_dir=d.id AND r.id_are=a.id AND r.id_per=p.id");
		return $r->row("id_dir");
	}


	public function getIdSecretariaEDIT($id){
		$r = $this->db->query("SELECT r.id_sec FROM relaciones r, secretarias s, direcciones d, areas a, personas p WHERE p.id='$id' AND r.id_sec=s.id AND r.id_dir=d.id AND r.id_are=a.id AND r.id_per=p.id");
		return $r->row("id_sec");
	}

	public function getIdDireccionEDIT($id_sec){
		$r = $this->db->query("SELECT DISTINCT o.id_dir as id_dire, o.id_sec, d.nombre
			FROM organigrama o, direcciones d
			WHERE o.id_sec='$id_sec' and o.id_dir=d.id");
		return $r->result();
	}

	public function getIdAreaEDIT($id_sec, $id_dir){
		$r = $this->db->query("SELECT DISTINCT o.id_area AS id_a, a.nombre
			FROM organigrama o, direcciones d, secretarias s, areas a
			WHERE o.id_sec='$id_sec' and o.id_dir='$id_dir' AND o.id_sec=s.id AND o.id_dir=d.id AND o.id_area=a.id");
		return $r->result();
	}

	public function getDirecciones($id_secretaria){
		$r=$this->db->query("SELECT DISTINCT o.id_dir, o.id_sec, d.nombre
			FROM organigrama o, direcciones d
			WHERE o.id_sec='$id_secretaria' and o.id_dir=d.id and d.id<>1");
		return $r->result();

	}

	public function getMaxID(){

		$result = $this->db->query("SELECT MAX(id+1) as maxid from personas");
		return $result->row('maxid');

	}
	public function getAreas($id_direccion, $id_secretaria){
		$r=$this->db->query("SELECT o.*, d.nombre as nombre_dir, a.nombre as nombre_ar
			FROM organigrama o, direcciones d, areas a
			WHERE o.id_sec='$id_secretaria' and o.id_dir='$id_direccion' and o.id_dir=d.id and o.id_area=a.id and a.id<>1");
		return $r->result();

	}

	public function getAreas2($id_sec, $id_dir){
		$r=$this->db->query("SELECT o.*, d.nombre as nombre_dir, a.nombre as nombre_ar
			FROM organigrama o, direcciones d, areas a
			WHERE o.id_sec='$id_sec' and o.id_dir='$id_dir' and o.id_dir=d.id and o.id_area=a.id");
		return $r->result();

	}

	public function getPersonas($id_sec){
		$r = $this->db->query("SELECT p.id, p.nombre, p.dni, p.legajo, p.estado from personas p, relaciones r where (p.estado = 1 or p.estado = 2) AND r.id_per=p.id AND r.id_sec='$id_sec' ORDER BY nombre asc");
		return $r->result();
	}

	public function getPersonasPrint($id_sec){
		$r = $this->db->query("SELECT p.id, p.nombre, p.dni, p.legajo, p.estado from personas p, relaciones r where (p.estado = 1 or p.estado = 2) AND r.id_per=p.id AND r.id_sec='$id_sec' ORDER BY nombre asc");
		return $r->result();
	}

	public function getPersonasforSecretaria($id_secretaria){
		$r = $this->db->query("SELECT p.nombre, p.id, p.dni, p.legajo, p.vencimiento_licencia, s.nombre as nom_sec, DATEDIFF(p.vencimiento_licencia, NOW()) as dif FROM relaciones r, personas p, secretarias s WHERE r.id_per=p.id and r.id_sec=s.id and r.id_sec='$id_secretaria' AND p.estado = 1");
		return $r->result();
	}

	public function getHistoricoLicencias(){
		$resultado = $this->db->query("SELECT hl.*, u.username, p.nombre, p.legajo FROM historico_licencias hl, usuarios u, personas p where hl.id_usuario=u.id and hl.id_persona=p.id");
		return $resultado->result();
	}

	public function getPersonasforSecretariaDetalle(){
		$r = $this->db->query("SELECT p.nombre, p.id, p.dni, p.foto_persona, p.legajo, s.nombre as nom_sec, DATEDIFF(p.vencimiento_licencia, NOW()) as dif FROM relaciones r, personas p, secretarias s WHERE r.id_per=p.id and r.id_sec=s.id AND (p.estado = 1 or p.estado=2)");
		return $r->result();
	}

	public function getSecretarias(){
		$r = $this->db->query("SELECT * from secretarias where nombre not like 'contaduria' AND nombre not like 'admin'");
		return $r->result();
	}
	public function getPersonasid($id){
		$r = $this->db->query("SELECT p.* FROM personas as p WHERE p.id = '$id'");
		return $r->row();
	}

	public function getPersonasidEDITAR($id){
		$r=$this->db->query("SELECT p.id, p.nombre, p.vencimiento_licencia, p.mail, p.dni, p.legajo, s.nombre as nom_sec, d.nombre as nom_dir, a.nombre as nom_ar, r.id_sec, r.id_dir, r.id_are FROM personas as p, relaciones r, secretarias s, direcciones d, areas a WHERE p.id = '$id' AND p.id=r.id_per AND r.id_sec=s.id AND r.id_dir=d.id AND r.id_are=a.id");
		return $r->row();
	}

	public function updatePersonas($id, $data){
		$this->db->where("id", $id);
		$this->db->update("personas", $data);
	}

	public function updateRelaciones($id, $relacion){
		$this->db->where("id_per", $id);
		$this->db->update("relaciones", $relacion);
	}

	public function insertPersona($persona, $relacion){
		if($this->db->insert("relaciones", $relacion)){
			$this->db->insert("personas", $persona);
			return true;
		}else{
			return false;
		}
		

		
	}

	public function getUsuariosyRolesySec(){
		$r = $this->db->query("SELECT usuarios.id AS id_usu, usuarios.id_per, usuarios.username, usuarios.password, usuarios.rol_id, personas.*, roles.*, relaciones.*, secretarias.id, secretarias.nombre AS nombresec, MAX(auditoria.fecha_hora) as Login FROM usuarios, personas, roles, relaciones, secretarias, auditoria WHERE personas.id = usuarios.id_per AND usuarios.rol_id = roles.id AND relaciones.id_sec = secretarias.id AND personas.id = relaciones.id_per AND usuarios.id = auditoria.id_usuario AND auditoria.motivo = 'Log in' GROUP BY personas.nombre");
		return $r->result();
	}

	public function getIdSecretariaByIdPersona($id){
		$r = $this->db->query("SELECT id_sec as id from relaciones where id_per = '$id'");
		return $r->row("id");
	}

	public function getIdDireccionByIdPersona($id){
		$r = $this->db->query("SELECT id_dir as id from relaciones where id_per = '$id'");
		return $r->row("id");
	}

	public function getNombreById($id){
		$r = $this->db->query("SELECT nombre as n from personas where id = '$id'");
		return $r->row("n");
	}

	public function getNombreSecretaria($id){
		$r = $this->db->query("SELECT nombre as n from secretarias where id = '$id'");
		return $r->row("n");
	}

	public function getNombreDir($id){
		$r = $this->db->query("SELECT nombre as n from direcciones where id = '$id'");
		return $r->row("n");
	}

	public function getNombreUsuario($id){
		$result = $this->db->query("SELECT personas.nombre as nombre, usuarios.* from personas, usuarios where personas.id = usuarios.id_per AND usuarios.id = '$id'");
		return $result->row("nombre");
	}

	public function blanquearPass($id, $data){
		$this->db->where("id",$id);
		return $this->db->update("usuarios",$data);
	}

	public function getUsername($username){
		$r = $this->db->query("SELECT username as user from usuarios where username = '$username'");
		return $r->row("user");
	}

	public function generar_contrasena($data, $username){
		$this->db->where("username", $username);
		$this->db->update("usuarios", $data);
		return true;
	}
	public function insertAuditoria($data){
		$this->db->insert('auditoria', $data);
	}
	public function getDependenciabyidpersona($id_persona){
		$r = $this->db->query("SELECT d.dependencia, u.id_dependencia from usuarios as u, dependencias as d where u.id_per = $id_persona AND d.id_dependencia = u.id_dependencia");
		return $r->row();
	}
}
