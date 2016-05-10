<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Recinto extends MY_Controller {
	public function index(){
		//$this->auth("candidatura");
		$dato['menuS'] = "mRecinto";
		$dato['titulo'] = Texto::idioma('Recintos');
		$dato['subTitulo'] = Texto::idioma('');
		$dato['vista'] = 'recinto/ver';
		$this->load->view(TEMADEFAULT.'generalc', $dato);
	}

	/**
	 * Api Recinto
	 */

	public function apiObtenerRecintoActivo() {
		//$this->authApi("candidatura/consulta");
		$this->load->model("ModeloRecinto");
		$resultado = $this->ModeloRecinto->obtenerRecintoActivo(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiRecintoMunicipio() {
		//$this->authApi("candidatura/consulta");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idMunicipio = (isset($post["ID"])) ? Encryption::decode($post["ID"]) : "Error";
			if (is_numeric($idMunicipio)) {
				$this->load->model("ModeloRecinto");
				$resultado = $this->ModeloRecinto->obtenerRecintoIdMunicipio($idMunicipio, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}
}
?>