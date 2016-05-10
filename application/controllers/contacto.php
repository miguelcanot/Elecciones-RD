<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class Contacto extends MY_Controller {
	public function index(){
		$this->auth("contacto");
		$dato['menuS'] = "mContacto";
		$dato['titulo'] = Texto::idioma('Contacto', IDIOMA);
		$dato['subTitulo'] = Texto::idioma('Administrar', IDIOMA);
		$dato['vista'] = 'contacto/administrar';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}

	public function contactar(){
		//$this->auth("contacto");
		$dato['menuS'] = "mContacto";
		$dato['titulo'] = Texto::idioma('Contactenos', IDIOMA);
		$dato['subTitulo'] = Texto::idioma('', IDIOMA);
		$dato['vista'] = 'contacto/contactar';
		$this->load->view(TEMADEFAULT.'generalc', $dato);
	}


	/**
	 * Api Contacto
	 */
	
	private $token = "d58n5y7q3Dus_BBkesxG2e_0g0FneXvo1Eg7L8-8TdQ";

	public function apiObtenerContacto() {
		$this->authApi("contacto/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $post["busqueda"];
				$limite = 10;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloContacto");
				$resultado = $this->ModeloContacto->obtenerContacto($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiEliminar() {
		$this->authApi("contacto/eliminar");
		$post = $this->input->post();
		$rModel = $this->validarForm("contactoEliminar");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idContacto = Encryption::decode($post["IDmensaje_contacto"]);
			if (is_numeric($idContacto)) {
				$this->load->model("ModeloContacto");
				if ($this->ModeloContacto->existeContactoEstatus($idContacto, "P")) {
					$contacto = array("IDmensaje_contacto"=>$idContacto, "estatus"=>"I");
					$this->ModeloContacto->eliminar($contacto);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Contacto_Eliminado")));
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

	function apiEnviarMensaje() {
		$post = $this->input->post();
		$rModel = $this->validarForm("contacto");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$fecha = date("Y/m/d H:i:s");
			$nombre = $post["nombre"];
			$correo = $post["correo"];
			$mensaje = $post["mensaje"];
			$telefono = $post["telefono"];
			$dato["nombre"] = $nombre;
			$dato["correo"] = $correo;
			$dato["mensaje"] = $mensaje;
			$dato["telefono"] = $telefono;
			$dato["fecha"] = $fecha;
			$this->load->model("ModeloUsuario");
			$this->ModeloUsuario->crearMensajeContacto(array("correo"=>$correo, "nombre"=>$nombre, "telefono"=>$telefono, "mensaje"=>$mensaje, "fecha"=>$fecha, "estatus"=>"P"));			
			$plantilla = $this->load->view('plantilla/notificacioncontacto', $dato, true);
			$this->load->library("EnviarCorreo");
			$this->load->model("ModeloConfiguracion");
			$configuracion = $this->ModeloConfiguracion->obtenerConfiguracion();
			$this->load->library("EnviarCorreo");
			$resultado = EnviarCorreo::enviarEmailComun($configuracion->email, Texto::idioma("Contacto"), $plantilla, $configuracion->empresa, $configuracion->email_envio, Encryption::decode($configuracion->clave), $configuracion->host, $configuracion->puerto);
			echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Mensaje_Enviado")));	
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}
}
?>