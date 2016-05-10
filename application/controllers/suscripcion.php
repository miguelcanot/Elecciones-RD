<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Suscripcion extends MY_Controller {
	public function index(){
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(1));
		$dato['titulo'] = Texto::idioma('Administrar_Suscripcion', IDIOMA);
		$dato['subTitulo'] = Texto::idioma('', IDIOMA);
		$dato['baseUrl'] = base_url();
		$dato['vista'] = 'suscripcion/administrar';
		$dato['menuS'] = "mAdmin";
		$this->load->model("ModeloSuscripcion");
		$dato['listaSuscripcion'] = $this->ModeloSuscripcion->obtenerSuscripcion();
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}
	
	public function registrar(){
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(1));
		if ($this->input->post("txtCorreo")) {
			$nombre = $this->input->post('txtNombre');
			$correo = trim($this->input->post('txtCorreo'));
			$suscripcion =  new EntSuscripcion(0, $nombre, $correo, date("Y/m/d H:i:s"), "A");
			$this->load->model("ModeloSuscripcion");
			$this->ModeloSuscripcion->registrar($suscripcion);
			redirect('suscripcion/');
		} else {
			$dato['titulo'] = Texto::idioma('Registrar_Suscripcion', IDIOMA);
			$dato['baseUrl'] = base_url();
			$dato['menuS'] = "mAdmin";
			$dato['vista'] = 'suscripcion/registrar';
			$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
		}		
	}
	
	public function modificar($id = ""){
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(1));
		$dato['menuS'] = "mAdmin";
		$dato['idSuscripcion'] = $id;
		$dato['menuS'] = "mAdmin";
		if ($id != "") { 
			$id = Encryption::decode($id);
			$dato['titulo'] = Texto::idioma('Modificar_Suscripcion', IDIOMA);
			$dato['subTitulo'] = Texto::idioma('', IDIOMA);
			$this->load->model("ModeloSuscripcion");
			if($this->input->post('txtNombre') && $this->input->post('txtCorreo')){
				$idSuscripcion = Encryption::decode($this->input->post('txtIdSuscripcion'));
				$nombre = $this->input->post('txtNombre');
				$correo = trim($this->input->post('txtCorreo'));
				$suscripcion =  new EntSuscripcion($idSuscripcion, $nombre, $correo, "", "A");
				$this->load->model("ModeloSuscripcion");
				$this->ModeloSuscripcion->actualizar($suscripcion);
				redirect('suscripcion/');
			} else {
				$dato['vista'] = 'suscripcion/modificar';
				$dato['suscripcion'] = $this->ModeloSuscripcion->obtenerSuscripcionPorIdSuscripcion($id);
				if ($dato['suscripcion']->getIdSuscripcion() != '') {
					$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
				} else {
					redirect();		
				}
			}
		} else {
			redirect();
		}
	}
	
	public function suscribir($pie = false) {
		$this->load->model('ModeloSuscripcion');
		if ($pie) {
			$nombre = $this->input->post("txtNombreSuscripcion");
			$correo = $this->input->post("txtCorreoSuscripcion");
		} else {
			$nombre = "";
			$correo = $this->input->post("txtCorreo");
		}
		if (Texto::validarCorreo($correo)) {
			if (!$this->ModeloSuscripcion->existeCorreoSuscriptor($correo)) {
				$fecha = date("Y/m/d H:i:s");
				$suscripcion = new EntSuscripcion(0, $nombre, $correo, $fecha, "A");
				$this->ModeloSuscripcion->registrarSuscripcion($suscripcion);
				redirect("suscripcion/r/B");
			} else {
				redirect("suscripcion/r/E");
			}
		} else {
			redirect("suscripcion/r/EC");
		}
		
	}
	
	public function r($estatus = 'B'){
		$dato['titulo'] = Texto::idioma('Resultado', IDIOMA);
		$dato['subTitulo'] = Texto::idioma('', IDIOMA);
		$dato['vista'] = 'suscripcion/resultadosucripcion';
		$dato['menuS'] = "mAdmin";
		$dato['estatus'] = $estatus;
		$this->load->view(TEMADEFAULT.'general', $dato);
	}
	
	public function cambiarEstatus($id = "", $estatus = "N"){
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(1));
		if ($id != "") { 
			$id = Encryption::decode($id);
			$this->load->model("ModeloSuscripcion");
			$suscripcion = $this->ModeloSuscripcion->obtenerSuscripcionPorIdSuscripcion($id);
			if ($suscripcion->getIdSuscripcion() != '') {
				$estatus = ($estatus == "A") ? "I" : "A";
				$this->ModeloSuscripcion->cambiarEstatus($id, $estatus);
				redirect('suscripcion/');
			} else {
				redirect();		
			}
		} else {
			redirect();
		}
	}
	
}
?>