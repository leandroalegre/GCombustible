<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tarjeta extends CI_Controller {

	public function __construct() {
		parent::__construct(); 

		$this->load->model("Tarjeta_Model");
		$this->load->model("Vehiculos_Model");
	}

	public function insertTarjeta(){
		$id_tarjeta=$_GET["getrfid"];
		
		
			$ar = array(
				'id' => $id_tarjeta,
				'estado' => '0'
			);
			$this->Tarjeta_Model->insertPrueba($ar);
		
	}

	public function insertTarjetaAbm(){
		$id_tarjeta=$_GET["getrfid"];
		
		
			$ar = array(
				'id' => $id_tarjeta,
				'estado' => '0'
			);
			$this->Tarjeta_Model->insertPruebaAbm($ar);
		
	}

	// public function recibirTarjeta(){
	// 	$array = $this->Tarjeta_Model->getLastID();

	// 	if ($array == NULL) {
	// 		echo "no_tarjeta";
	// 	}else{
	// 		if ($this->Tarjeta_Model->ifExiste($array->id_tarjeta)) {
	// 			echo "existe";
	// 		}else{
	// 			echo $array->id_tarjeta."*".$array->id_row;
	// 		}
	// 	}
	// }

	public function leerTarjetaJS(){
		$array = $this->Tarjeta_Model->getLastIDAbm();
		if ($array == NULL) {
			echo "no_tarjeta2";
		}else{
			if ($this->Tarjeta_Model->ifExisteAbm($array->id_tarjeta)) {
				echo "existe";
			}else{
				echo $array->id_tarjeta."*".$array->id_row;
			}
		}
	}

	public function readCardEnPlaya(){
		$array = $this->Tarjeta_Model->getLastID();

		if ($array == NULL) {
			echo "false";
		}else{
			$id_vehi = $this->Vehiculos_Model->getIdByIdTarjeta($array->id_tarjeta);
			echo $id_vehi."*".$array->id_row;
		}

	}


	
	public function setearId($id){
		$this->Tarjeta_Model->setearId($id);
	}

	public function setearIdAbm($id){
		$this->Tarjeta_Model->setearIdAbm($id);
	}

	public function setearTodas(){
		$this->Tarjeta_Model->setearTodas();
	}

	public function setearTodasAbm(){
		$this->Tarjeta_Model->setearTodasAbm();
	}

}
