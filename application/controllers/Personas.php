<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personas extends CI_Controller {

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
		$this->load->model("Ticket_Model");
		
	}

	
	public function index(){
	
	}



	public function listapersonas(){

		$this->permisos = $this->backend_lib->control();
		$id_sec = $this->session->userdata('id_secretaria');
		$data["title"] = "Agregar personas"; 
		$this->load->model("Personas_Model");
		$ar = array(
			'per' =>$this->Personas_Model->getPersonas($id_sec),
			'sec' => $this->Personas_Model->getSecretarias(),
			'dir' => $this->Personas_Model->getDireccionesa(),
			'ar' => $this->Personas_Model->getAreasa()
		);
		$this->load->view("layouts/header");
		$this->load->view('vistas/personas/list', $ar); 
		$this->load->view("layouts/footer");
	}



	public function edit(){
		$id= $this->input->post("id");
		$nombre = $this->input->post("nombre");
		$dni = $this->input->post("dni");
		$legajo = $this->input->post("legajo");
		$secretaria=$this->input->post("id_sec");
		$direccion=$this->input->post("id_dir");
		$area=$this->input->post("id_area");
		$email=$this->input->post("email");

		$data = array(
			'nombre' => strtoupper($nombre),
			'dni' => $dni,
			'legajo' => $legajo,
			'mail' => $email,
		);

		$relacion= array(
			'id_sec' => $secretaria,
			'id_dir' => $direccion,
			'id_sub' => '1',
			'id_cor' => '1',
			'id_subco' => '1',
			'id_are' => $area,

		);


		$this->Personas_Model->updatePersonas($id, $data);
		$this->Personas_Model->updateRelaciones($id, $relacion);
		sleep(2);
		redirect(base_url()."personas");
	}

	public function getPersonas($id){
		$nombre = $this->Personas_Model->getPersonasid($id);
		echo $nombre;
	}

	function delete_single_user()  
{    
	$deshabilitar=array(
		'estado' => "0"
	);
 $this->Personas_Model->delete_single_user($_POST["user_id"], $deshabilitar);  
 echo 'true';  
} 

	function fetch_user(){  
		$this->load->model("Personas_Model"); 
		$id_sec=$this->session->userdata('id_secretaria');
		$fetch_data = $this->Personas_Model->make_datatables($id_sec);  
		$data = array();  
		foreach($fetch_data as $row)  
		{  
						
			
			$sub_array = array();  
			$sub_array[] = '<button type="submit" data-toggle="modal" name="verfoto" id="'.$row->id.'" value="'.$row->foto_persona.'" class="btn-sm btn-verfoto"><img src="'.base_url().'public/imagenes_personas/'.$row->foto_persona.'" class="img-thumbnail" style="width: 60px; height: 60px "/></button>';  
			$sub_array[] = $row->nombre; 
			$sub_array[] = $row->dni; 
			$sub_array[] = $row->legajo; 
			$sub_array[] = $row->vencimiento_licencia; 
			$sub_array[] = $row->telefono; 
			if($row->estado == 1){ 
			$sub_array[] = '<label style="font-style: italic; color: green;">Carga combustible</label>';
			}else if($row->estado == 2){
			$sub_array[] = '<label style="font-style: italic; color: orange;">Solo conducción</label>';
			}else{
			$sub_array[] = '<label style="font-style: italic; color: red;">Deshabilitado</label>';
			}
			 if ($this->session->userdata('rol') == 1) {
			$sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-sm update"><i class="glyphicon glyphicon-pencil"></i></button>';  
			$sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-sm delete"><i class="glyphicon glyphicon-trash"></i></button>';  
			$data[] = $sub_array; 
		}else{
			if ($this->session->userdata('rol') == 2 || $this->session->userdata('rol') == 3 || $this->session->userdata('rol') == 10) {
			$sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-sm update"><i class="glyphicon glyphicon-pencil"></i></button>';
			$sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-sm delete"><i class="glyphicon glyphicon-trash"></i></button>';
			$data[] = $sub_array; 
			 }else{
			$sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-sm update" disabled><i class="glyphicon glyphicon-pencil"></i></button>';  
			$sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-sm delete" disabled><i class="glyphicon glyphicon-trash"></i></button>';  
			$data[] = $sub_array; 
			}
		}

		 
		}
		$output = array(  
			"draw"                    =>     intval($_POST["draw"]),  
			"recordsTotal"          =>      $this->Personas_Model->get_all_data(),  
			"recordsFiltered"     =>     $this->Personas_Model->get_filtered_data(),  
			"data"                    =>     $data  
		);  

		echo json_encode($output);  
	}  
	function user_action($action){  

		if($action == "Agregar")  
		{  
			$imagen=$this->upload_image();
			if(isset($imagen)){
			$insert_data = array(  
				'nombre'          =>     strtoupper($this->input->post('nombre')),  
				'dni'               =>     $this->input->post("dni"), 
				'legajo'          =>     $this->input->post('legajo'),  
				'mail'          =>     $this->input->post('email'), 
				'telefono'          =>     $this->input->post('telefono'), 
				'estado'               =>     $this->input->post("estado"), 
				'vencimiento_licencia'               =>   "2000-01-01",
				'foto_persona'                    =>     $this->upload_image()  
			);  

			$maxid=$this->Personas_Model->getMaxId();
			$relacion= array(
				'id_sec' => $this->input->post('secretaria'),  
				'id_dir' => $this->input->post('direccion'),
				'id_sub' => '1',
				'id_cor' => '1',
				'id_subco' => '1',
				'id_are' => $this->input->post('area'),
				'id_per' => $maxid

			);


			$this->load->model('Personas_Model');  
			$this->Personas_Model->insert_crud($insert_data, $relacion);  
			echo "1";
		}else{
			echo "0";
		}
	
			  
		}  
		if($action == "Editar")  
		{  

			$imagen=$this->upload_image();
			if(isset($imagen)){

			$archivo = '';  
			if($_FILES["archivo"]["name"] != '')  
			{  
				$archivo = $this->upload_image();  
			}  
			else  
			{  
				$archivo = $this->input->post("hidden_archivo");  
			}  
			$updated_data = array(  
				'nombre'          =>     strtoupper($this->input->post('nombre')),  
				'dni'               =>     $this->input->post("dni"), 
				'legajo'          =>     $this->input->post('legajo'),  
				'mail'          =>     $this->input->post('email'),
				'telefono'          =>     $this->input->post('telefono'),   
				'estado'               =>     $this->input->post("estado"), 
				'foto_persona'                    =>     $archivo  
			);  

			$relacion_update= array(
				'id_sec' => $this->input->post('secretaria'),  
				'id_dir' => $this->input->post('direccion'),
				'id_sub' => '1',
				'id_cor' => '1',
				'id_subco' => '1',
				'id_are' => $this->input->post('area')

			);

		
			$this->load->model('Personas_Model');  
			$this->Personas_Model->update_crud($this->input->post("user_id"), $updated_data);
			$this->Personas_Model->update_relacion($this->input->post("user_id"), $relacion_update);   
				echo "1";
		}else{
			echo "0";
		} 
		}  
	}  
	function upload_image()  
	{  
		
	
		//print_r($_FILES);
		$this->load->library("upload");
		
		$archivo=$this->input->post("archivo");
	
		$config = array(
			"upload_path" => "./public/imagenes_personas/usuario",
			'allowed_types' => "jpg|png|jpeg",
			'maintain_ratio' => FALSE,
			'create_thumb' => TRUE
		);
		$variablefile= $_FILES;
		$info = array();
		
		
			$_FILES['archivo']['name'] = rand()."_".$variablefile['archivo']['name'];
			$_FILES['archivo']['type'] = $variablefile['archivo']['type'];
			$_FILES['archivo']['tmp_name'] = $variablefile['archivo']['tmp_name'];		
			$_FILES['archivo']['error'] = $variablefile['archivo']['error'];
			$_FILES['archivo']['size'] = $variablefile['archivo']['size'];
			$this->upload->initialize($config);
			if($this->upload->do_upload('archivo')==true){
				$data = array("upload_data" => $this->upload->data());
				
					
					$uploadedImage = $this->upload->data();
					$archivo=$uploadedImage['file_name'];
	
	
		//////////////////////////////////////
	
					# establecer limite de tiempo máx ejecutandose
	//set_time_limit(200);
	## CONFIGURACION #############################
	
	 $ancho_nuevo=640; 
	 $alto_nuevo=640; 
	 
	 # directorio
	 $path="./public/imagenes_personas/usuario";
	 $path2="./public/imagenes_personas/";
	 
	## FIN CONFIGURACION ############################# 
	
	$directorio=dir($path);
	 
	 $ruta1 = $path.'/'.$archivo;
	 $ruta2 = $path2.'/'.$archivo;
	 $ancho = $ancho_nuevo;
	 $alto =$alto_nuevo;
	 
	 $datos=getimagesize ($ruta1); 
	 
	 $ancho_orig = $datos[0]; # Anchura de la imagen original 
	 $alto_orig = $datos[1]; # Altura de la imagen original 
	 $tipo = $datos[2]; 
	 
	 if ($tipo==1){ # GIF 
	 if (function_exists("imagecreatefromgif")) 
	 $img = imagecreatefromgif($ruta1); 
	 else 
	 echo "No function GIF"; 
	 } 
	 else if ($tipo==2){ # JPG 
	 if (function_exists("imagecreatefromjpeg")) 
	 $img = imagecreatefromjpeg($ruta1); 
	 else 
	 echo "No function JPG"; 
	 } 
	 else if ($tipo==3){ # PNG 
	 if (function_exists("imagecreatefrompng")) 
	 $img = imagecreatefrompng($ruta1); 
	 else 
	 echo "No function PNG"; 
	 } 
	 
	 $ancho_dest=640; 
	 $alto_dest=640; 
	
	$img2=@imagecreatetruecolor($ancho_dest,$alto_dest) or $img2=imagecreate($ancho_dest,$alto_dest);
	@imagecopyresampled($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig) or imagecopyresized($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig);
	 
	 if ($tipo==1) // GIF 
	 if (function_exists("imagegif")) 
	 imagegif($img2, $ruta2); 
	 else 
	 echo "No GIF";
	if ($tipo==2) // JPG 
	 if (function_exists("imagejpeg")) 
	 imagejpeg($img2, $ruta2); 
	 else 
	 echo "No JPG";
	if ($tipo==3) // PNG 
	 if (function_exists("imagepng")) 
	 imagepng($img2, $ruta2); 
	 else 
	 echo "No PNG¡"; 
	 
	 
	 unlink($ruta1);
	
	 
	$directorio->close();
	
	
	//////////////////
	
				
	
					$info = array(
						"archivo" => $data['upload_data']['file_name'],
						"mensaje" => "Archivo subido y guardado"
					);
					
					return $archivo;
				}else{
					echo false;
				}
	
	
	}  


	function fetch_single_user()  
	{  
		$output = array();  
		$this->load->model("Personas_Model");  
		$data = $this->Personas_Model->fetch_single_user($_POST["user_id"]);  
		foreach($data as $row)  
		{  
			$output['nombre'] = $row->nombre;  
			$output['dni'] = $row->dni;  
			$output['legajo'] = $row->legajo;  
			$output['vencimiento_licencia'] = $row->vencimiento_licencia;
			$output['email'] = $row->mail; 
			$output['telefono'] = $row->telefono; 
			$output['secretaria'] = $row->id_sec;  
			$output['direccion'] = $row->id_dir;  
			$output['area'] = $row->id_are;   
			$output['estado'] = $row->estado;   

			if($row->foto_persona != '')  
			{  
				$output['archivo'] = '<img src="'.base_url().'public/imagenes_personas/'.$row->foto_persona.'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_archivo" value="'.$row->foto_persona.'" />';  
			}  
			else  
			{  
				$output['archivo'] = '<input type="hidden" name="hidden_archivo" value="" />';  
			}  
		}  

		echo json_encode($output);  
	}  


	public function getDirecciones(){
		$id_secretaria = $this->input->post("id_secretaria");
		$data = $this->Personas_Model->getDirecciones($id_secretaria);
		?>
		<option value="0">Seleccionar:</option>
		<OPTION value="1">SIN DIRECCION</OPTION>

		<?php
		foreach ($data as $d) {
			?>
			<option value="<?php echo $d->id_dir ?>"><?php echo $d->nombre ?></option>
			<?php
		}

	}

	public function historicoLicencias(){
		if($this->session->userdata("rol")!=1){
			redirect(base_url().'Login/logout');
		}
		$data=array(
			'historico' => $this->Personas_Model->getHistoricoLicencias()
		);
		$this->load->view("layouts/header");
		$this->load->view("vistas/personas/historicoLicencias", $data);
		$this->load->view("layouts/footer");
	}


	public function crear_usuario(){
		$username=$this->input->post("username");
		$id_rol=$this->input->post("rol");
		$dependencia=$this->input->post("dependencia");

		if (strpos($username, " ")){
			echo "false";
		}else{

			$data = array(
				'username' => $username,
				'password' => 0,
				'rol_id' => $id_rol,
				'id_dependencia' => $dependencia 
			);
			$this->Personas_Model->insertUsuario($data);
			echo "true";
		}

    


	
	}



	public function getAreas(){
		$id_direccion = $this->input->post("id_direccion");
		$id_secretaria = $this->input->post("id_secretaria");

		$dato = $this->Personas_Model->getAreas($id_direccion, $id_secretaria);

		?>
		<option value="0">Seleccionar:</option>
		<OPTION VALUE="1">SIN AREA</OPTION>

		<?php
		foreach ($dato as $a) {
			?>
			<option value="<?php echo $a->id_area ?>"><?php echo $a->nombre_ar ?></option>
			<?php
		}

	}


	public function enviarrecordatorio1($id_persona){
		$mail=$this->Ticket_Model->obtenerEmail($id_persona);
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
			$this->email->subject('Notificacion de licencia vencida');
			$this->email->message('<h2>Licencia vencida</h2>
				<hr>
				<br>
				Le informamos que su licencia de conducir se encuentra vencida, se le solicita renovarla lo antes posible y notificar a su secretaría una vez realizado el trámite para actualizar los datos. Si usted ya la renovó, informe a su secretaría, de lo contrario no podrá cargar combustible. Muchas gracias. Por favor no responda este correo.
				<br>
				<img src="'.base_url().'public/images/logo-muni.jpg" height="248" width="700">
				'
			);

			$this->email->send();
			redirect('Reportes/dashboard');

	}

	public function enviarrecordatorio2($id_persona){
		$mail=$this->Ticket_Model->obtenerEmail($id_persona);
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
			$this->email->subject('Notificacion de licencia proxima a vencer');
			$this->email->message('<h2>Licencia proxima a vencer</h2>
				<hr>
				<br>
				Le informamos su licencia de conducir se encuentra proxima a vencerse, se le solicita renovarla lo antes posible y notificar a su secretaría una vez realizado el trámite para actualizar los datos. Si usted ya la renovó, informe a su secretaría, de lo contrario no podrá cargar combustible. Muchas gracias. Por favor no responda este correo.
				<br>
				<img src="'.base_url().'public/images/logo-muni.jpg" height="248" width="700">
				'
			);

			$this->email->send();
			redirect('Reportes/dashboard');

	}

	public function actualizarLicencia(){
		$this->load->view("layouts/header");
		$this->load->view("vistas/personas/actualizarLicencia");
		$this->load->view("layouts/footer");
	}


	public function nuevousuario_modal(){
		$data = array(
			'roles' => $this->Personas_Model->getRoles(),
			'dependencias' => $this->Personas_Model->getDependencias()			
		);
		$this->load->view('vistas/personas/nuevousuario_modal', $data);	
	}

	public function getPersonasForEmitirTicket(){
		$id_secretaria = $this->input->post('id_secretaria');
		$personas = array('per' =>$this->Personas_Model->getPersonasforSecretaria($id_secretaria)
	);
		$this->load->view("vistas/ticket/modal-personas",$personas);
	}

	public function getPersonasForEmitirTicketDetalle(){
		$personas = array('per' =>$this->Personas_Model->getPersonasforSecretariaDetalle()
	);
		$this->load->view("vistas/ticket/modal-personasDetalle",$personas);
	}

	public function listausuarios(){
		$this->permisos = $this->backend_lib->control();
		$data = array(
			// 'per' =>$this->Personas_Model->getPersonas($id_sec),
			// 'sec' => $this->Personas_Model->getSecretarias(),
			'usu' =>$this->Personas_Model->getUsuariosyRolesySec()

		);
		//var_dump($ar);
		$this->load->view("layouts/header");
		$this->load->view("vistas/personas/listausuarios", $data);
		$this->load->view("layouts/footer");
	}

	public function getNombreUsuario($id){
		$usuario = $this->Personas_Model->getNombreUsuario($id);
		echo $usuario;
	}

	public function blanquearPass(){
		$pass = "0";
		$id = $this->input->post("id");
		$data = array(
			'password' => $pass
            //'rol_id' => '3' ,
		);
		if ($this->Personas_Model->blanquearPass($id, $data)){
			echo "true";
		}else{
			echo "false";
		}
	}

}
