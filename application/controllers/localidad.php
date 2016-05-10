<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Localidad extends MY_Controller {

	public function apiObtenerPais(){
		$this->load->model("ModeloPais");
		$resultado = $this->ModeloPais->obtenerPaises(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}

	public function apiObtenerCiudadPais($idPais = 0){
		$idPais = Encryption::decode($idPais);
		$this->load->model("ModeloCiudad");
		$resultado = $this->ModeloCiudad->obtenerCiudadIdPais($idPais, true, true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}

	public function obtenerProvinciaPais($idPais = 0){
		$idPais = ($idPais == 0) ? 185 : Encryption::decode($idPais);
		$this->load->model("ModeloProvincia");
		$resultado = $this->ModeloProvincia->obtenerProvinciaIdPais($idPais, true, true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}

	public function obtenerCiudadProvincia($idProvincia = 0){
		$idProvincia = Encryption::decode($idProvincia);
		$this->load->model("ModeloCiudad");
		$resultado = $this->ModeloCiudad->obtenerCiudadIdProvincia($idProvincia, true, true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}

	public function obtenerSectorCiudad($idCiudad = 0){
		$idCiudad = Encryption::decode($idCiudad);
		$this->load->model("ModeloSector");
		$resultado = $this->ModeloSector->obtenerSectorIdCiudad($idCiudad, true, true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
}
?>