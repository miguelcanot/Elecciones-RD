<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
class Aplicacion extends MY_Controller {

	public function index() {
		$dato['titulo'] = Texto::idioma('App', IDIOMA);
		$dato['subTitulo'] = Texto::idioma('', IDIOMA);
		$dato['baseUrl'] = base_url();
		$dato['vista'] = 'aplicacion/listado';
		$dato['menuS'] = "mApp";
		$this->load->view(TEMADEFAULT.'generalc', $dato);
	}	

	function administrar() {
		//$this->usuarioLogueado();
		//$this->usuarioPermiso(array(2));
		$usuario = $this->session->userdata("sUsuario");
		$data['baseUrl'] = base_url();
		$data['titulo'] = "App";
		$data['vista'] = "aplicacion/administrar";
		$this->load->view(TEMADEFAULTADMIN."admin", $data);
	}
	
	public function registrar($mensaje = "") {
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(2));
		$usuario = $this->session->userdata("sUsuario");
		$app = new EntApp("", "", "", "", "", "", "", "", "");
		$dato['titulo'] = Texto::idioma('Registro_App', IDIOMA);
		$dato['vista'] = 'aplicacion/registrar';
		$dato['baseUrl'] = base_url();
		if ($this->input->post("txtNombre")) { 
			$this->load->model("ModeloAplicacion");
			$nombre = trim($this->input->post("txtNombre"));
			$descripcion = $this->input->post("txtDescripcion");
			$web = $this->input->post("txtWeb");
			$callbackUrl = $this->input->post("txtCallbackUrl");
			$fecha = date("Y/m/d H:i:s");
			$app = new EntApp(0, $usuario["id"], $nombre, $descripcion, $web, $callbackUrl, "", $fecha, "A");
			if ($this->ModeloAplicacion->existeAppPorNombre($nombre)) {
				$dato['vista'] = 'aplicacion/registrar';
				$dato['app'] = $app;
				$dato['mensaje'] = Texto::idioma("Nombre_No_Disponible");
				$this->load->view(TEMADEFAULT.'admin', $dato);
			} else {
				$idApp = $this->ModeloAplicacion->registrar($app);
				$token = $this->ModeloAplicacion->generarToken();
				$this->ModeloAplicacion->registrarAppToken(new EntAppToken(0, $idApp, $token['token'], $token['tokenSecreto'], $fecha));
				
				if (isset($_FILES["txtImagen"]) && $_FILES["txtImagen"]["tmp_name"] != "") {
					$codigoImg = Encryption::encodeCrc($idApp);
					$this->load->library("Subir");
					$resultado = Subir::imagen("txtImagen", "app-{$codigoImg}", IMAGE_UPLOAD."aplicacion/", "", array("jpeg", "jpg", "png", "gif"), 10000, 100, 72, 72);
					if ($resultado["estado"]) {
						$this->ModeloAplicacion->cambiarImagenApp($usuario["id"], $idApp, $resultado["nombre"].".".$resultado["ext"]);
						redirect('app');
					} else {
						$codigo = Encryption::encode($idApp);
						redirect("aplicacion/modificar/{$codigo}/error_imagen");
					}
				} else {
					redirect('app');
				}
			}
			
		} else {
			$dato['app'] = $app;
			$dato['mensaje'] = $mensaje;
			$this->load->view(TEMADEFAULT.'admin', $dato);
		}
	}
	
	public function modificar($idApp = 0, $mensaje = "") {
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(2));
		$idApp = Encryption::decode($idApp);
		$this->load->model("ModeloAplicacion");
		$usuario = $this->session->userdata("sUsuario");
		if (!$this->ModeloAplicacion->existeAppIdAppIdUsuario($idApp, $usuario["id"])) {
			redirect('app');
		} else {
			if ($this->input->post("txtNombre")) { 
				$idApp = Encryption::decode($this->input->post("txtIdApp"));
				$nombre = trim($this->input->post("txtNombre"));
				$descripcion = $this->input->post("txtDescripcion");
				$web = $this->input->post("txtWeb");
				$callbackUrl = $this->input->post("txtCallbackUrl");
				$fecha = date("Y/m/d H:i:s");
				$app = new EntApp($idApp, $usuario["id"], $nombre, $descripcion, $web, $callbackUrl, "", $fecha, "A");
				if ($this->ModeloAplicacion->existeAppPorNombreIdApp($nombre, $idApp)) {
					
				} else {
					$this->ModeloAplicacion->modificar($app);
					if (isset($_FILES["txtImagen"]) && $_FILES["txtImagen"]["tmp_name"] != "") {
						$codigoImg = Encryption::encodeCrc($idApp);
						$this->load->library("Subir");
						$resultado = Subir::imagen("txtImagen", "app-{$codigoImg}", IMAGE_UPLOAD."aplicacion/", "", array("jpeg", "jpg", "png", "gif"), 10000, 100, 72, 72, true);
						if ($resultado["estado"]) {
							$this->ModeloAplicacion->cambiarImagenApp($usuario["id"], $idApp, $resultado["nombre"].".".$resultado["ext"]);
							redirect('app');
						} else {
							$codigo = Encryption::encode($idApp);
							redirect("aplicacion/modificar/{$codigo}/error_imagen");
						}
					} else {
						redirect('app');
					}
				}
				
			} else {
				$dato['titulo'] = Texto::idioma('Modificar_App', IDIOMA);
				$dato['vista'] = 'aplicacion/modificar';
				$dato['baseUrl'] = base_url();
				$dato['mensaje'] = $mensaje;
				$dato['app'] = $this->ModeloAplicacion->obtenerAppIdUsuarioIdApp($usuario["id"], $idApp);
				$this->load->view(TEMADEFAULT."admin", $dato);
			}
		}
	}
	
	public function detalle($idApp = 0) {
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(2));
		$idApp = Encryption::decode($idApp);
		$this->load->model("ModeloAplicacion");
		$usuario = $this->session->userdata("sUsuario");
		$app = $this->ModeloAplicacion->obtenerAppIdUsuarioIdApp($usuario["id"], $idApp);
		if ($app->getIdApp() == "") {
			redirect('app');
		} else {
			$dato['titulo'] = Texto::idioma('Detalle_App', IDIOMA);
			$dato['vista'] = 'aplicacion/verdetalle';
			$dato['baseUrl'] = base_url();
			$dato['app'] = $app;
			$dato['appToken'] = $this->ModeloAplicacion->obtenerAppTokenIdApp($idApp);
			$this->load->view(TEMADEFAULT."admin", $dato);
		}
	}
	
	
	public function eliminarApp($id = "") {
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(2));
		if ($id != "") {
			$id = Encryption::decode($id);
			$this->load->model("ModeloAplicacion");
			$usuario = $this->session->userdata("sUsuario");
			$idUsuario = $usuario["id"];
			$app = $this->ModeloAplicacion->obtenerAppIdUsuarioIdApp($idUsuario, $id);
			if ($app->getIdApp() != '') {
				$this->ModeloAplicacion->cambiarEstatusApp($idUsuario, $id, "E");
				echo json_encode(array("estado"=>true, "mensaje"=>Texto::idioma("App_Eliminada")));
			} else {
				echo json_encode(array("estado"=>false, "mensaje"=>Texto::idioma("Error")));
			}
		} else {
			echo json_encode(array("estado"=>false, "mensaje"=>Texto::idioma("Error")));
		}
	}





	public function apiObtenerAplicacion() {
		$this->authApi("aplicacion/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $post["busqueda"];
				$limite = 10;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloAplicacion");
				$resultado = $this->ModeloAplicacion->obtenerAplicacion($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiObtenerAplicacionActiva() {
		//$this->authApi("aplicacion/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $post["busqueda"];
				$limite = 20;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloAplicacion");
				$resultado = $this->ModeloAplicacion->obtenerAplicacionActivo($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiObtenerDetalle() {
		//$this->authApi("aplicacion/consulta");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idAplicacion = (isset($post["ID"])) ? Encryption::decode($post["ID"]) : "Error";
			if (is_numeric($idAplicacion)) {
				$this->load->model("ModeloAplicacion");
				$resultado = $this->ModeloAplicacion->obtenerAplicacionDetalle($idAplicacion, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiRegistrarLike() {
		//$this->authApi("color/registrar");
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idAplicacion = (isset($post["ID"])) ? Encryption::decode($post["ID"]) : "Error";
			if (is_numeric($idAplicacion)) {
				$this->load->model("ModeloAplicacion");
				$ip = $_SERVER["REMOTE_ADDR"];
				$fecha = date("Y/m/d H:i:s");
				$appLike = array("IDapp"=>$idAplicacion, "fecha"=>$fecha, "ip"=>$ip);
				$this->ModeloAplicacion->registrarLike($appLike);
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiRegistrar() {
		$this->authApi("aplicacion/registrar");
		$rModel = $this->validarForm("aplicacion");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$this->load->model("ModeloAplicacion");
			$fecha = date("Y/m/d H:i:s");
			$aplicacion = array("nombre"=>$this->getPost("nombre"), "descripcion"=>$this->getPost("descripcion"), "web"=>$this->getPost("web"), "callback_url"=>$this->getPost("callback_url"), "fecha"=>$fecha, "estatus"=>"A");
			$idAplicacion = $this->ModeloAplicacion->registrar($aplicacion);
			if (isset($_FILES["img"])) {
				$this->load->library("Subir");
				$crop = array();
				$crop[] = array("x"=>"270", "y"=>"300", "pref"=>"review-");
				$crop[] = array("x"=>"120", "y"=>"120", "pref"=>"min-");
				$crop[] = array("x"=>"700", "y"=>"460", "pref"=>"block-");
				$crop[] = array("x"=>"1920", "y"=>"1100", "pref"=>"slide-");
				$file = $_FILES["img"];
				$codigoImg = Encryption::encodeCrc($idAplicacion);
				$resultado = Subir::imagenFile($file, "{$codigoImg}", IMAGE_UPLOAD."app/", "", array("jpeg", "jpg", "png", "gif"), 10000, 70, $crop, true);
				if ($resultado['estado']) {
					$nombreImagen = $resultado["nombre"].".".$resultado["ext"];
					$imagen = array("IDapp"=>$idAplicacion, "img"=>$nombreImagen);
					$this->ModeloAplicacion->actualizar($imagen);
				}
			}
			echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiModificar() {
		$this->authApi("aplicacion/modificar");
		$rModel = $this->validarForm("aplicacion");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idAplicacion = (isset($post["IDapp"])) ? Encryption::decode($post["IDapp"]) : "Error";
			if (is_numeric($idAplicacion)) {
				$this->load->model("ModeloAplicacion");
				if ($this->ModeloAplicacion->existeAplicacionEstatus($idAplicacion, "A")) {
					$aplicacion = array("IDapp"=>$idAplicacion, "nombre"=>$this->getPost("nombre"), "descripcion"=>$this->getPost("descripcion"), "web"=>$this->getPost("web"), "callback_url"=>$this->getPost("callback_url"));
					$this->ModeloAplicacion->actualizar($aplicacion);
					if (isset($_FILES["img"])) {
						$this->load->library("Subir");
						$crop = array();
						$crop[] = array("x"=>"270", "y"=>"300", "pref"=>"review-");
						$crop[] = array("x"=>"120", "y"=>"120", "pref"=>"min-");
						$crop[] = array("x"=>"700", "y"=>"460", "pref"=>"block-");
						$crop[] = array("x"=>"850", "y"=>"450", "pref"=>"post-");
						$crop[] = array("x"=>"1920", "y"=>"1100", "pref"=>"slide-");
						$file = $_FILES["img"];
						$codigoImg = Encryption::encodeCrc($idAplicacion);
						$resultado = Subir::imagenFile($file, "{$codigoImg}", IMAGE_UPLOAD."app/", "", array("jpeg", "jpg", "png", "gif"), 10000, 70, $crop, true);
						if ($resultado['estado']) {
							$nombreImagen = $resultado["nombre"].".".$resultado["ext"];
							$imagen = array("IDapp"=>$idAplicacion, "img"=>$nombreImagen);
							$this->ModeloAplicacion->actualizar($imagen);
						}
					}
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
		$this->authApi("aplicacion/eliminar");
		$post = $this->input->post();
		$rModel = $this->validarForm("id");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idAplicacion = Encryption::decode($post["ID"]);
			if (is_numeric($idAplicacion)) {
				$this->load->model("ModeloAplicacion");
				if ($this->ModeloAplicacion->existeAplicacionEstatus($idAplicacion, "A")) {
					$aplicacion = array("IDapp"=>$idAplicacion, "estatus"=>"I");
					$this->ModeloAplicacion->eliminar($aplicacion);
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


	/**
	 * Api
	 */
	
	public function oauth($metodo = null, $key = "", $keySecreto = "", $userUrl = "", $firstIdUrl = "") {
		/**
		*validar que sea por json
		 */
		//$key = Encryption::decode($key);
		//$keySecreto = Encryption::decode($keySecreto);
		if ($metodo != "" && $key != "" && $keySecreto != "") {
			$this->load->model("ModeloAplicacion");
			if ($this->ModeloAplicacion->existeAppKeyKeySecretoActivo($key, $keySecreto)) {
				$this->load->model("ModeloPost");
				$data = $this->input->post();
				$usuario = (isset($data["user"])) ? trim($data["user"]) : "";
				$limite = (isset($data["limit"])) ? trim($data["limit"]) : 100;
				$linkTwitter = (isset($data["linkTwitter"])) ? trim($data["linkTwitter"]) : false;
				$dateFormat = (isset($data["dateFormat"])) ? trim($data["dateFormat"]) : "dmaf";
				$lastId = (isset($data["lastId"])) ? Encryption::decode(trim($data["lastId"])) : "0";
				$firstId = (isset($data["firstId"])) ? Encryption::decode(trim($data["firstId"])) : "0";
				$category = (isset($data["category"])) ? trim($data["category"]) : "";
				
				/*
				if ($param != "") {
					$listParameter = explode("&", $param);
					foreach ($listParameter as $parameter) {
						$values = explode("=", $parameter);
						switch ($values[0]) {
							case "lastId":
								$lastId = ($values[1] != "") ? Encryption::decode(trim($values[1])) : "0";
								break;
							case "user":
								$usuario = ($values[1] != "") ? trim($values[1]) : "";
								break;
						}
					}
				}
				*/
				$firstId = ($firstIdUrl != "") ? Encryption::decode(trim($firstIdUrl)) : $firstId;
				$usuario = ($userUrl != "") ? trim($userUrl) : $usuario;
				
				switch ($metodo) {
					case "gettimeline":
						$resultado = $this->ModeloPost->obtenerPostUsuarioKeyPostActivoImagen($usuario, $limite, $linkTwitter, $dateFormat, $lastId, $firstId, $category);
						echo json_encode(array("status"=>true,"result"=>$resultado));
						break;
					case "existnewpost":
						$resultado = $this->ModeloPost->existePostNuevoUsuarioKeyPostActivoImagen($usuario, $firstId, $category);
						echo json_encode(array("status"=>true,"result"=>$resultado));
						break;
					default:
						echo json_encode(array("status"=>false,"result"=>Texto::idioma("Error-1")));
						break;
				}
			} else {
				echo json_encode(array("status"=>false,"result"=>Texto::idioma("Error-2")));
			}
		} else {
			echo json_encode(array("status"=>false,"result"=>Texto::idioma("Error-3")));
		}
	}
}
?>