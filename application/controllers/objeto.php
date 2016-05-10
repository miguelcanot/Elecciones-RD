<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Objeto extends MY_Controller {
	public function index(){
		$this->auth("objeto");
		$dato['menuS'] = "mObjeto";
		$dato['titulo'] = Texto::idioma('Objeto', IDIOMA);
		$dato['subTitulo'] = Texto::idioma('Administrar', IDIOMA);
		$dato['vista'] = 'objeto/administrar';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}

	/**
	 * Api Objeto
	 */
	
	private $token = "d58n5y7q3Dus_BBkesxG2e_0g0FneXvo1Eg7L8-8TdQ";

	public function apiObtenerContenido() {
		$this->authApi("objeto/consulta");
		$this->load->model("ModeloObjeto");
		$listaObjeto = $this->ModeloObjeto->obtenerObjetoActivoJson();
		$resultado = array("listaObjeto"=>$listaObjeto);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}
	
	public function apiObtenerObjeto() {
		$this->authApi("objeto/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $post["busqueda"];
				$limite = 10;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloObjeto");
				$resultado = $this->ModeloObjeto->obtenerObjetoActivo($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiRegistrar() {
		$this->authApi("objeto/registrar");
		$rModel = $this->validarForm("objeto");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idObjetoRelacionado = (isset($post["IDobjeto_relacionado"]) && $post["IDobjeto_relacionado"] != "") ? Encryption::decode($post["IDobjeto_relacionado"]) : "";
			if (is_numeric($idObjetoRelacionado) || $idObjetoRelacionado == "") {
				$this->load->model("ModeloObjeto");
				if ($idObjetoRelacionado == "") {
					$objeto = array("nombre_logico"=>$post["nombre_logico"], "nombre_fisico"=>$post["nombre_fisico"], "tipo_objeto"=>$post["tipo_objeto"], "estatus"=>"A");
				} else {
					$objeto = array("nombre_logico"=>$post["nombre_logico"], "nombre_fisico"=>$post["nombre_fisico"], "IDobjeto_relacionado"=>$idObjetoRelacionado, "tipo_objeto"=>$post["tipo_objeto"], "estatus"=>"A");
				}
				$idObjeto = $this->ModeloObjeto->registrar($objeto);
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Objeto_Registrado")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiModificar() {
		$this->authApi("objeto/modificar");
		$rModel = $this->validarForm("objeto");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idObjeto = (isset($post["IDobjeto"])) ? Encryption::decode($post["IDobjeto"]) : "Error";
			$idObjetoRelacionado = (isset($post["IDobjeto_relacionado"])  && $post["IDobjeto_relacionado"] != "") ? Encryption::decode($post["IDobjeto_relacionado"]) : "";
			if (is_numeric($idObjeto) && (is_numeric($idObjetoRelacionado) || $idObjetoRelacionado == "")) {
				$this->load->model("ModeloObjeto");
				if ($this->ModeloObjeto->existeObjetoEstatus($idObjeto, "A")) {
					if ($idObjetoRelacionado == "") {
						$objeto = array("IDobjeto"=>$idObjeto, "nombre_logico"=>$post["nombre_logico"], "nombre_fisico"=>$post["nombre_fisico"], "tipo_objeto"=>$post["tipo_objeto"]);
					} else {
						$objeto = array("IDobjeto"=>$idObjeto, "nombre_logico"=>$post["nombre_logico"], "nombre_fisico"=>$post["nombre_fisico"], "IDobjeto_relacionado"=>$idObjetoRelacionado, "tipo_objeto"=>$post["tipo_objeto"]);
					}
					$this->ModeloObjeto->actualizar($objeto);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Objeto_Modificado")));
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
		$this->authApi("objeto/eliminar");
		$post = $this->input->post();
		$rModel = $this->validarForm("objetoEliminar");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idObjeto = Encryption::decode($post["IDobjeto"]);
			if (is_numeric($idObjeto)) {
				$this->load->model("ModeloObjeto");
				if ($this->ModeloObjeto->existeObjetoEstatus($idObjeto, "A")) {
					$objeto = array("IDobjeto"=>$idObjeto, "estatus"=>"I");
					$this->ModeloObjeto->eliminar($objeto);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Objeto_Eliminado")));
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

	public function apiObtenerObjetoSinAsignar() {
		$this->authApi("objeto/consulta");
		$post = $this->input->post();
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idRol = Encryption::decode($post["ID"]);
			if (is_numeric($idRol)) {
				$this->load->model("ModeloObjeto");
				$resultado = $this->ModeloObjeto->obtenerObjetoSinAsignarIdRol($idRol);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiObtenerObjetoAsignado() {
		$this->authApi("objeto/consulta");
		$post = $this->input->post();
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idRol = Encryption::decode($post["ID"]);
			if (is_numeric($idRol)) {
				$this->load->model("ModeloObjeto");
				$resultado = $this->ModeloObjeto->obtenerObjetoAsignadoIdRol($idRol);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiRegistrarPermiso() {
		$this->authApi("objeto/registrarpermiso");
		$rModel = $this->validarForm("rolObjeto");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idRol = Encryption::decode($post["IDrol"]);
			$idObjeto = Encryption::decode($post["IDobjeto"]);
			if (is_numeric($idRol) && is_numeric($idObjeto)) {
				$this->load->model("ModeloObjeto");
				$permiso = array("IDrol"=>$idRol, "IDobjeto"=>$idObjeto);
				$this->ModeloObjeto->registrarPermiso($permiso);
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Permiso_Registrado")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiEliminarPermiso() {
		$this->authApi("objeto/eliminarpermiso");
		$rModel = $this->validarForm("rolObjeto");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idRol = Encryption::decode($post["IDrol"]);
			$idObjeto = Encryption::decode($post["IDobjeto"]);
			if (is_numeric($idRol) && is_numeric($idObjeto)) {
				$this->load->model("ModeloObjeto");
				$permiso = array("IDrol"=>$idRol, "IDobjeto"=>$idObjeto);
				$this->ModeloObjeto->eliminarPermiso($permiso);
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Permiso_Eliminado")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	function obtenerListaPermisoMenu() {
		$this->authApi("objeto/permisomenu");
		$usuarioSesion = $this->session->userdata("sUsuario");
		$idRol = Encryption::decode($usuarioSesion["idRol"]);
		$idUsuario = Encryption::decode($usuarioSesion["id"]);
		$this->load->model("ModeloObjeto");
		$resultado = $this->ModeloObjeto->obtenerObjetoMenuPermiso($idUsuario, $idRol);
		echo json_encode(array("estatus"=>true, "mensaje"=>"", "resultado"=>$resultado));
	}

	function ObtenerListaPermisoBoton() {
		//$this->authApi("objeto/permisoboton");
		$usuarioSesion = $this->session->userdata("sUsuario");
		$idRol = Encryption::decode($usuarioSesion["idRol"]);
		$idUsuario = Encryption::decode($usuarioSesion["id"]);
		$post = $this->input->post();
		$pantalla = $this->getPost("pantalla");
		$this->load->model("ModeloObjeto");
		$resultado = $this->ModeloObjeto->obtenerListaPermisoBotonPantalla($idUsuario, $idRol, $pantalla);
		echo json_encode(array("estatus"=>true, "mensaje"=>"", "resultado"=>$resultado));
	}


}
?>