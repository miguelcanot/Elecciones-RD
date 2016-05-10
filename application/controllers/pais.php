<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Pais extends MY_Controller {
	/**
	 * Api Pais
	 */
	
	private $token = "d58n5y7q3Dus_BBkesxG2e_0g0FneXvo1Eg7L8-8TdQ";

	public function apiObtenerPaisCiudad() {
		$this->authApi("pais/consulta");
		$this->load->model("ModeloPais");
		$listaPais = $this->ModeloPais->obtenerPaises(true);
		$listaCiudad = $this->ModeloEquipo->obtenerCiudadUsado(true);
		$resultado = array("listaPais"=>$listaPais, "listaColor"=>$listaColor, "listaRed"=>$listaRed, "listaMarca"=>$listaMarca, "listaModelo"=>$listaModelo, "listaCiudad"=>$listaCiudad);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
}   
?>