<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MY_Controller {

	public function index() {
		if (!$this->session->userdata("sUsuario")) {
			$dato['titulo'] = Texto::idioma('Inicio');
			$dato['baseUrl'] = base_url();
			$dato['mensaje'] = $this->texto->idioma("");
			$this->load->view(TEMADEFAULTADMIN.'sesion', $dato);
		} else {
			$usuarioSesion = $this->session->userdata("sUsuario");
			if (Encryption::decode($usuarioSesion["idRol"]) == 1) {
				redirect('estadistica');
			} else {
				redirect('propiedad/administrar');
			}
		}
	}

	public function agente() {
		$dato['titulo'] = Texto::idioma('Agentes');
		$dato['vista'] = 'usuario/perfil';
		$this->load->view(TEMADEFAULT.'general', $dato);
	}

	public function au($token = "", $codigoU = "") {
		//$this->usuarioLogueado(true, "usuario");
		if ($token != "") {
			$this->load->model("ModeloUsuario");
			$usuario = $this->ModeloUsuario->obtenerUsuarioTokenPendiente($token);
			if (!empty($usuario)) {
				$dato['subTitulo'] = '';
				$dato["vista"] = "usuario/cuentaactivada";
				$this->load->model("ModeloUsuario");
				$this->ModeloUsuario->cambiarEstatusUsuario($usuario->IDusuario, "A");
				$dato['titulo'] = Texto::idioma('Bienvenido_A_Su_Cuenta');
				$dato['baseUrl'] = base_url();
				if ($this->session->userdata("sUsuario")) {
					$usuarioSesion = $this->session->userdata("sUsuario");
					$usuarioSesion["estatus"] = "A";
					$this->session->set_userdata("sUsuario", $usuarioSesion);
				}
				$this->load->view(TEMADEFAULT.'general', $dato);
			} else {
				redirect('pefil');
			}
		} else {
			redirect();
		}
	}

	public function perfil() {
		$this->auth("usuario/perfil");
		$dato['titulo'] = Texto::idioma('Datos_Personales');
		$dato['subTitulo'] = Texto::idioma('Mi_Perfil');
		$dato['vista'] = 'usuario/perfil';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}

	public function perfilH() {
		$this->auth("usuario/perfil");
		$dato['titulo'] = Texto::idioma('Perfil');
		$dato['subTitulo'] = Texto::idioma('Perfil');
		$dato['vista'] = 'usuario/perfil';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}
	
	public function cambiarContrasena() {
		$this->auth("usuario/cambiarcontrasena");
		$dato['titulo'] = Texto::idioma('Cambiar_Contrasena');
		$dato['subTitulo'] = Texto::idioma('');
		$dato['vista'] = 'usuario/cambiarcontrasena';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}



	function sesionTwitter() {
		$this->load->model("ModeloSocial");
		$social = $this->ModeloSocial->obtenerSocialActivoIdTipo(2);
		if (empty($social)) {
			redirect();
		}
		$this->load->library('twitter/twitteroauth');
		$this->load->library("Encryption");
		$informacion = '';
		$callback = HOST."usuario/sesionTwitter/";
		$consumerKey    = $social->access_token; //inserta tu consumer key</span>
		$consumerSecret = $social->access_token_secret; //inserta tu consumer secret</span>
		$oAuthToken     = ''; //inserta tu access token
		$oAuthSecret    = ''; //inserta tu token secret
		
		if (isset($_REQUEST["oauth_token"])) {
			$tweet = new TwitterOAuth($consumerKey, $consumerSecret,  Encryption::decode($this->session->userdata("oauth_token")), Encryption::decode($this->session->userdata("oauth_token_secret")));
			/**
			 * Token Permanente
			 */
			$access_token = $tweet->getAccessToken($_REQUEST['oauth_verifier']);
			$accessToken = (string) $access_token['oauth_token'];
   			$accessTokenSecret = (string) $access_token['oauth_token_secret'];
   			
			$content = $tweet->get('account/verify_credentials');
			/**
			 * 
			 * Registrar Cuenta Nueva
			 */
			//$usuario = $this->session->userdata("sUsuario");
			$this->load->model("ModeloCuenta");
			$accessTokenCode = Encryption::encode($accessToken);
			$accessTokenSecretCode = Encryption::encode($accessTokenSecret);

			$fecha = date("Y/m/d H:i:s");
			$this->load->model("ModeloUsuario");
			if ($this->ModeloUsuario->existeUsuario($content->id_str)) {
				$usuarioSesion = $this->ModeloUsuario->iniciarSesion($content->id_str, "", true, 2);
				if ($usuarioSesion["estatus"]) {
					$this->session->set_userdata("sUsuario", $usuarioSesion["datoUsuario"]);
					$this->session->set_userdata("sTimezone", $usuarioSesion["timezone"]);
					$usuario = $usuarioSesion["datoUsuario"];
					$idUsuario = Encryption::decode($usuario["id"]);
					$cuentaUsuario = $this->ModeloCuenta->obtenerCuentaUsuarioIdActiva($idUsuario, $content->id_str);
					$this->ModeloCuenta->actualizarDatosCuentaSesion(array("IDcuenta"=>$cuentaUsuario->IDcuenta, "descripcion"=>$content->screen_name, "img"=>$content->profile_image_url, "access_token"=>$accessTokenCode, "access_token_secret"=>$accessTokenSecretCode));
					redirect('panel');
				} else {
					redirect();
				}
			} else {
				$fechaCrea = date("Y/m/d H:i:s");
				$idRol = 2;
				$token = Encryption::encode(rand(1, 100).date("Y/m/d H:i:s"));
				$urlTemp = $content->name;
				$this->load->model("ModeloApp");
				$url = $this->ModeloApp->generarUrl($urlTemp, "usuario");
				$usuario = array("nombre"=>$content->name, "apellido"=>" ", "usuario"=>$content->id_str, "estatus"=>"A", "fecha_crea"=>$fechaCrea, "tipo"=>2, "token"=>$token, "url"=>$url, "agente"=>true);
				$idUsuario = $this->ModeloUsuario->registrarUsuario($usuario);
				$usuarioDetalle = array("IDusuario"=>$idUsuario, "IDtimezone"=>22);
				$this->ModeloUsuario->registrarUsuarioDetalle($usuarioDetalle);
				$usuarioRol = array("IDusuario"=>$idUsuario, "IDrol"=>$idRol, "primario"=>true);
				$this->ModeloUsuario->registrarUsuarioRol($usuarioRol);

				$primario = 1;
				$cuenta = array("IDusuario"=>$idUsuario, "IDtipo_cuenta"=>2, "id"=>$content->id_str, "descripcion"=>$content->screen_name, "primario"=>true, "img"=>$content->profile_image_url, "access_token"=>$accessTokenCode, "access_token_secret"=>$accessTokenSecretCode, "estatus"=>"A");
				$this->ModeloCuenta->registrar($cuenta);

				$usuarioSesion = $this->ModeloUsuario->iniciarSesion($content->id_str, "", true, 2);
				$this->session->set_userdata("sUsuario", $usuarioSesion["datoUsuario"]);
				$this->session->set_userdata("sTimezone", $usuarioSesion["timezone"]);
				$this->session->unset_userdata("oauth_token");
				$this->session->unset_userdata("oauth_token_secret");
				redirect("panel");
			}
		} else {
			$tweet = new TwitterOAuth($consumerKey, $consumerSecret);
			$tweetToken = $tweet->getRequestToken($callback);
			$this->session->set_userdata("oauth_token", Encryption::encode($tweetToken['oauth_token']));
			$this->session->set_userdata("oauth_token_secret", Encryption::encode($tweetToken['oauth_token_secret']));
			switch ($tweet->http_code) {
			  case 200:
			    /* Build authorize URL and redirect user to Twitter. */
			    $url = $tweet->getAuthorizeURL($tweetToken);
			    header('Location: ' . $url); 
			    break;
			  default:
			    /* Show notification if something went wrong. */
			    echo 'Could not connect to Twitter. Refresh the page or try again later.';
			}
		}
	}

	function sesionFacebook() {
		if (isset($_SERVER["HTTP_REFERER"]) && !$this->session->userdata("sUrlReferer")) {
			$this->session->set_userdata("sUrlReferer", $_SERVER["HTTP_REFERER"]);
		}


		$this->load->library('facebook');
		$this->load->library("Encryption");$this->load->model("ModeloSocial");
		$social = $this->ModeloSocial->obtenerSocialActivoIdTipo(1);
		if (empty($social)) {
			redirect();
		}
		$informacion = '';
		$app_id = $social->id;
		
		$app_secret = $social->access_token;
		$my_url = HOST."usuario/sesionFacebook/";
		
		if (isset($_REQUEST["code"])) {
			$code = $_REQUEST["code"];
		} else {
			$code = "";
		}
		$data["user"] = "";
		if (empty($code)) {				
			$_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
			$dialog_url = "https://www.facebook.com/dialog/oauth?client_id="
					. $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
							. $_SESSION['state'] . "&scope=public_profile,user_birthday,user_website, publish_actions,email, user_relationship_details, user_about_me";
			header("Location: " . $dialog_url);
		} else {
			if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
				$token_url = "https://graph.facebook.com/oauth/access_token?"
						. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
						. "&client_secret=" . $app_secret . "&code=" . $code;
				$response = file_get_contents($token_url);
				$params = null;
				parse_str($response, $params);
				if (isset($params['access_token'])) {
					$_SESSION['access_token'] = $params['access_token'];
					$graph_url = "https://graph.facebook.com/me?fields=email,birthday,bio,name,first_name,last_name,gender&access_token="
							. $params['access_token'];
					$user = json_decode(file_get_contents($graph_url));
					if ($user) {

						$facebook = new Facebook(array('appId'  => $app_id,'secret' => $app_secret));
						/**
						 * 
						 * Token Permanente
						 */
						$accessToken = $params['access_token'];
						/**
						 * 
						 * Registrar o Actualizar Cuenta
						 */
						
						$this->load->model("ModeloCuenta");
						$accessTokenCode = Encryption::encode($accessToken);

						$fecha = date("Y/m/d H:i:s");
						$this->load->model("ModeloUsuario");
						if ($this->ModeloUsuario->existeUsuario($user->id)) {
							$usuarioSesion = $this->ModeloUsuario->iniciarSesion($user->id, "", true, 2);
							if ($usuarioSesion["estatus"]) {
								$this->session->set_userdata("sUsuario", $usuarioSesion["datoUsuario"]);
								$this->session->set_userdata("sTimezone", $usuarioSesion["timezone"]);
								$usuarioD = $usuarioSesion["datoUsuario"];
								$idUsuario = Encryption::decode($usuarioD["id"]);
								$bio = (isset($user->bio)) ? $user->bio : "";
								$sexo = (isset($user->gender)) ? ($user->gender == "male" ? "M" : "F") : "";
								$birthday = (isset($user->birthday)) ? $user->birthday : "";
								$email = (isset($user->email)) ? $user->email : "";
								$usuario = array("IDusuario"=>$idUsuario, "nombre"=>$user->first_name, "apellido"=>$user->last_name, "correo"=>$email, "comentario"=>$bio, "usuario"=>$user->id, "estatus"=>"A");
								$this->ModeloUsuario->actualizarUsuario($usuario);
								if ($birthday != "") {
									$birthday = Texto::setFormatoFecha($birthday, "Y/m/d");
									$usuarioDetalle = array("IDusuario"=>$idUsuario, "fecha_nacimiento"=>$birthday, "sexo"=>$sexo);
									$this->ModeloUsuario->actualizarUsuarioDetalle($usuarioDetalle);
								}
								$cuentaUsuario = $this->ModeloCuenta->obtenerCuentaUsuarioIdActiva($idUsuario, $user->id);
								$urlImagen = "http://graph.facebook.com/".$user->id."/picture?type=large";
								$this->ModeloCuenta->actualizarDatosCuentaSesion(array("IDcuenta"=>$cuentaUsuario->IDcuenta, "descripcion"=>$user->name, "img"=>$urlImagen, "access_token"=>$accessTokenCode));
								$codigoImg = Encryption::encodeCrc($idUsuario);
								Texto::saveImage($urlImagen, IMAGE_UPLOAD."perfil/game-".$codigoImg.'.jpg');
								$usuarioTemp = array("IDusuario"=>$idUsuario, "imagen"=>$codigoImg.'.jpg');
								$this->ModeloUsuario->actualizar($usuarioTemp);
								
								if ($this->session->userdata("sUrlReferer")) {
									$urlReferer = $this->session->userdata("sUrlReferer");
									$this->session->unset_userdata("sUrlReferer");
									redirect($urlReferer);	
								} else {
									redirect('panel');
								}
							} else {
								redirect();
							}
						} else {
							$fechaCrea = date("Y/m/d H:i:s");
							$idRol = 2;
							$urlImagen = "http://graph.facebook.com/".$user->id."/picture?type=large";
							$token = Encryption::encode(rand(1, 100).date("Y/m/d H:i:s"));
							$bio = (isset($user->bio)) ? $user->bio : "";
							$sexo = (isset($user->gender)) ? ($user->gender == "male" ? "M" : "F") : "";
							$birthday = (isset($user->birthday)) ? $user->birthday : "";
							$email = (isset($user->email)) ? $user->email : "";
							$urlTemp = $user->first_name." ".$user->last_name;
							$this->load->model("ModeloApp");
							$url = $this->ModeloApp->generarUrl($urlTemp, "usuario");
							$usuario = array("nombre"=>$user->first_name, "apellido"=>$user->last_name, "correo"=>$email, "comentario"=>$bio, "usuario"=>$user->id, "estatus"=>"A", "fecha_crea"=>$fechaCrea, "tipo"=>2, "token"=>$token, "url"=>$url, "agente"=>true);
							$idUsuario = $this->ModeloUsuario->registrarUsuario($usuario);
							$usuarioDetalle = array("IDusuario"=>$idUsuario, "fecha_nacimiento"=>$birthday, "IDtimezone"=>22, "sexo"=>$sexo);
							$this->ModeloUsuario->registrarUsuarioDetalle($usuarioDetalle);
							$usuarioRol = array("IDusuario"=>$idUsuario, "IDrol"=>$idRol, "primario"=>true);
							$this->ModeloUsuario->registrarUsuarioRol($usuarioRol);

							$primario = 1;
							$cuenta = array("IDusuario"=>$idUsuario, "IDtipo_cuenta"=>1, "id"=>$user->id, "descripcion"=>$user->name, "primario"=>true, "img"=>$urlImagen, "access_token"=>$accessTokenCode, "estatus"=>"A");
							$this->ModeloCuenta->registrar($cuenta);

							$usuarioSesion = $this->ModeloUsuario->iniciarSesion($user->id, "", true, 2);
							$this->session->set_userdata("sUsuario", $usuarioSesion["datoUsuario"]);
							$this->session->set_userdata("sTimezone", $usuarioSesion["timezone"]);
							$this->session->unset_userdata("oauth_token");
							$this->session->unset_userdata("oauth_token_secret");

							
							$codigoImg = Encryption::encodeCrc($idUsuario);
							Texto::saveImage($urlImagen, IMAGE_UPLOAD."perfil/game-".$codigoImg.'.jpg');
							$usuarioTemp = array("IDusuario"=>$idUsuario, "imagen"=>$codigoImg.'.jpg');
							$this->ModeloUsuario->actualizar($usuarioTemp);

							if ($this->session->userdata("sUrlReferer")) {
								$urlReferer = $this->session->userdata("sUrlReferer");
								$this->session->unset_userdata("sUrlReferer");
								redirect($urlReferer);	
							} else {
								redirect('panel');
							}
						}
					} else {
						redirect();
					}
				} else {
					redirect();
				}
			} else {
				echo $informacion = "The state does not match. You may be a victim of CSRF.";
			}
		}
	}

	public function administrar() {
		$this->auth("usuario");
		$dato['menuS'] = "mAdmin";
		$dato['titulo'] = Texto::idioma('Administrar_Usuario');
		$dato['vista'] = 'usuario/administrar';
		$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
	}

	public function cerrarSesion() {
		$this->session->sess_destroy();
		header("Location: ".base_url());
	}
	
	public function rc($token = "") {
		if ($token != "") {
			$this->load->model("ModeloUsuario");
			$usuario = $this->ModeloUsuario->obtenerUsuarioToken($token);
			if (!empty($usuario)) {
				$dato['token'] = $token;
				$dato["vista"] = "usuario/recuperarcontrasena";
				$dato['titulo'] = Texto::idioma('Cambiar_Contrasena');
				$this->load->view(TEMADEFAULTADMIN.'clear', $dato);
			} else {
				redirect();
			}
		} else {
			redirect();
		}
	}

	public function rcf($token = "") {
		if ($token != "") {
			$this->load->model("ModeloUsuario");
			$usuario = $this->ModeloUsuario->obtenerUsuarioToken($token);
			if (!empty($usuario)) {
				$dato['token'] = $token;
				$dato["vista"] = "usuario/recuperarcontrasenaf";
				$dato['titulo'] = Texto::idioma('Cambiar_Contrasena');
				$this->load->view(TEMADEFAULT.'general', $dato);
			} else {
				redirect();
			}
		} else {
			redirect();
		}
	}
	
	public function obtenerUsuarioJson($sq ='') {
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(1));
		if (isset($_REQUEST['term'])) {
			$str = explode("+", $_REQUEST['term']);
			$nombre = $str[0];
			$nombre = trim($nombre);
			$sq = strtolower($nombre);
		} else {
			$sq = "";
		}
		if($sq != ''){
			$this->load->model("ModeloUsuario");
			$listaUsuario = $this->ModeloUsuario->obtenerUsuariosPorNombre($sq);
			$listaUsuarioJson = array();
			foreach ($listaUsuario->result() as $registro) {
				$listaUsuarioJson[] = array('id'=>$registro->IDusuario, "value" => Texto::idioma($registro->nombre)." ".Texto::idioma($registro->apellido)." - ".Texto::idioma($registro->usuario), "label" => Texto::idioma($registro->nombre)." ".Texto::idioma($registro->apellido)." - ".Texto::idioma($registro->usuario));
			}
			echo json_encode($listaUsuarioJson);
		} else {
			$listaUsuarioJson = array();
			echo json_encode($listaUsuarioJson);
		}
	}
	
	public function cambiarIdioma($idioma = 'es') {
		$listaIdioma = array('es'=>'es', 'en'=>'en');
		if (key_exists($idioma, $listaIdioma)) {
			$this->session->set_userdata("sIdioma", $idioma);
		}
		header("Location: {$_SERVER["HTTP_REFERER"]}"); 
		//redirect($_SERVER["HTTP_REFERER"]);
	}
	
	
	private function verificarClave($clave, $JSON)
	{
		if ($clave != '') {
			$listaPermisoClave = $this->obtenerPermisosClave();
			$clave_longitud = 0;
			$clave_numero = 0;
			$clave_min_may = 0;
			for($i = 0; $i <= strlen($clave) - 1; $i++)
			{
				if ($this->verificarMayusculas($clave[$i]))
				{
					$clave_min_may++;
				}
				if ($this->verificarNumero($clave[$i]))
				{
					$clave_numero++;
				}
				$clave_longitud++;
			}
			
			if($clave_longitud >= $listaPermisoClave["clave_longitud"] && $clave_min_may >= $listaPermisoClave["clave_min_may"] && $clave_numero >= $listaPermisoClave["clave_numero"])
			{
				if ($JSON == "Si-JSON")
				{
					$valido = array("Valido"=>"si");
					echo json_encode($valido);
				}
				else
				{
					$valido = array("Valido"=>"si");
					return $valido;
				}
			}
			else 
			{
				if ($JSON == "Si-JSON")
				{
					$valido = array("Valido"=>"no");
					echo json_encode($valido);
				}
				else
				{
					$valido = array("Valido"=>"no");
					return $valido;
				}
			}
				//return $disponibilidad;
		} else {
		//$this->redirect();
		}
	}
	
	private function verificarMayusculas($caracter)
	{
		$mayusculas = array("Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M","�");
		$verificaion = false;
		foreach ($mayusculas as $may)
		{
			if ($may == $caracter)
			{
				$verificaion = true;
			}
		}
		return $verificaion;
	}
	private function verificarNumero($caracter)
	{
		$numero = array("0","1","2","3","4","5","6","7","8","9");
		$verificaion = false;
		foreach ($numero as $num)
		{
			if ($num == $caracter)
			{
				$verificaion = true;
			}
		}
		return $verificaion;
	}
	private function obtenerPermisosClave()
	{	
		$permisosClave = array("clave_longitud"=>8, "clave_min_may"=>0, "clave_numero"=>1);
		return $permisosClave;
	}



	/**
	 * Api Usuario
	 */
	public function apiObtenerUsuario() {
		$this->authApi("usuario/consulta");
		$rModel = $this->validarForm("buscador");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$pagina = $post["pagina"];
			if (is_numeric($pagina)) {
				$busqueda = $post["busqueda"];
				$limite = 10;
                $inicio = $pagina * $limite;
				$this->load->model("ModeloUsuario");
				$resultado = $this->ModeloUsuario->obtenerUsuarioActivo($inicio, $limite, $busqueda, true);
				echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiRegistrar() {
		$this->authApi("usuario/registrar");
		$rModel = $this->validarForm("usuario");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$this->load->model("ModeloUsuario");
			$fecha = date("Y/m/d H:i:s");
			$idRol = (isset($post["IDrol"])) ? Encryption::decode($post["IDrol"]) : "Error";
			if (is_numeric($idRol)) {
				$agente = $this->getPost("agente");
				if (!$this->ModeloUsuario->existeUsuario($post["usuario"])) {
					if (Texto::validarCorreo($post["correo"])) {
						if (!$this->ModeloUsuario->existeCorreo($post["correo"])) {
							$contrasena = md5("12345678");
							$fechaCrea = date("Y/m/d H:i:s");
							$token = Encryption::encode(rand(1, 100).date("Y/m/d H:i:s"));
							$urlTemp = $nombre." ".$apellido;
							$this->load->model("ModeloApp");
							$url = $this->ModeloApp->generarUrl($urlTemp, "usuario");
							$usuario = array("nombre"=>$post["nombre"], "apellido"=>$post["apellido"], "usuario"=>$post["usuario"], "correo"=>$post["correo"], "comentario"=>$post["comentario"], "contrasena"=>$contrasena, "fecha_crea"=>$fechaCrea, "tipo"=>1, "token"=>$token, "estatus"=>"A", "agente"=>$agente, "url"=>$url);
							$idUsuario = $this->ModeloUsuario->registrarUsuario($usuario);
							$usuarioDetalle = array("IDusuario"=>$idUsuario, "IDtimezone"=>22);
							$this->ModeloUsuario->registrarUsuarioDetalle($usuarioDetalle);
							$usuarioRol = array("IDusuario"=>$idUsuario, "IDrol"=>$idRol, "primario"=>true);
							$this->ModeloUsuario->registrarUsuarioRol($usuarioRol);
							echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
						} else {
							echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Correo_No_Disponible")));
						}
					} else {
						echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Correo_Incorrecto")));
					}
				} else {
					echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Usuario_No_Disponible")));
				}	
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("ERROR-01")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiModificar() {
		$this->authApi("usuario/modificar");
		$rModel = $this->validarForm("usuario");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idUsuario = (isset($post["IDusuario"])) ? Encryption::decode($post["IDusuario"]) : "Error";
			$idRol = (isset($post["IDrol"])) ? Encryption::decode($post["IDrol"]) : "Error";
			if (is_numeric($idUsuario) && is_numeric($idRol)) {
				$this->load->model("ModeloUsuario");
				if ($this->ModeloUsuario->existeUsuarioEstatus($idUsuario, "A")) {
					if (Texto::validarCorreo($post["correo"])) {
						if (!$this->ModeloUsuario->existeUsuarioIdUsuario($post["usuario"], $idUsuario)) {
							if (!$this->ModeloUsuario->existeCorreoIdUsuario($post["correo"], $idUsuario)) {
								$agente = $this->getPost("agente");
								$nombre = $this->getPost("nombre");
								$apellido = $this->getPost("apellido");
								$urlTemp = $nombre." ".$apellido;
								$this->load->model("ModeloApp");
								$url = $this->ModeloApp->generarUrl($urlTemp, "usuario", $idUsuario);
								$usuario = array("IDusuario"=>$idUsuario, "nombre"=>$nombre, "apellido"=>$apellido, "usuario"=>$post["usuario"], "correo"=>$post["correo"], "comentario"=>$post["comentario"], "agente"=>$agente, "url"=>$url);
								$this->ModeloUsuario->actualizar($usuario);
								$this->ModeloUsuario->actualizarUsuarioRol(array("IDusuario"=>$idUsuario, "IDrol"=>$idRol));
								echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Info-Modificacion")));
							} else {
								echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Correo_No_Disponible")));
							}
						} else {
							echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Correo_Incorrecto")));
						}
					} else {
						echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Usuario_No_Disponible")));
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
		$this->authApi("usuario/eliminar");
		$post = $this->input->post();
		$rModel = $this->validarForm("usuarioEliminar");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$idUsuario = Encryption::decode($post["IDusuario"]);
			if (is_numeric($idUsuario)) {
				$this->load->model("ModeloUsuario");
				if ($this->ModeloUsuario->existeUsuarioEstatus($idUsuario, "A")) {
					$usuario = array("IDusuario"=>$idUsuario, "estatus"=>"I");
					$this->ModeloUsuario->eliminar($usuario);
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

	public function apiRecordarContrasena() {
		$rModel = $this->validarForm("recordarContrasena");
 		if ($rModel["estatus"]) {
 			$post = $this->input->post();
			$this->load->model("ModeloUsuario");
			$usuario = $this->ModeloUsuario->obtenerUsuarioPorUsuarioParaClave($post["usuario"]);
			if (!empty($usuario)) {
				$tipo = (isset($post["tipo"])) ? $post["tipo"] : "B";
				$dato["nombre"] = $usuario->nombre." ".$usuario->apellido;
				$dato["usuario"] = $usuario->usuario;
				$dato["mensaje"] = Texto::idioma("Mensaje_Recuperar_Contrasena");
				$dato["fecha"] = date("Y/m/d H:i:s");
				$token = Encryption::encode(rand(1, 100).date("Y/m/d H:i:s"));
				$dato["codigo"] = $token;
				$dato["url"] = ($tipo == "B") ? HOST."usuario/rc/".$token : HOST."usuario/rcf/".$token;
				$plantilla = $this->load->view('plantilla/notificacionrecuperarcontrasena', $dato, true);
				$this->load->model("ModeloUsuario");
				$this->ModeloUsuario->actualizarToken($usuario->IDusuario, $token);
				$this->load->model("ModeloConfiguracion");
				$configuracion = $this->ModeloConfiguracion->obtenerConfiguracion();
				$this->load->library("EnviarCorreo");
				$resultado = EnviarCorreo::enviarEmailComun($usuario->correo, Texto::idioma("Asunto_Recordar_Contrasena"), $plantilla, $configuracion->empresa, $configuracion->email_envio, Encryption::decode($configuracion->clave), $configuracion->host, $configuracion->puerto);
				if ($resultado["estatus"]) {
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Notificacion_Recordar_Contrasena")));
				} else {
					echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Error_Envio_Correo")));
				}
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Error")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	function apiCambiarContrasenaRecuperada() {
		$rModel = $this->validarForm("cambiarContrasenaRecuperada");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$this->load->model("ModeloUsuario");
			$usuario = $this->ModeloUsuario->obtenerUsuarioToken($post["token"]);
			$idUsuario = $usuario->IDusuario;
			$validacionClave = $this->verificarClave($post["contrasena"], "No-JSON");
			if ($validacionClave["Valido"] == "si") {
				$token = Encryption::encode(rand(1, 100).date("Y/m/d H:i:s"));
				$this->ModeloUsuario->modificarClaveUsuario(array("IDusuario"=>$idUsuario, "contrasena"=>md5($post["contrasena"]), "token"=>$token));
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Contrasena_Cambiada")));
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Contrasena_Insegura")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}


	public function apiObtenerConenidoPerfil() {
		$this->authApi("usuario/perfil");
		$this->load->model("ModeloUsuario");
		$usuario = $this->session->userdata("sUsuario");
		$usuarioDetalle = $this->ModeloUsuario->obtenerUsuarioPerfil(Encryption::decode($usuario["id"]));
		$this->load->model("ModeloTipoCuenta");
		$listaTipoCuenta = $this->ModeloTipoCuenta->obtenerTipoCuentaActivo(true);
		$resultado = array("listaTipoCuenta"=>$listaTipoCuenta, "usuarioDetalle"=>$usuarioDetalle);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}

	public function apiActualizarPerfil() {
		$this->authApi("usuario/perfil");
		$post = $this->input->post();
		$rModel = $this->validarForm("perfil");
 		if ($rModel["estatus"])
		{
			$this->load->model("ModeloUsuario");
			$usuarioSesion = $this->session->userdata("sUsuario");
			$idUsuario = Encryption::decode($usuarioSesion["id"]);
			$fecha = date("Y/m/d H:i:s");
			$urlTemp = $this->getPost("url");
			$this->load->model("ModeloApp");
			$url = $this->ModeloApp->generarUrl($urlTemp, "usuario", $idUsuario);
			$usuario = array("IDusuario"=>$idUsuario, "nombre"=>$post["nombre"], "apellido"=>$post["apellido"], "url"=>$url);
			$sexo = (isset($post["sexo"])) ? $post["sexo"] : "";
			$estadoCivil = (isset($post["estadoCivil"])) ? $post["estadoCivil"] : "";
			$bio = $this->getPost("bio");
			$this->ModeloUsuario->actualizarUsuario($usuario);
			$compartirNombre = 1;//$this->getPost("compartirNombre");
			$usuarioDetalle = array("IDusuario"=>$idUsuario, "telefono"=>$post["telefono"], "celular"=>$post["celular"], "sexo"=>$sexo, "direccion"=>$post["direccion"], "fecha_nacimiento"=>$post["fechaNacimiento"], "estado_civil"=>$estadoCivil, "compartir_celular"=>$post["compartirCelular"], "compartir_correo"=>$post["compartirCorreo"], "compartir_nombre"=>$compartirNombre, "bio"=>$bio);
			$this->ModeloUsuario->actualizarUsuarioDetalle($usuarioDetalle);
			//Social
			$this->ModeloUsuario->eliminarUsuarioSocial(array("IDusuario"=>$idUsuario, "estatus"=>"I"));
			if (isset($post["tipoCuenta"])) {
				$listaTipoCuenta = $this->getPost("tipoCuenta");
				foreach ($listaTipoCuenta as $idTipoCuentaC => $url) {
					$idTipoCuenta = Encryption::decode($idTipoCuentaC);
					if (trim($url) != "") {
						$this->ModeloUsuario->registrarSocial(array("IDusuario"=>$idUsuario, "IDtipo_cuenta"=>$idTipoCuenta, "url"=>$url, "estatus"=>"A"));
					}
				}
			}
			$contrasenaAnterior = $this->getPost("contrasenaAnterior");
			$contrasena = $this->getPost("contrasena");
			$confirmarContrasena = $this->getPost("confirmarContrasena");
			if ($contrasena == $confirmarContrasena && $contrasena != "") {
				$validacionClave = $this->verificarClave($contrasena, "No-JSON");
				if($validacionClave["Valido"] == "si") {
					$usuarioRegistrado = $this->ModeloUsuario->obtenerUsuarioPorIdUsuario($idUsuario);
					if ($usuarioRegistrado->contrasena == md5($contrasenaAnterior)) {
						$this->ModeloUsuario->modificarClaveUsuario(array("IDusuario"=>$idUsuario, "contrasena"=>md5($contrasena)));
					} else {
						echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Debe_Insertar_La_Contrasena_Anterior")));
						exit();
					}
				} else {
					echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Contrasena_Insegura")));
					exit();
				}
			}
			echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Perfil_Actualizado")));
		} else if (isset($_FILES["file"])) {
			$this->load->model("ModeloUsuario");
			$usuarioSesion = $this->session->userdata("sUsuario");
			$idUsuario = Encryption::decode($usuarioSesion["id"]);
 			$codigoImg = Encryption::encodeCrc($idUsuario);
			$this->load->library("Subir");

			$crop = array();
			$crop[] = array("x"=>"100", "y"=>"100", "pref"=>"perfil-");
			$crop[] = array("x"=>"231", "y"=>"231", "pref"=>"game-");

			$resultado = Subir::imagenFile($_FILES["file"], "{$codigoImg}", IMAGE_UPLOAD."perfil/", "", array("jpeg", "jpg", "png", "gif"), 10000, 70, $crop, true);
			//$resultado = Subir::imagen("file", "perfil-{$codigoImg}", IMAGE_UPLOAD."perfil/", "", array("jpeg", "jpg", "png", "gif"), 10000, 70, 100, 100, true);
			if ($resultado['estado']) {
				$imagen = $resultado["nombre"].".".$resultado["ext"];
				$usuario = array("IDusuario"=>$idUsuario, "imagen"=>$imagen);
				$this->ModeloUsuario->actualizar($usuario);
				$imagen = (file_exists(IMAGE_UPLOAD."perfil/".$imagen) && $imagen != "") ? IMAGEPROFILE.$imagen : IMAGEPROFILE."user.png";
				$usuarioSesion["imagenPerfil"] = $imagen;
				$this->session->set_userdata("sUsuario", $usuarioSesion);
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Imagen_Modificada")));
			} else {
				echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Error_Imagen")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	/**
	* Envio correo confirmacion
	*/	
	public function apiNotificarCorreo() {
		$this->authApi("usuario/correonotificacion");
		$token = Encryption::encode(rand(1, 100).date("Y/m/d H:i:s"));
		$usuario = $this->session->userdata("sUsuario");
		$dato["nombre"] = $usuario["nombre"]." ".$usuario["apellido"];
		$dato["usuario"] = $usuario["usuario"];
		$dato["fecha"] = date("Y/m/d H:i:s");
		$dato["codigo"] = $token;
		$this->load->model("ModeloUsuario");
		$this->ModeloUsuario->actualizarToken(Encryption::decode($usuario["id"]), $token);
		$plantilla = $this->load->view('plantilla/activarusuario', $dato, true);
		$this->load->model("ModeloConfiguracion");
		$configuracion = $this->ModeloConfiguracion->obtenerConfiguracion();
		$this->load->library("EnviarCorreo");
		$resultado = EnviarCorreo::enviarEmailComun($usuario["correo"], Texto::idioma("Asunto_Activar_Usuario"), $plantilla, $configuracion->empresa, $configuracion->email_envio, Encryption::decode($configuracion->clave), $configuracion->host, $configuracion->puerto);
		echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Mensaje_Enviado")));
	}

	public function apiObtenerPerfil() {
		$this->authApi("usuario/perfil");
		$resultado = $this->session->userdata("sUsuario");
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}

	public function apiIniciarSesion() {
		if (!$this->session->userdata("sUsuario")) {
			$rModel = $this->validarForm("sesion");
	 		if ($rModel["estatus"])
			{
				$post = $this->input->post();
				$this->load->model("ModeloUsuario");
				$usuario = $post["usuario"];
				$contrasena = $post["contrasena"];
				$usuarioSesion = $this->ModeloUsuario->iniciarSesion($usuario, md5($contrasena));
				if ($usuarioSesion["estatus"]) {
					$this->session->set_userdata("sUsuario", $usuarioSesion["datoUsuario"]);
					$this->session->set_userdata("sTimezone", $usuarioSesion["timezone"]);
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("")));
				} else {
					echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Error_Usuario_Contrasena")));
				}
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
			}
		} else {
			echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("")));
		}
	}

	function apiCambiarContrasena() {
		$this->authApi("usuario/cambiarcontrasena");
		$rModel = $this->validarForm("cambiarContrasena");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$usuario = $this->session->userdata("sUsuario");
			$idUsuario = Encryption::decode($usuario["id"]);
			$this->load->model("ModeloUsuario");
			$validacionClave = $this->verificarClave($_POST["contrasena"], "No-JSON");
			if($validacionClave["Valido"] == "si") {
				$usuarioRegistrado = $this->ModeloUsuario->obtenerUsuarioPorIdUsuario($idUsuario);
				if ($usuarioRegistrado->contrasena == md5($_POST["contrasenaAnterior"])) {
					$this->ModeloUsuario->modificarClaveUsuario(array("IDusuario"=>$idUsuario, "contrasena"=>md5($_POST["contrasena"])));
					echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Contrasena_Cambiada")));
				} else {
					echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Debe_Insertar_La_Contrasena_Anterior")));
				}
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Contrasena_Insegura")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	public function apiCrearUsuario() {
		$rModel = $this->validarForm("registrate");
 		if ($rModel["estatus"])
		{
			$post = $this->input->post();
			$this->load->model("ModeloUsuario");
			$idRol = 2;//Encryption::decode($this->input->post('rol'));
			$nombre = $post['nombre'];
			$apellido = $post['apellido'];
			$correo = $post['correo'];
			$contrasena = md5($post["contrasena"]);
			$cedula = "";//$this->input->post('txtCedula');
			$estatus = "P";
			$fechaCrea = date("Y/m/d H:i:s");
			$comentario = "";//$this->input->post('txtComentario');
			$this->load->model("ModeloUsuario");
			if ($idRol != 1) {
				if (!$this->ModeloUsuario->existeUsuario($correo)) {
					if (Texto::validarCorreo($correo)) {
						if (!$this->ModeloUsuario->existeCorreo($correo)) {
							$validacionClave = $this->verificarClave($contrasena, "No-JSON");
							if ($validacionClave["Valido"] == "si") {
								$token = Encryption::encode(rand(1, 100).date("Y/m/d H:i:s"));
								$urlTemp = $nombre." ".$apellido;
								$this->load->model("ModeloApp");
								$url = $this->ModeloApp->generarUrl($urlTemp, "usuario");
								$usuario = array("nombre"=>$nombre, "apellido"=>$apellido, "usuario"=>$correo, "correo"=>$correo, "contrasena"=>$contrasena, "estatus"=>$estatus, "fecha_crea"=>$fechaCrea, "tipo"=>1, "token"=>$token, "agente"=>true, "url"=>$url);
								$idUsuario = $this->ModeloUsuario->registrarUsuario($usuario);
								$usuarioDetalle = array("IDusuario"=>$idUsuario, "IDtimezone"=>22);
								$this->ModeloUsuario->registrarUsuarioDetalle($usuarioDetalle);
								$usuarioRol = array("IDusuario"=>$idUsuario, "IDrol"=>$idRol, "primario"=>true);
								$this->ModeloUsuario->registrarUsuarioRol($usuarioRol);
								/**
								* Envio correo confirmacion
								 */							
								$dato["nombre"] = $nombre." ".$apellido;
								$dato["usuario"] = $correo;
								$dato["fecha"] = date("Y/m/d H:i:s");
								$dato["codigo"] = $token;
								$plantilla = $this->load->view('plantilla/activarusuario', $dato, true);
								$this->load->model("ModeloConfiguracion");
								$configuracion = $this->ModeloConfiguracion->obtenerConfiguracion();
								$this->load->library("EnviarCorreo");
								$resultado = EnviarCorreo::enviarEmailComun($correo, Texto::idioma("Asunto_Activar_Usuario"), $plantilla, $configuracion->empresa, $configuracion->email_envio, Encryption::decode($configuracion->clave), $configuracion->host, $configuracion->puerto);
								$usuarioSesion = $this->ModeloUsuario->iniciarSesion($correo, $contrasena);
								if ($usuarioSesion["estatus"]) {
									$this->session->set_userdata("sUsuario", $usuarioSesion["datoUsuario"]);
									$this->session->set_userdata("sTimezone", $usuarioSesion["timezone"]);
									echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Usuario_Creado")));
								} else {
									echo json_encode(array("estatus"=>true, "mensaje"=>Texto::idioma("Usuario_Creado")));
								}
							} else {
								echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Contrasena_Insegura")."<br/>".Texto::idioma("Clave_Parametro")));
							}
						} else {
							echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Correo_No_Disponible")));
						}
					} else {
						echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Correo_Incorrecto")));
					}
				} else {
					echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Usuario_No_Disponible")));
				}	
			} else {
				echo json_encode(array("estatus"=>false, "mensaje"=>Texto::idioma("Error_Datos")));
			}
		} else {
			echo json_encode(array("estatus"=>false, "mensaje"=>$rModel["mensaje"]));
		}
	}

	//Agentes
	public function apiObtenerAgentes() {
		//$this->authApi("usuario/cambiarcontrasena");
		$this->load->model("ModeloUsuario");
		$resultado = $this->ModeloUsuario->obtenerAgenteActivo();
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}

	private function generarUrl($string, $idUsuario = 0) {
		$url = Texto::urlAmigable($string);
		$validada = false;
		$i = 0;
		while (!$validada) {
			if ($idUsuario == 0) {
				if ($this->ModeloUsuario->existeUrlUsuario($url)) {
					$url = Texto::urlAmigable($string);
					$url .= "-".$i;
				} else {
					$validada = true;
				}
			} else {
				if ($this->ModeloUsuario->existeUrlIdUsuario($url, $idUsuario)) {
					$url = Texto::urlAmigable($string);
					$url .= "-".$i;
				} else {
					$validada = true;
				}	
			}
			$i++;
		}
		return $url;
	}
	
}
?>