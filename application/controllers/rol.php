<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Rol extends MY_Controller {
	public function index(){
		$this->auth("rol");
		$dato['menuS'] = "mRol";
		$dato['titulo'] = Texto::idioma('Rol', IDIOMA);
		$dato['subTitulo'] = Texto::idioma('Administrar', IDIOMA);
		$dato['vista'] = 'rol/administrar';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}

	/**
	 * Api Rol
	 */
	
	private $token = "d58n5y7q3Dus_BBkesxG2e_0g0FneXvo1Eg7L8-8TdQ";

	public function apiObtenerRol() {
		$this->authApi("rol/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $post["busqueda"];
				$limite = 10;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloRol");
				$resultado = $this->ModeloRol->obtenerRolActivo($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiRegistrar() {
		$this->authApi("rol/registrar");
		$rModel = $this->validarForm("rol");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$this->load->model("ModeloRol");
			$fecha = date("Y/m/d H:i:s");
			$rol = array("nombre"=>$post["nombre"], "descripcion"=>$post["descripcion"], "estatus"=>"A");
			$idRol = $this->ModeloRol->registrar($rol);
			if (isset($_FILES["file"])) {
				$codigoImg = Encryption::encodeCrc($idRol);
				$this->load->library("Subir");
				$resultado = Subir::imagen("file", "rol-{$codigoImg}", IMAGE_UPLOAD."rol/", "", array("jpeg", "jpg", "png", "gif"), 5000, 70, 310, 310, true);
				if ($resultado['estado']) {
					$imagen = $resultado["nombre"].".".$resultado["ext"];
					$rol = array("IDrol"=>$idRol, "imagen"=>$imagen);
					$this->ModeloRol->actualizar($rol);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Rol_Registrado")));
				} else {
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Error_Imagen")));
				}
			} else {
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Rol_Registrado")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiModificar() {
		$this->authApi("rol/modificar");
		$rModel = $this->validarForm("rol");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idRol = (isset($post["IDrol"])) ? Encryption::decode($post["IDrol"]) : "Error";
			if (is_numeric($idRol)) {
				$this->load->model("ModeloRol");
				if ($this->ModeloRol->existeRolEstatus($idRol, "A")) {
					$rol = array("IDrol"=>$idRol, "nombre"=>$post["nombre"], "descripcion"=>$post["descripcion"]);
					$this->ModeloRol->actualizar($rol);
					if (isset($_FILES["file"])) {
						$codigoImg = Encryption::encodeCrc($idRol);
						$this->load->library("Subir");
						$resultado = Subir::imagen("file", "rol-{$codigoImg}", IMAGE_UPLOAD."rol/", "", array("jpeg", "jpg", "png", "gif"), 5000, 70, 310, 310, true);
						if ($resultado['estado']) {
							$imagen = $resultado["nombre"].".".$resultado["ext"];
							$rol = array("IDrol"=>$idRol, "imagen"=>$imagen);
							$this->ModeloRol->actualizar($rol);
							echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Rol_Modificado")));
						} else {
							echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Error_Imagen")));
						}
					} else {
						echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Rol_Modificado")));
					}
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
		$this->authApi("rol/eliminar");
		$post = $this->input->post();
		$rModel = $this->validarForm("rolEliminar");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idRol = Encryption::decode($post["IDrol"]);
			if (is_numeric($idRol)) {
				$this->load->model("ModeloRol");
				if ($this->ModeloRol->existeRolEstatus($idRol, "A")) {
					$rol = array("IDrol"=>$idRol, "estatus"=>"I");
					$this->ModeloRol->eliminar($rol);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Rol_Eliminado")));
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

	public function apiObtenerRolActivo() {
		$this->authApi("rol/consulta");
		$this->load->model("ModeloRol");
		$resultado = $this->ModeloRol->obtenerRolActivoJson();
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}

	public function obtenerRolActivo() {
		$this->load->model("ModeloRol");
		$resultado = $this->ModeloRol->obtenerRolActivoJson();
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
}
?>