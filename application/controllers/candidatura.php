<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Candidatura extends MY_Controller {
	public function index(){
		//$this->auth("candidatura");
		$dato['menuS'] = "mCandidatura";
		$dato['titulo'] = Texto::idioma('Candidatura');
		$dato['subTitulo'] = Texto::idioma('');
		$dato['vista'] = 'candidatura/buscar';
		$this->load->view(TEMADEFAULT.'generalc', $dato);
	}

	/**
	 * Api Candidatura
	 */

	public function apiObtenerCandidatura() {
		//$this->authApi("candidatura/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $this->getPost("busqueda");
				$limite = 100;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloCandidatura");
				$resultado = $this->ModeloCandidatura->obtenerCandidaturaActivo($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiObtenerCandidaturaActivo() {
		$this->authApi("candidatura/consulta");
		$this->load->model("ModeloCandidatura");
		$resultado = $this->ModeloCandidatura->obtenerCandidaturaActivoJson(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiObtenerCandidaturaJson($query = "", $filtro = "") {
		//$this->authApi("candidatura/consulta");
		$this->load->model("ModeloCandidatura");
		$query = str_replace("%20", " ", $query);
		$resultado = $this->ModeloCandidatura->obtenerCandidaturaActivoJson(true, true, $query, $filtro);
		echo json_encode($resultado);
	}
}
?>