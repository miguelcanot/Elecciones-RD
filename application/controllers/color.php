<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Color extends MY_Controller {
	public function index(){
		//$this->auth("color");
		$dato['menuS'] = "mColor";
		$dato['titulo'] = Texto::idioma('Color', IDIOMA);
		$dato['subTitulo'] = Texto::idioma('Administrar', IDIOMA);
		$dato['vista'] = 'color/administrar';
		$this->load->view("color/administrar");
	}

	/**
	 * Api Color
	 */
	
	private $token = "d58n5y7q3Dus_BBkesxG2e_0g0FneXvo1Eg7L8-8TdQ";

	public function apiObtenerColor() {
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
				$this->load->model("ModeloColor");
				$resultado = $this->ModeloColor->obtenerColorActivo($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiRegistrar() {
		$this->authApi("color/registrar");
		$rModel = $this->validarForm("color");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$this->load->model("ModeloColor");
			$fecha = date("Y/m/d H:i:s");
			$color = array("descripcion"=>$post["descripcion"], "estatus"=>"A");
			$idColor = $this->ModeloColor->registrar($color);
			echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Color_Registrado")));
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiModificar() {
		$this->authApi("color/modificar");
		$rModel = $this->validarForm("color");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idColor = (isset($post["IDcolor"])) ? Encryption::decode($post["IDcolor"]) : "Error";
			if (is_numeric($idColor)) {
				$this->load->model("ModeloColor");
				if ($this->ModeloColor->existeColorEstatus($idColor, "A")) {
					$color = array("IDcolor"=>$idColor, "descripcion"=>$post["descripcion"]);
					$this->ModeloColor->actualizar($color);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Color_Modificado")));
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
		$this->authApi("color/eliminar");
		$post = $this->input->post();
		$rModel = $this->validarForm("colorEliminar");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idColor = Encryption::decode($post["IDcolor"]);
			if (is_numeric($idColor)) {
				$this->load->model("ModeloColor");
				if ($this->ModeloColor->existeColorEstatus($idColor, "A")) {
					$color = array("IDcolor"=>$idColor, "estatus"=>"I");
					$this->ModeloColor->eliminar($color);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Color_Eliminado")));
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

	public function apiObtenerColorActivo() {
		$this->authApi("color/consulta");
		$this->load->model("ModeloColor");
		$resultado = $this->ModeloColor->obtenerColorActivoJson(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
}
?>