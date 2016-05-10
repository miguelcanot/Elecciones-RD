<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Informacion extends MY_Controller {

	function index() {
		$dato['titulo'] = Texto::idioma('Inicio');
		$dato['baseUrl'] = base_url();
		$dato['mensaje'] = $this->texto->idioma("");
		$dato['menuS'] = "mInicio";
		$this->load->view(TEMADEFAULT.'inicio', $dato);
		//$this->load->view(TEMADEFAULT.'inicio', $dato);
	}


	function terminoYCondicion() {
		$dato['titulo'] = Texto::idioma('Terminos_Y_Condiciones');
		$dato['baseUrl'] = base_url();
		$dato['mensaje'] = $this->texto->idioma("", IDIOMA);
		$dato['vista'] = "informacion/terminoycondicion";
		$this->load->view(TEMADEFAULT.'general', $dato);
		
	}

	public function idioma($idioma = "es"){
		$this->session->set_userdata("sIdioma", $idioma);
		redirect();
		//$this->load->view(TEMADEFAULT.'general', $dato);
	}

	public function apiObtenerContenido() {
		//$this->authApi("objeto/consulta");
		$this->load->model("ModeloConfiguracion");
		$configuracion = $this->ModeloConfiguracion->obtenerInformacionGeneral();
		$this->load->model("ModeloTestimonio");
		$testimonio = $this->ModeloTestimonio->obtenerTestimonioActivo(true);
		$this->load->model("ModeloPropiedad");
		$estadistica = $this->ModeloPropiedad->obtenerEstadisticaPropiedad();
		$resultadoFeat = $this->ModeloPropiedad->obtenerPropiedadActivoJson(true, 10);
		$resultadoReciente = $this->ModeloPropiedad->obtenerPropiedadReciente(true);
		$this->load->model("ModeloPlan");
		$plan = $this->ModeloPlan->obtenerPlanActivoJson(true);
		$this->load->model("ModeloUsuario");
		$agente = $this->ModeloUsuario->obtenerAgenteActivo();
		$resultado = array("configuracion"=>$configuracion, "estadistica"=>$estadistica, "testimonio"=>$testimonio, "destacada"=>$resultadoFeat, "reciente"=>$resultadoReciente, "plan"=>$plan, "agente"=>$agente);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}

	public function apiSuscribir() {
		//$this->authApi("experiencia/registrar");
		$rModel = $this->validarForm("suscripcion");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$correo = $this->getPost("correo");
			$nombre = $this->getPost("nombre");
			if (Texto::validarCorreo($correo)) {
				$this->load->model("ModeloApp");
				if (!$this->ModeloApp->existeCorreoSuscriptor($correo)) {
					$suscriptor = array("nombre"=>$nombre, "correo"=>$correo, "fecha"=>date("Y/m/d H:i:s"), "estatus"=>"A");
					$this->ModeloApp->registrarSuscripcion($suscriptor);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
				} else {
					echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Mensaje_Suscripcion_Error")));
				}
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Mensaje_Suscripcion_Error_Correo")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	} 	
}
?>