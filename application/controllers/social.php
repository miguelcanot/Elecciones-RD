<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Social extends MY_Controller {
	public function index(){
		$this->auth("social");
		$dato['menuS'] = "mSocial";
		$dato['titulo'] = Texto::idioma('Social', IDIOMA);
		$dato['subTitulo'] = Texto::idioma('Administrar', IDIOMA);
		$dato['vista'] = 'social/administrar';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}

	/**
	 * Api Social
	 */
	
	private $token = "d58n5y7q3Dus_BBkesxG2e_0g0FneXvo1Eg7L8-8TdQ";

	public function apiObtenerSocial() {
		$this->authApi("social/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $this->getPost("busqueda");
				$limite = 10;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloSocial");
				$resultado = $this->ModeloSocial->obtenerSocialActivo($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiRegistrar() {
		$this->authApi("social/registrar");
		$rModel = $this->validarForm("social");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$id = $this->getPost("id");
			$accessToken = Encryption::encode($this->getPost("access_token"));
			$accessTokenSecret = Encryption::encode($this->getPost("access_token_secret"));
			$idTipoCuenta = (isset($post["IDtipo_cuenta"])) ? Encryption::decode($post["IDtipo_cuenta"]) : "Error";
			if (is_numeric($idTipoCuenta)) {
				$this->load->model("ModeloSocial");
				$fecha = date("Y/m/d H:i:s");
				$social = array("IDtipo_cuenta"=>$idTipoCuenta, "id"=>$id, "access_token"=>$accessToken, "access_token_secret"=>$accessTokenSecret, "estatus"=>"A");
				$idSocial = $this->ModeloSocial->registrar($social);
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiModificar() {
		$this->authApi("social/modificar");
		$rModel = $this->validarForm("social");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$id = $this->getPost("id");
			$accessToken = Encryption::encode($this->getPost("access_token"));
			$accessTokenSecret = Encryption::encode($this->getPost("access_token_secret"));
			$idTipoCuenta = (isset($post["IDtipo_cuenta"])) ? Encryption::decode($post["IDtipo_cuenta"]) : "Error";
			$idSocial = (isset($post["IDsocial"])) ? Encryption::decode($post["IDsocial"]) : "Error";
			if (is_numeric($idSocial) && is_numeric($idTipoCuenta)) {
				$this->load->model("ModeloSocial");
				if ($this->ModeloSocial->existeSocialEstatus($idSocial, "A")) {
					$social = array("IDsocial"=>$idSocial, "IDtipo_cuenta"=>$idTipoCuenta, "id"=>$id, "access_token"=>$accessToken, "access_token_secret"=>$accessTokenSecret);
					$this->ModeloSocial->actualizar($social);
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
		$this->authApi("social/eliminar");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idSocial = Encryption::decode($post["ID"]);
			if (is_numeric($idSocial)) {
				$this->load->model("ModeloSocial");
				if ($this->ModeloSocial->existeSocialEstatus($idSocial, "A")) {
					$social = array("IDsocial"=>$idSocial, "estatus"=>"I");
					$this->ModeloSocial->eliminar($social);
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

	public function apiObtenerSocialActivo() {
		//$this->authApi("social/consulta");
		$this->load->model("ModeloSocial");
		$resultado = $this->ModeloSocial->obtenerSocialActivoJson(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
}
?>