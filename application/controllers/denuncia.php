<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Denuncia extends MY_Controller {
	public function index() {
		//$this->auth("denuncia");
		$dato['menuS'] = "mDenuncia";
		$dato['titulo'] = Texto::idioma('Denuncias');
		$dato['subTitulo'] = Texto::idioma('');
		$dato['vista'] = 'denuncia/registrar';
		$this->load->view(TEMADEFAULT.'general', $dato);
	}
	
	public function estadistica($tipo = "") {
		//$this->auth("denuncia");
		$dato['menuS'] = "mDenuncia";
		$dato['titulo'] = Texto::idioma('Estadisticas');
		$dato['subTitulo'] = Texto::idioma('');
		if ($tipo == "r") {
			$dato['vista'] = 'denuncia/estadisticar';	
		} else {
			$dato['vista'] = 'denuncia/estadistica';
		}
		
		$this->load->view(TEMADEFAULT.'clear', $dato);
	}
	
	public function administrar() {
		$this->auth("denuncia");
		$dato['menuS'] = "mDenuncia";
		$dato['titulo'] = Texto::idioma('Denuncias');
		$dato['subTitulo'] = Texto::idioma('');
		$dato['vista'] = 'denuncia/administrar';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}

	/**
	 * Api Recinto
	 */
	
	public function apiObtenerDenuncia() {
		$this->authApi("color/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $post["busqueda"];
				$limite = 10;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloDenuncia");
				$resultado = $this->ModeloDenuncia->obtenerDenuncia($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}
    
	public function apiObtenerDenunciaActivo() {
		//$this->authApi("denuncia/consulta");
		$this->load->model("ModeloRecinto");
		$resultado = $this->ModeloRecinto->obtenerRecintoActivo(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiObtenerTipoDenunciaActivo() {
		//$this->authApi("denuncia/consulta");
		$this->load->model("ModeloDenuncia");
		$resultado = $this->ModeloDenuncia->obtenerTipoDenunciaActivo(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiObtenerEstadisticaMunicipio() {
		//$this->authApi("denuncia/consulta");
		$this->load->model("ModeloDenuncia");
		$resultado = $this->ModeloDenuncia->obtenerDenunciaMunicipios(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiObtenerEstadisticaRecinto() {
		//$this->authApi("denuncia/consulta");
		$this->load->model("ModeloDenuncia");
		$resultado = $this->ModeloDenuncia->obtenerDenunciaRecinto(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiRegistrar() {
		//$this->authApi("denuncia/consulta");
		$rModel = $this->validarForm("denuncia");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
            $idRecinto = (isset($post["IDRecinto"])) ? Encryption::decode($post["IDRecinto"]) : "Error";
			if (is_numeric($idRecinto)) {
				$this->load->model("ModeloDenuncia");
				$ip = $_SERVER["REMOTE_ADDR"];
				$denunciante = $this->getPost("Denunciante");
				$mesa = $this->getPost("Mesa");
				$comentario = $this->getPost("Comentario");
				$denuncia = array("IDRecinto"=>$idRecinto, "estatus"=>"P", "Fecha"=>date("Y/m/d H:i:s"), "Ip"=>$ip, "Mesa"=>$mesa, "Denunciante"=>$denunciante, "Comentario"=>$comentario);
				$idDenuncia = $this->ModeloDenuncia->registrar($denuncia);
				if (isset($post["tipoDenuncia"])) {
					foreach ($post["tipoDenuncia"] as $key => $value) {
						$idTipoDenuncia = Encryption::decode($value);
						if (is_numeric($idTipoDenuncia)) {
							$denunciaDetalle = array("IDDenuncia"=>$idDenuncia, "IDTipoDenuncia"=>$idTipoDenuncia);
							$this->ModeloDenuncia->registrarDetalle($denunciaDetalle);
						}
					}
				}
				
				if (isset($_FILES["imagen"])) {
					$this->load->library("Subir");
					$codigoImg = Encryption::encodeCrc($idDenuncia);
					$this->load->library("Subir");
					$resultado = Subir::imagen("imagen", "{$codigoImg}", IMAGE_UPLOAD."denuncia/", "", array("jpeg", "jpg", "png", "gif"), 10000, 70, 100, 100, true);
					if ($resultado['estado']) {
						$imagen = $resultado["nombre"].".".$resultado["ext"];
						$denunciaTemp = array("IDDenuncia"=>$idDenuncia, "Imagen"=>$imagen);
						$this->ModeloDenuncia->actualizar($denunciaTemp);
					}
				}
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}
	
	public function apiEliminar() {
		$this->authApi("denuncia/eliminar");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
            $idDenuncia = (isset($post["ID"])) ? Encryption::decode($post["ID"]) : "Error";
			if (is_numeric($idDenuncia)) {
				$this->load->model("ModeloDenuncia");
				$denuncia = array("IDDenuncia"=>$idDenuncia, "estatus"=>"I");
				$this->ModeloDenuncia->eliminar($denuncia);
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Eliminacion")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}
	
	public function apiAprobar() {
		$this->authApi("denuncia/modificar");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
            $idDenuncia = (isset($post["ID"])) ? Encryption::decode($post["ID"]) : "Error";
			if (is_numeric($idDenuncia)) {
				$this->load->model("ModeloDenuncia");
				$denuncia = array("IDDenuncia"=>$idDenuncia, "estatus"=>"A");
				$this->ModeloDenuncia->actualizar($denuncia);
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}
	
	
	public function apiObtenerDetalle() {
		$this->authApi("denuncia/consulta");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
            $idDenuncia = (isset($post["ID"])) ? Encryption::decode($post["ID"]) : "Error";
			if (is_numeric($idDenuncia)) {
				$this->load->model("ModeloDenuncia");
				$resultado = $this->ModeloDenuncia->obtenerDenunciaDetalle($idDenuncia);
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