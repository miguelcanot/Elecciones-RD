<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Municipio extends MY_Controller {
	public function index(){
		//$this->auth("candidatura");
		$dato['menuS'] = "mMunicipio";
		$dato['titulo'] = Texto::idioma('Municipio');
		$dato['subTitulo'] = Texto::idioma('');
		$dato['vista'] = 'candidatura/buscar';
		$this->load->view(TEMADEFAULT.'general', $dato);
	}

	/**
	 * Api Municipio
	 */

	public function apiObtenerMunicipioActivo() {
		//$this->authApi("candidatura/consulta");
		$this->load->model("ModeloMunicipio");
		$resultado = $this->ModeloMunicipio->obtenerMunicipioActivo(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiObtenerMunicipioJson($query = "", $filtro = "") {
		//$this->authApi("candidatura/consulta");
		$this->load->model("ModeloMunicipio");
		$query = str_replace("%20", " ", $query);
		$resultado = $this->ModeloMunicipio->obtenerMunicipioActivoJson(true, true, $query, $filtro);
		echo json_encode($resultado);
	}
}
?>