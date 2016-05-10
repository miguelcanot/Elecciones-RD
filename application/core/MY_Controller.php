<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->session->unset_userdata("sIdioma");
		$idioma = ($this->session->userdata("sIdioma")) ? $this->session->userdata("sIdioma") : "es";
		$this->session->set_userdata("sIdioma", $idioma);
		@define("IDIOMA", $idioma);

		if (!$this->session->userdata("sConfiguracion")) {
			$this->load->model("ModeloConfiguracion");
			$configuracion = $this->ModeloConfiguracion->obtenerConfig();
			$this->session->set_userdata("sConfiguracion", $configuracion);
		} 

		
		$timezone = ($this->session->userdata("sTimezone")) ? $this->session->userdata("sTimezone") : "America/Santo_Domingo";
		date_default_timezone_set($timezone);
		//$datoUsuario = array("id" => 1, 'usuario' => Texto::idioma("MCanot", IDIOMA), "nombre" => Texto::idioma("Miguel", IDIOMA), "apellido" => Texto::idioma("Canot", IDIOMA), "idRol" => 1, "nombreRol" => "Adminstrador");
		//$this->session->set_userdata("sUsuario", $datoUsuario);
		//$this->session->unset_userdata("sUsuario");
	}

	public function auth($url = "") {
		if ($this->session->userdata("sUsuario")) {
			$this->load->model("ModeloObjeto");
			$usuarioSesion = $this->session->userdata("sUsuario");
			$idRol = Encryption::decode($usuarioSesion["idRol"]);
			if (!$this->ModeloObjeto->verificarPermiso($url, $idRol)) {
				header("Location: ".base_url());
				exit;
			}
		} else {
			header("Location: ".base_url());
			exit;
		}
	}

	public function authApi($url = "") {
		if ($this->session->userdata("sUsuario")) {
			$this->load->model("ModeloObjeto");
			$usuarioSesion = $this->session->userdata("sUsuario");
			$idRol = Encryption::decode($usuarioSesion["idRol"]);
			if (!$this->ModeloObjeto->verificarPermiso($url, $idRol)) {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Error-05"), "log"=>true));
				exit();
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-09"), "log"=>false));
			exit();
		}
	}
	
	public function usuarioLogueado($estado = false, $url = "") {
		if ($this->session->userdata("sUsuario") == $estado) {
			header("Location: ".base_url().$url);
			exit;
		}
	}

	public function validarForm($model = null) {
		//eliminar espacios con trim, controlar el máximo y mínimo de carácteres
		//que queremos permitir y sobretodo hacer uso de xss_clean para evitar 
		//problemas con los datos que nos puedan insertar los usuarios
		//$this->form_validation->set_rules('usuario', 'nombre de usuario', 'required|trim|min_length[2]|max_length[100]|xss_clean');
       // $this->form_validation->set_rules('contrasena', 'contrasena', 'required|trim|min_length[6]|max_length[100]|xss_clean');
 
        //personalizar mensajes para las reglas hemos puesto 
        //$this->form_validation->set_message('required', 'El %s es requerido');
        //$this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
        //$this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
 
 		//comprobar que se lleven a cabo las reglas escritas por nosotros
 		if ($this->form_validation->run($model)) {
 			return array("estatus"=>true, "mensaje"=>"");
 		} else {
 			return array("estatus"=>false, "mensaje"=>validation_errors());
 		}
	}
	
	public function usuarioPermiso($permiso = 0) {
		$usuario = $this->session->userdata("sUsuario");
		$permisoAceptado = false;
	
		if (is_array($permiso)) {
			foreach ($permiso as $idRol) {
				if (Encryption::decode($usuario["idRol"]) == $idRol) {
					$permisoAceptado = true;
					break;
				}
			}
		} else {
			if (Encryption::decode($usuario["idRol"]) != $permiso) {
				$permisoAceptado = true;
			}
		}
		if (!$permisoAceptado) {
			header("Location: ".base_url());
			exit;
		}
	}

	public function getPost($string = "") {
		$post = $this->input->post();
		return (isset($post[$string])) ? $post[$string] : null;
	}
}