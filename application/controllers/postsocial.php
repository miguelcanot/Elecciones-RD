<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class PostSocial extends MY_Controller {
	public function index() {
		//$this->auth("postsocial");
		$dato['menuS'] = "mPostSocial";
		$dato['titulo'] = Texto::idioma('Post_Social');
		$dato['subTitulo'] = Texto::idioma('');
		$dato['vista'] = 'postsocial/listado';
		$this->load->view(TEMADEFAULT.'general', $dato);
	}
	
	public function administrar() {
		$this->auth("postsocial");
		$dato['menuS'] = "mPostSocial";
		$dato['titulo'] = Texto::idioma('Post_Social');
		$dato['subTitulo'] = Texto::idioma('Administrar');
		$dato['vista'] = 'postsocial/administrar';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}

	/**
	 * Api PostSocial
	 */

	public function apiObtenerPostSocial() {
		$this->authApi("postsocial/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $post["busqueda"];
				$limite = 10;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloPostSocial");
				$resultado = $this->ModeloPostSocial->obtenerPostSocial($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiRegistrarConfig() {
		$this->authApi("postsocial/registrar");
		$rModel = $this->validarForm("postSocialConfig");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$descripcion = $this->getPost("Descripcion");
			$tipo = $this->getPost("Tipo");
			$idTipoCuenta = 2;
			$estatus = "A";
			$this->load->model("ModeloPostSocial");
			$fecha = date("Y/m/d H:i:s");
			$postSocialConfig = array("Descripcion"=>$descripcion, "IDTipoCuenta"=>$idTipoCuenta, "Tipo"=>$tipo, "Estatus"=>$estatus);
			$idPostSocial = $this->ModeloPostSocial->registrarConfig($postSocialConfig);
			echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiAprobar() {
		$this->authApi("postsocial/modificar");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idPostSocial = (isset($post["ID"])) ? Encryption::decode($post["ID"]) : "Error";
			if (is_numeric($idPostSocial)) {
				$this->load->model("ModeloPostSocial");
				if ($this->ModeloPostSocial->existePostSocialEstatus($idPostSocial, "P")) {
					$postSocial = array("IDPostSocial"=>$idPostSocial, "Estatus"=>"A");
					$this->ModeloPostSocial->actualizar($postSocial);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
				} else {
					echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
				}
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiEliminar() {
		$this->authApi("postsocial/eliminar");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idPostSocial = Encryption::decode($post["ID"]);
			if (is_numeric($idPostSocial)) {
				$this->load->model("ModeloPostSocial");
				if ($this->ModeloPostSocial->existePostSocialEstatus($idPostSocial, "A")) {
					$postSocial = array("IDPostSocial"=>$idPostSocial, "estatus"=>"I");
					$this->ModeloPostSocial->eliminar($postSocial);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Eliminacion")));
				} else {
					echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
				}
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiObtenerPostSocialActivo() {
		$this->authApi("postsocial/consulta");
		$this->load->model("ModeloPostSocial");
		$resultado = $this->ModeloPostSocial->obtenerPostSocialActivoJson(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiObtenerConfig() {
		$this->authApi("postsocial/consulta");
		$this->load->model("ModeloPostSocial");
		$resultado = $this->ModeloPostSocial->obtenerPostSocialConfigActivo(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiEliminarConfig() {
		$this->authApi("postsocial/eliminar");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idPostSocialConfig = Encryption::decode($post["ID"]);
			if (is_numeric($idPostSocialConfig)) {
				$this->load->model("ModeloPostSocial");
				$postSocialConfig = array("IDPostSocialConfig"=>$idPostSocialConfig, "estatus"=>"I");
				$this->ModeloPostSocial->eliminarConfig($postSocialConfig);
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Eliminacion")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}
	
	private function apiObtenerConfig2() {
		$this->authApi("postsocial/consulta");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idPostSocial = Encryption::decode($post["ID"]);
			if (is_numeric($idPostSocial)) {
				$this->load->model("ModeloPostSocial");
				$resultado = $this->ModeloPostSocial->obtenerPostSocialConfigActivo($idPostSocial);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}
	
	public function apiObtenerPublicacion() {
		//$this->authApi("postsocial/consulta");
		$this->load->model("ModeloPostSocial");
		$resultado = $this->ModeloPostSocial->obtenerPostSocialActivoJson(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	
	public function apiObtenerPost() {
		//$this->authApi("postsocial/consulta");
		$this->load->model("ModeloPostSocial");
		$resultado = $this->ModeloPostSocial->obtenerPublicacionSocial();
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
}
?>