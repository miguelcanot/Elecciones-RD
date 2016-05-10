<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	class Configuracion extends MY_Controller {
		
		public function index() {
			$this->auth("configuracion");
			$dato['titulo'] = Texto::idioma('Configuracion', IDIOMA);
			$dato['vista'] = 'configuracion/administrar';
			$dato['menuS'] = "mAdmin";
			$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
		}

		/**
		 * Api Configuracion
		 */
		public function apiObtenerConfiguracion() {
			$this->authApi("configuracion/consulta");
			$this->load->model("ModeloConfiguracion");
			$resultado = $this->ModeloConfiguracion->obtenerConfiguracion();
			echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
		}


		public function apiActualizarConfiguracion() {
			$this->authApi("configuracion/modificar");
			$rModel = $this->validarForm("configuracion");
	 		if ($rModel["estatus"])
			{
				$post = $this->input->post();
				$this->load->model("ModeloConfiguracion");
				$configuracionTemp = $this->ModeloConfiguracion->obtenerConfiguracion();
				$clave = $post["clave"];
				$configuracion = array("IDconfiguracion"=>1, "empresa"=>$post["empresa"], "eslogan"=>$post["eslogan"], "direccion"=>$post["direccion"], "email"=>$post["email"], "telefono"=>$post["telefono"], "fax"=>$post["fax"], "email_envio"=>$post["email_envio"], "host"=>$post["host"], "puerto"=>$post["puerto"]);
				if ($configuracionTemp->clave != $clave) {
					$configuracion["clave"] = Encryption::encode($post["clave"]);
				}
				$this->ModeloConfiguracion->actualizar($configuracion);
				if (isset($_FILES["file"])) {
					$this->load->library("Subir");
					$resultado = Subir::imagen("file", "logo", IMAGE_UPLOAD, "", array("png"), 10000, 70, 310, 310, true);
					if ($resultado['estado']) {
						echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Configuracion_Modificada")));
					} else {
						echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Error_Imagen")));
					}
				} else {
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Configuracion_Modificada")));
				}
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
			}
		}

		public function apiCorreoPrueba() {
			$this->authApi("configuracion/consulta");
			$dato["fecha"] = date("Y/m/d H:i:s");
			$plantilla = $this->load->view('plantilla/correoprueba', $dato, true);
			$this->load->model("ModeloConfiguracion");
			$configuracion = $this->ModeloConfiguracion->obtenerConfiguracion();
			$this->load->library("EnviarCorreo");
			$resultado = EnviarCorreo::enviarEmailComun($configuracion->email, Texto::idioma("Correo_Prueba"), $plantilla, $configuracion->empresa, $configuracion->email_envio, Encryption::decode($configuracion->clave), $configuracion->host, $configuracion->puerto);
			echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Enviado")));
		}
		
		public function errorPagina() {
			$dato['titulo'] = Texto::idioma('404');
			$this->load->view(TEMADEFAULTADMIN.'paginaerror', $dato);
		}
	}
?>