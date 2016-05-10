<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');if ( ! defined('APPPATH')) exit('No direct script access allowed');
/**
 *
 * @category   Db
 * @package    modelos
 * @copyright  Copyright (c) 2014 DominicanCode.
 * @license    ---
 */
/**
 * @see Modelo
 * @see entidades: EntPago
 *
 */
class ModeloUsuario extends CI_Model {
	public function obtenerUsuario() {
		$sql = $this->db->get("usuario");
		$listaUsuario = array();
		foreach ($sql->result_array() as $registro) {
			$listaUsuario[] = new EntUsuario($registro['IDusuario'], $registro['usuario'], $registro['nombre'], $registro['apellido'], $registro['correo'], $registro['clave'], $registro['estatus'], $registro['fecha_crea'], $registro['comentario'], $registro['tipo']);
		}
		return $listaUsuario;
	}

	public function registrarCliente(EntUsuario $usuario = null) {
		$this->db->query("INSERT INTO usuario (nombre, apellido, correo, estatus, fecha_crea, comentario, tipo) VALUES ('{$usuario->getNombre()}', '{$usuario->getApellido()}', '{$usuario->getCorreo()}', '{$usuario->getEstatus()}', '{$usuario->getFechaCrea()}', '{$usuario->getComentario()}', '{$usuario->getTipo()}')");
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}
	
	public function registrarClienteDetalle(EntUsuarioDetalle $usuarioDetalle = null) {
		$this->db->query("INSERT INTO usuario_detalle (IDusuario, cedula, direccion, IDciudad, telefono_casa, fecha_nacimiento, sexo, licencia, licencia_estado, pasaporte, lugar_trabajo, telefono_trabajo, direccion_trabajo, ocupacion, estado_civil, direccion_local, IDciudad_local, telefono_casa_local, celular, tarjeta_credito, expira, conductor_alterno, licencia_alterno, expira_alterno) 
		VALUES ('{$usuarioDetalle->getIdUsuario()}', '{$usuarioDetalle->getCedula()}', '{$usuarioDetalle->getDireccion()}', '{$usuarioDetalle->getCiudad()}', '{$usuarioDetalle->getTelefonoCasa()}', '{$usuarioDetalle->getFechaNacimiento()}', '{$usuarioDetalle->getSexo()}', '{$usuarioDetalle->getLicencia()}', '{$usuarioDetalle->getLicenciaEstado()}', '{$usuarioDetalle->getPasaporte()}', '{$usuarioDetalle->getLugarTrabajo()}', '{$usuarioDetalle->getTelefonoTrabajo()}', '{$usuarioDetalle->getDireccionTrabajo()}', '{$usuarioDetalle->getOcupacion()}', '{$usuarioDetalle->getEstadoCivil()}', '{$usuarioDetalle->getDireccionLocal()}', '{$usuarioDetalle->getCiudadLocal()}', '{$usuarioDetalle->getTelefonoCasaLocal()}', '{$usuarioDetalle->getCelularLocal()}', '{$usuarioDetalle->getTarjetaCredito()}', '{$usuarioDetalle->getExpira()}', '{$usuarioDetalle->getConductorAlterno()}', '{$usuarioDetalle->getLicenciaAlterno()}', '{$usuarioDetalle->getExpiraAlterno()}')");
	}
	
	
	
	public function actualizarCliente(EntUsuario $usuario= null) {
		$this->db->query("UPDATE usuario SET nombre = '{$usuario->getNombre()}', apellido = '{$usuario->getApellido()}', correo = '{$usuario->getCorreo()}', estatus = '{$usuario->getEstatus()}',  comentario = '{$usuario->getComentario()}'
		WHERE IDusuario = '{$usuario->getIdUsuario()}' ");			 
	}
	
	public function actualizarNombreUsuario($nombreUsuario = "", $idUsuario = "") {
		$this->db->query("UPDATE usuario SET usuario = '{$nombreUsuario}' WHERE IDusuario = '{$idUsuario}'");			 
	}
	
	public function actualizarUsuarioPerfil(EntUsuario $usuario= null) {
		$this->db->query("UPDATE usuario SET nombre = '{$usuario->getNombre()}', apellido = '{$usuario->getApellido()}', comentario = '{$usuario->getComentario()}'
		WHERE IDusuario = '{$usuario->getIdUsuario()}' ");
	}
	
	public function actualizarUsuarioDetallePerfil(EntUsuarioDetalle $usuarioDetalle = null) {
		$this->db->query("UPDATE usuario_detalle SET cedula = '{$usuarioDetalle->getCedula()}', fecha_nacimiento = '{$usuarioDetalle->getFechaNacimiento()}', sexo = '{$usuarioDetalle->getSexo()}', direccion = '{$usuarioDetalle->getDireccion()}', telefono_casa = '{$usuarioDetalle->getTelefonoCasa()}', celular = '{$usuarioDetalle->getCelular()}', telefono_trabajo = '{$usuarioDetalle->getTelefonoTrabajo()}', ocupacion = '{$usuarioDetalle->getOcupacion()}', estado_civil = '{$usuarioDetalle->getEstadoCivil()}', IDpais = '{$usuarioDetalle->getIdPais()}', IDtimezone = '{$usuarioDetalle->getIdTimezone()}'
		WHERE IDusuario = '{$usuarioDetalle->getIdUsuario()}' ");
	}
	
	public function actualizarUsuarioDetalleNuevo(EntUsuarioDetalle $usuarioDetalle = null) {
		$this->db->query("UPDATE usuario_detalle SET cedula = '{$usuarioDetalle->getCedula()}'
		WHERE IDusuario = '{$usuarioDetalle->getIdUsuario()}' ");			 
	}
	
	

	
	
	function obtenerUsuarioDetalleIdUsuario($idUsuario = 0) {
		$listaUsuario = array();
		$sql = $this->db->where('IDusuario', $idUsuario);
		$sql = $this->db->get('usuario_detalle');
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$usuarioDetalle = new EntUsuarioDetalle("", "", "", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$usuarioDetalle = new EntUsuarioDetalle($registro['IDusuario'], $registro['cedula'], $registro['fecha_nacimiento'], $registro['sexo'], $registro['direccion'], $registro['telefono_casa'], $registro['celular'], $registro['telefono_trabajo'], $registro['ocupacion'], $registro['estado_civil'], $registro['IDpais'], $registro['IDtimezone']);
		}
		return $usuarioDetalle;
	}
	
	function obtenerUsuarioPerfilIdUsuario($idUsuario = 0) {
		$listaUsuario = array();
		$sql = $this->db->query("SELECT * FROM usuario AS u INNER JOIN usuario_detalle AS ud ON u.IDusuario = ud.IDusuario and u.IDusuario = '{$idUsuario}'");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$usuario = new EntUsuario("", "", "", "", "", "", "", "", "", "");
			$usuarioDetalle = new EntUsuarioDetalle("", "", "", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$usuario = new EntUsuario($registro['IDusuario'], $registro['usuario'], $registro['nombre'], $registro['apellido'], $registro['correo'], $registro['clave'], $registro['estatus'], $registro['fecha_crea'], $registro['comentario'], $registro['tipo']);
			$usuarioDetalle = new EntUsuarioDetalle($registro['IDusuario'], $registro['cedula'], $registro['fecha_nacimiento'], $registro['sexo'], $registro['direccion'], $registro['telefono_casa'], $registro['celular'], $registro['telefono_trabajo'], $registro['ocupacion'], $registro['estado_civil'], $registro['IDpais'], $registro['IDtimezone']);
		}
		return array("usuario"=>$usuario, "detalle"=>$usuarioDetalle);
	}

	function obtenerUsuarioUrlIdUsuario($idUsuario = 0) {
		$listaUsuario = array();
		$sql = $this->db->query("SELECT * FROM usuario AS u INNER JOIN usuario_detalle AS ud ON u.IDusuario = ud.IDusuario and u.IDusuario = '{$idUsuario}'");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$usuario = new EntUsuario("", "", "", "", "", "", "", "", "", "");
			$usuarioDetalle = new EntUsuarioDetalle($usuario, "", "", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$usuario = new EntUsuario($registro['IDusuario'], $registro['usuario'], $registro['nombre'], $registro['apellido'], $registro['correo'], $registro['clave'], $registro['estatus'], $registro['fecha_crea'], $registro['comentario'], $registro['tipo']);
			$usuarioDetalle = new EntUsuarioDetalle($usuario, $registro['cedula'], $registro['fecha_nacimiento'], $registro['sexo'], $registro['direccion'], $registro['telefono_casa'], $registro['celular'], $registro['telefono_trabajo'], $registro['ocupacion'], $registro['estado_civil'], $registro['IDpais'], $registro['IDtimezone']);
		}
		return $usuarioDetalle;
	}
	
	function obtenerUsuarioCorreo($correo = '') {
		$listaUsuario = array();
		$sql = $this->db->where('correo', $correo);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$usuario = new EntUsuario("", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$usuario = new EntUsuario($registro['IDusuario'], $registro['usuario'], $registro['nombre'], $registro['apellido'], $registro['correo'], $registro['clave'], $registro['estatus'], $registro['fecha_crea'], $registro['comentario'], $registro['tipo']);
		}
		return $usuario;
	}
	
	function obtenerUsuarioUsuario($usuario = '') {
		$listaUsuario = array();
		$sql = $this->db->where('usuario', $usuario);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$usuario = new EntUsuario("", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$usuario = new EntUsuario($registro['IDusuario'], $registro['usuario'], $registro['nombre'], $registro['apellido'], $registro['correo'], $registro['clave'], $registro['estatus'], $registro['fecha_crea'], $registro['comentario'], $registro['tipo']);
		}
		return $usuario;
	}
	

	public function existeAsistenteIdAsistente($usuario = '', $idUsuario = 0) {
		$sql = $this->db->where('IDusuario != ', $idUsuario);
		$sql = $this->db->where('usuario', $usuario);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existeIdUsuarioUsuario($idUsuario = 0, $usuario = '') {
		$sql = $this->db->where('IDusuario', $idUsuario);
		$sql = $this->db->where('usuario', $usuario);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existeCedulaIdUsuario($cedula = '', $idUsuario = 0) {
		$sql = $this->db->where('IDusuario != ', $idUsuario);
		$sql = $this->db->where('cedula', $cedula);
		$sql = $this->db->get('usuario_detalle');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	
	
	
	

	public function obtenerUsuariosPorNombre($palabra = ''){
		$query = $this->db->query("SELECT u.IDusuario, u.usuario, u.nombre, u.apellido, u.correo FROM usuario AS u where (u.nombre like '%{$palabra}%' or u.apellido like '%{$palabra}%' or u.nombre +' '+ u.apellido like '%{$palabra}%' or u.usuario like '%{$palabra}%' or u.correo like '%{$palabra}%')");
		return $query;
	}

	public function cambiarEstatus($id, $estatus){
		$this->db->query("UPDATE usuario SET estatus = '{$estatus}' WHERE IDusuario = '{$id}'");
	}
	

	public function modificarUsuario(EntUsuario $usuario = null) {
		$this->db->query("update usuario set nombre = '{$usuario->getNombre()}', apellido = '{$usuario->getApellido()}', apodo = '{$usuario->getApodo()}', cedula = '{$usuario->getCedula()}', limite_credito = {$usuario->getLimiteCredito()}, sexo = '{$usuario->getSexo()}', calle = '{$usuario->getCalle()}', numero = {$usuario->getNumero()}, barrio = '{$usuario->getBarrio()}', IDprovincia = {$usuario->getIdProvincia()}, direccion_vivienda = '{$usuario->getDireccionVivienda()}', direccion_negocio = '{$usuario->getDireccionNegocio()}', ubicacion = '{$usuario->getUbicacion()}', telefono1 = '{$usuario->getTelefono1()}', telefono2 = '{$usuario->getTelefono2()}', celular1 = '{$usuario->getCelular1()}', celular2 = '{$usuario->getCelular2()}', estado_civil = '{$usuario->getEstadoCivil()}', correo = '{$usuario->getCorreo()}', IDpais_nacionalidad = {$usuario->getIdPaisNacionalidad()}, ocupacion = '{$usuario->getOcupacion()}', fecha_nacimiento = '{$usuario->getFechaNacimiento()}' where IDusuario = '{$usuario->getIdUsuario()}'");
	}





	public function obtenerUsuarioRol($idUsuario = 0) {
		$sql = $this->db->query("SELECT ur.*, r.nombre AS 'rol' FROM usuario_rol AS ur INNER JOIN rol AS r ON ur.IDrol = r.IDrol AND ur.IDusuario = '{$idUsuario}'");
		return $sql->result_object();
	}
	
	public function obtenerUsuarioPorNombre($palabra = ''){
			$query = $this->db->query("SELECT * FROM (
SELECT u.IDusuario, CONCAT(u.nombre , ' ' ,u.apellido) AS 'cliente', ud.cedula, ud.pasaporte FROM usuario AS u INNER JOIN usuario_detalle AS ud ON u.IDusuario = ud.IDusuario
) AS t WHERE cliente like '%{$palabra}%' or cedula like '%{$palabra}%' or pasaporte like '%{$palabra}%'");
			return $query;
		}
	
	function obtenerCorreoIdUsuario($idUsuario = 0) {
		$sql = $this->db->where('IDusuario', $idUsuario);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$correo = "";
		} else {
			$registro = $registro[0];
			$correo = $registro['correo'];
		}
		return $correo;
	}


	/**
	 * Api Usuario
	 */
	
	public function obtenerUsuarioPerfil($idUsuario = 0) {
		$sql = $this->db->select('usuario.correo, usuario.nombre, usuario.apellido, usuario.usuario, usuario_detalle.fecha_nacimiento, usuario_detalle.sexo, usuario_detalle.direccion, usuario_detalle.telefono, usuario_detalle.celular, usuario_detalle.estado_civil, usuario_detalle.compartir_nombre, usuario_detalle.compartir_celular, usuario_detalle.compartir_correo, usuario.imagen, usuario_detalle.bio, usuario.url');
		$sql = $this->db->from('usuario');
		$sql = $this->db->join('usuario_detalle', 'usuario.IDusuario = usuario_detalle.IDusuario', 'inner');
		$sql = $this->db->where('usuario.IDusuario', $idUsuario);
		$sql = $this->db->get();
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			$registro->imagenPerfil = "";
			$registro->imagenAgente = "";
			return $registro;
		} else {
			$registro = $registro[0];
			$imagenPerfil = (file_exists(IMAGE_UPLOAD."perfil/perfil-".$registro->imagen) && $registro->imagen != "") ? IMAGEPROFILE."perfil-".$registro->imagen : IMAGEPROFILE."user.png";
			$imagenGame = (file_exists(IMAGE_UPLOAD."perfil/game-".$registro->imagen) && $registro->imagen != "") ? IMAGEPROFILE."game-".$registro->imagen : IMAGEPROFILE."user.png";
			$imagenAgente = (file_exists(IMAGE_UPLOAD."perfil/ag-".$registro->imagen) && $registro->imagen != "") ? IMAGEPROFILE."ag-".$registro->imagen : IMAGEPROFILE."agente.jpg";
			$registro->imagenGame = $imagenGame;
			$registro->imagenPerfil = $imagenPerfil;
			$registro->imagenAgente = $imagenAgente;

			$sqlSocial = $this->db->select('IDtipo_cuenta, url, nombre');
			$sqlSocial = $this->db->from('usuario_social');
			$sqlSocial = $this->db->where('IDusuario', $idUsuario);
			$sqlSocial = $this->db->where('estatus', "A");
			$sqlSocial = $this->db->get();
			$registro->listaSocial = $sqlSocial->result_object();
			foreach ($registro->listaSocial as $usuarioSocial) {
				$usuarioSocial->IDtipo_cuenta = Encryption::encode($usuarioSocial->IDtipo_cuenta);
			}

			return $registro;
		}
	}
	
	public function registrarUsuario($objeto) {
		$this->db->insert('usuario', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	public function registrarSocial($objeto) {
		$this->db->insert('usuario_social', $objeto);
	}

	function eliminarUsuarioSocial($objeto) {
		$this->db->where('IDusuario', $objeto["IDusuario"]);
		$this->db->update('usuario_social', $objeto);
	}


	function crearMensajeContacto($objeto) {
		$this->db->insert('mensaje_contacto', $objeto);
	}

	public function registrarUsuarioDetalle($objeto) {
		$this->db->insert('usuario_detalle', $objeto);
	}

	public function registrarUsuarioRol($objeto) {
		$this->db->insert('usuario_rol', $objeto);
	}

	public function actualizarUsuario($objeto) {
		$this->db->where('IDusuario', $objeto["IDusuario"]);
		$this->db->update('usuario', $objeto);
	}

	public function modificarClaveUsuario($objeto) {
		$this->db->where('IDusuario', $objeto["IDusuario"]);
		$this->db->update('usuario', $objeto);
	}

	public function actualizarUsuarioDetalle($objeto) {
		$this->db->where('IDusuario', $objeto["IDusuario"]);
		$this->db->update('usuario_detalle', $objeto);			 
	}

	public function actualizarToken($idUsuario, $token) {
		$update = array('token' => $token);
		$this->db->where('IDusuario', $idUsuario);
		$this->db->update('usuario', $update);
	}

	function iniciarSesion($usuario = "", $contrasena = "", $social = false, $idTipoCuenta = 0) {
		if ($social) {
			$sql = $this->db->where('usuario', $usuario);
			$sql = $this->db->where('tipo', 2);
			$sql = $this->db->where("estatus", "A");
			$sql = $this->db->get('usuario');
		} else {
			$sql = $this->db->where('usuario', $usuario);
			$sql = $this->db->where('tipo', 1);
			$sql = $this->db->where("estatus in ('A', 'P')");
			$sql = $this->db->get('usuario');
		}
		$registro = $sql->result_object();
		$usuarioSesion = false;
		if ($sql->num_rows() == 0) {
			return array("estatus"=>false, "datoUsuario"=>"", "timezone"=>"");
		} else {
			$usuarioSesion = $registro[0];
			if ($contrasena == $usuarioSesion->contrasena || $social) {
				$listaUsuarioRol = $this->obtenerUsuarioRol($usuarioSesion->IDusuario);
				$idRol = 0;
				$nombreRol = '';
				foreach ($listaUsuarioRol as $usuarioRol) {
					if ($usuarioRol->primario) {
						$idRol = Encryption::encode($usuarioRol->IDrol);
						$nombreRol = $usuarioRol->rol;
						break;
					}
				}
				if ($usuarioSesion->tipo == 1) {
					$imagen = (file_exists(IMAGE_UPLOAD."perfil/".$usuarioSesion->imagen) && $usuarioSesion->imagen != "") ? IMAGEPROFILE.$usuarioSesion->imagen : IMAGEPROFILE."user.png";
				} else {
					$sqlCuenta = $this->db->select('img');
					$sqlCuenta = $this->db->where('IDusuario', $usuarioSesion->IDusuario);
					$sqlCuenta = $this->db->get('cuenta');
					$registroCuenta = $sqlCuenta->result_object();
					$registroCuenta = $registroCuenta[0];
					$imagen = $registroCuenta->img;
				}
				
				$datoUsuario = array("id" => Encryption::encode($usuarioSesion->IDusuario), 'usuario' => Texto::idioma($usuarioSesion->usuario), "nombre" => Texto::idioma($usuarioSesion->nombre), "apellido" => Texto::idioma($usuarioSesion->apellido), "idRol" => $idRol, "nombreRol" => $nombreRol, "estatus"=>$usuarioSesion->estatus, "correo"=>$usuarioSesion->correo, "imagenPerfil"=>$imagen);
				$this->load->Model("ModeloTimezone");
				$timeZone = $this->ModeloTimezone->obtenerTimezonePorIdUsuario($usuarioSesion->IDusuario);
				/**
				 * Log
				 */
				$this->load->model("ModeloLog");
				$fecha = date("Y/m/d H:i:s");
				$ip = $_SERVER["REMOTE_ADDR"];
				$navegador = $_SERVER["HTTP_USER_AGENT"];
				$this->ModeloLog->registrar(new EntLog(0, $usuarioSesion->IDusuario, $ip, $navegador, $fecha, "A"));

				return array("estatus"=>true, "datoUsuario"=>$datoUsuario, "timezone"=>$timeZone);
			} else {
				/**
				 * Log
				 */
				$this->load->model("ModeloLog");
				$fecha = date("Y/m/d H:i:s");
				$ip = $_SERVER["REMOTE_ADDR"];
				$navegador = $_SERVER["HTTP_USER_AGENT"];
				$this->ModeloLog->registrar(new EntLog(0, $usuarioSesion->IDusuario, $ip, $navegador, $fecha, "EC"));

				return array("estatus"=>false, "datoUsuario"=>"", "timezone"=>"");
			}
		}
	}

	function obtenerUsuarioPorIdUsuario($idUsuario = 0) {
		$sql = $this->db->select('IDusuario, contrasena, nombre, apellido, correo');
		$sql = $this->db->where('IDusuario', $idUsuario);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			return $registro;
		} else {
			$registro = $registro[0];
			return $registro;
		}
	}

	function obtenerUsuarioIdUsuario($idUsuario = 0) {
		$sql = $this->db->select('nombre, apellido, correo, tipo');
		$sql = $this->db->where('IDusuario', $idUsuario);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			return $registro;
		} else {
			$registro = $registro[0];
			if ($registro->tipo == 1) {
				$imagen = (file_exists(IMAGE_UPLOAD."perfil/perfil-".$idUsuario.".jpg")) ? IMAGEPROFILE."perfil-".$idUsuario.".jpg" : IMAGEPROFILE."user.png";
			} else {
				$sqlCuenta = $this->db->select('img');
				$sqlCuenta = $this->db->where('IDusuario', $idUsuario);
				$sqlCuenta = $this->db->get('cuenta');
				$registroCuenta = $sqlCuenta->result_object();
				$registroCuenta = $registroCuenta[0];
				$imagen = $registroCuenta->img;
			}
            $registro->img = $imagen;
			return $registro;
		}
	}

	public function existeUsuario($usuario = '') {
		$sql = $this->db->where('usuario', $usuario);
		$sql = $this->db->get('usuario');
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function existeUsuarioToken($token = 0) {
		$sql = $this->db->where('token', $token);
		$sql = $this->db->get('usuario');
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function obtenerUsuarioTokenPendiente($token = 0) {
		$sql = $this->db->select('IDusuario');
		$sql = $this->db->where('token', $token);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_object();
		if ($sql->num_rows > 0) {
			$registro = $registro[0];
			return $registro;
		} else {
			return $registro;
		}
	}

	public function obtenerUsuarioToken($token = 0) {
		$sql = $this->db->select('IDusuario');
		$sql = $this->db->where('token', $token);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_object();
		if ($sql->num_rows > 0) {
			$registro = $registro[0];
			return $registro;
		} else {
			return $registro;
		}
	}
	
	public function existeIdUsuarioClave($idUsuario = '', $clave = '') {
		$sql = $this->db->where('IDusuario', $idUsuario);
		$sql = $this->db->where('clave', $clave);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existeCorreo($correo = '') {
		$sql = $this->db->where('correo', $correo);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existeCedula($cedula = '') {	
		$sql = $this->db->where('cedula', $cedula);
		$sql = $this->db->get('usuario_detalle');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existeCorreoIdUsuario($correo = '', $idUsuario = 0) {
		$sql = $this->db->where('IDusuario != ', $idUsuario);
		$sql = $this->db->where('correo', $correo);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function existeUrlIdUsuario($url = '', $idUsuario = 0) {
		$sql = $this->db->where('IDusuario != ', $idUsuario);
		$sql = $this->db->where('url', $url);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function existeUrlUsuario($url = '') {
		$sql = $this->db->where('url', $url);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function cambiarEstatusUsuario($idUsuario, $estatus) {
		$update = array('estatus' => $estatus);
		$this->db->where('IDusuario', $idUsuario);
		$this->db->update('usuario', $update);
	}

	
	public function obtenerUsuarioActivo($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select("usuario.IDusuario, usuario.usuario, usuario.nombre, usuario.apellido, usuario.correo, usuario.comentario, usuario.estatus, rol.nombre as 'rol', rol.IDrol, usuario.agente");
		$sql = $this->db->from('usuario');
		$sql = $this->db->join('usuario_rol', 'usuario.IDusuario = usuario_rol.IDusuario', 'inner');
		$sql = $this->db->join('rol', 'rol.IDrol = usuario_rol.IDrol', 'inner');
		$sql = $this->db->where('usuario.estatus', 'A');
		if ($busqueda != "") {
			$sql = $this->db->where("(usuario.nombre like '%{$busqueda}%' or usuario.apellido like '%{$busqueda}%' or usuario.usuario like '%{$busqueda}%' or rol.nombre like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("usuario.nombre", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDusuario = ($encode) ? Encryption::encode($registro->IDusuario) : $registro->IDusuario;
			$registro->IDrol = ($encode) ? Encryption::encode($registro->IDrol) : $registro->IDrol;
		}
		return $sql->result_object();
	}

	function existeUsuarioEstatus($idUsuario = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('usuario');
		$sql = $this->db->where('IDusuario', $idUsuario);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	

	function actualizar($objeto) {
		$this->db->where('IDusuario', $objeto["IDusuario"]);
		$this->db->update('usuario', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDusuario', $objeto["IDusuario"]);
		$this->db->update('usuario', $objeto);
	}

	public function actualizarUsuarioRol($objeto) {
		$this->db->where('IDusuario', $objeto["IDusuario"]);
		$this->db->update('usuario_rol', $objeto);
	}

	function obtenerUsuarioPorUsuarioParaClave($usuario = '') {
		$sql = $this->db->select("IDusuario, nombre, apellido, usuario, correo");
		$sql = $this->db->where('usuario', $usuario);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_object();
		if ($sql->num_rows() > 0) {
			$registro = $registro[0];
		}
		return $registro;
	}

	public function existeUsuarioIdUsuario($usuario = '', $idUsuario = 0) {
		$sql = $this->db->where('IDusuario != ', $idUsuario);
		$sql = $this->db->where('usuario', $usuario);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function obtenerAgenteActivo() {
		$sql = $this->db->select("usuario.IDusuario as id, usuario.nombre, usuario.apellido, usuario.correo, rol.nombre as 'rol', usuario_detalle.telefono, usuario_detalle.celular, usuario.imagen, usuario.url, usuario_detalle.bio");
		$sql = $this->db->from('usuario');
		$sql = $this->db->join('usuario_rol', 'usuario.IDusuario = usuario_rol.IDusuario', 'inner');
		$sql = $this->db->join('rol', 'rol.IDrol = usuario_rol.IDrol', 'inner');
		$sql = $this->db->join('usuario_detalle', 'usuario.IDusuario = usuario_detalle.IDusuario', 'inner');
		$sql = $this->db->where('usuario.estatus', 'A');
		$sql = $this->db->where('usuario.agente', '1');
		$sql = $this->db->order_by("usuario.IDusuario", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->agente = $registro->nombre." ".$registro->apellido;
			$imagen = (file_exists(IMAGE_UPLOAD."perfil/ag-".$registro->imagen) && $registro->imagen != "") ? IMAGEPROFILE."ag-".$registro->imagen : IMAGEPROFILE."agente.jpg";
			$registro->imagen = $imagen;
			$sqlSocial = $this->db->select('tipo_cuenta.descripcion, usuario_social.url, usuario_social.nombre');
			$sqlSocial = $this->db->from('usuario_social');
			$sqlSocial = $this->db->join('tipo_cuenta', 'tipo_cuenta.IDtipo_cuenta = usuario_social.IDtipo_cuenta', 'join');
			$sqlSocial = $this->db->where('usuario_social.IDusuario', $registro->id);
			$sqlSocial = $this->db->where('usuario_social.estatus', "A");
			$sqlSocial = $this->db->get();
			$registro->listaSocial = $sqlSocial->result_object();
			$registro->id = Encryption::encode($registro->id);
		}
		return $sql->result_object();
	}

	public function obtenerAgentePorUrl($url = "", $encode = true) {
		$sql = $this->db->select("usuario.IDusuario as id, usuario.nombre, usuario.apellido, usuario.correo, rol.nombre as 'rol', usuario_detalle.telefono, usuario_detalle.celular, usuario.imagen, usuario.url, usuario_detalle.bio");
		$sql = $this->db->from('usuario');
		$sql = $this->db->join('usuario_rol', 'usuario.IDusuario = usuario_rol.IDusuario', 'inner');
		$sql = $this->db->join('rol', 'rol.IDrol = usuario_rol.IDrol', 'inner');
		$sql = $this->db->join('usuario_detalle', 'usuario.IDusuario = usuario_detalle.IDusuario', 'inner');
		$sql = $this->db->where('usuario.estatus', 'A');
		$sql = $this->db->where('usuario.agente', '1');
		$sql = $this->db->where('usuario.url', $url);
		$sql = $this->db->order_by("usuario.nombre", "asc");
		$sql = $this->db->get();
		$registro = $sql->result_object();
		if ($sql->num_rows > 0) {
			$registro = $registro[0];
			$registro->agente = $registro->nombre." ".$registro->apellido;
			$imagen = (file_exists(IMAGE_UPLOAD."perfil/ag-".$registro->imagen) && $registro->imagen != "") ? IMAGEPROFILE."ag-".$registro->imagen : IMAGEPROFILE."agente.jpg";
			$registro->imagen = $imagen;
			if ($encode) {
				// Otras Propiedades
				$this->load->model("ModeloPropiedad");
				$registro->listaOtrasPropiedades = $this->ModeloPropiedad->obtenerPropiedadAgente($registro->id, true);
				//---
				// Social
				$sqlSocial = $this->db->select('tipo_cuenta.descripcion, usuario_social.url, usuario_social.nombre');
				$sqlSocial = $this->db->from('usuario_social');
				$sqlSocial = $this->db->join('tipo_cuenta', 'tipo_cuenta.IDtipo_cuenta = usuario_social.IDtipo_cuenta', 'join');
				$sqlSocial = $this->db->where('usuario_social.IDusuario', $registro->id);
				$sqlSocial = $this->db->where('usuario_social.estatus', "A");
				$sqlSocial = $this->db->get();
				$registro->listaSocial = $sqlSocial->result_object();
				//--
				$registro->id = Encryption::encode($registro->id);
			}
			
			return $registro;
		} else {
			return $registro;
		}
	}
}
?>