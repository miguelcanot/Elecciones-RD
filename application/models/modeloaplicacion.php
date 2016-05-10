<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
/**
 *
 * @category   Db
 * @package    modelos
 * @copyright  Copyright (c) 2015 DominicanCode.
 * @license    ---
 */
/**
 * @see Modelo
 * @see entidades: EntAplicacion
 */

class ModeloAplicacion extends CI_Model {

	public function obtenerAplicacionActivoJson($encode = false) {
		$sql = $this->db->where('estatus', "A");
		$sql = $this->db->order_by("app", "asc");
		$sql = $this->db->get("app");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDapp = Encryption::encode($registro->IDapp);
			}
			$imagen = (file_exists(IMAGE_UPLOAD."app/".$registro->img) && $registro->img != "") ? IMAGEAPP.$registro->img : IMAGEAPP."default.jpg";
			$registro->img = $imagen;
		}
		return $sql->result_object();
	}

	public function obtenerAplicacion($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('IDapp, nombre, descripcion, fecha, img, callback_url, estatus, web');
		$sql = $this->db->from('app');
		if ($busqueda != "") {
			$sql = $this->db->where("(descripcion like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("nombre", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->like = 0;
			$sqlLike = $this->db->query("SELECT COUNT(ip) AS cantidad FROM (SELECT DISTINCT ip FROM app_like WHERE IDapp = '{$registro->IDapp}') AS t");
			$like = $sqlLike->result_object();
			if ($sqlLike->num_rows() > 0) {
				$registroLike = $like[0];
				$registro->like = $registroLike->cantidad;
			}
			$registro->fecha = Texto::setFormatoFecha($registro->fecha, "M d, Y");
			$registro->IDapp = ($encode) ? Encryption::encode($registro->IDapp) : $registro->IDapp;
			$registro->imgBlock = (file_exists(IMAGE_UPLOAD."app/"."block-".$registro->img) && $registro->img != "") ? IMAGEAPP."block-".$registro->img : IMAGEAPP."default.jpg";
			$registro->imgMin = (file_exists(IMAGE_UPLOAD."app/"."min-".$registro->img) && $registro->img != "") ? IMAGEAPP."min-".$registro->img : IMAGEAPP."default.jpg";
		}
		return $sql->result_object();
	}

	public function obtenerAplicacionActivo($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('app.IDapp as id, nombre, descripcion, fecha, img, callback_url');
		$sql = $this->db->from('app');
		$sql = $this->db->where('estatus', 'A');
		if ($busqueda != "") {
			$sql = $this->db->where("(descripcion like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("nombre", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->like = 0;
			$sqlLike = $this->db->query("SELECT COUNT(ip) AS cantidad FROM (SELECT DISTINCT ip FROM app_like WHERE IDapp = '{$registro->id}') AS t");
			$like = $sqlLike->result_object();
			if ($sqlLike->num_rows() > 0) {
				$registroLike = $like[0];
				$registro->like = $registroLike->cantidad;
			}
			$registro->fecha = Texto::setFormatoFecha($registro->fecha, "M d, Y");
			$registro->id = ($encode) ? Encryption::encode($registro->id) : $registro->id;
			//$registro->imgFull = (file_exists(IMAGE_UPLOAD."app/"."full-".$registro->img) && $registro->img != "") ? IMAGEAPP."full-".$registro->img : IMAGEAPP."default.jpg";
			$registro->imgBlock = (file_exists(IMAGE_UPLOAD."app/"."block-".$registro->img) && $registro->img != "") ? IMAGEAPP."block-".$registro->img : IMAGEAPP."default.jpg";
			$registro->imgMin = (file_exists(IMAGE_UPLOAD."app/"."min-".$registro->img) && $registro->img != "") ? IMAGEAPP."min-".$registro->img : IMAGEAPP."default.jpg";
		}
		return $sql->result_object();
	}

	public function obtenerAplicacionDetalle($idAplicacion, $encode = false) {
		$sql = $this->db->select('app.IDapp as id, nombre, descripcion, fecha, img, callback_url, web');
		$sql = $this->db->from('app');
		$sql = $this->db->where('estatus', 'A');
		$sql = $this->db->where('IDapp', $idAplicacion);
		$sql = $this->db->get();
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			return $registro;
		} else {
			$registro = $registro[0];
			$registro->like = 0;
			$sqlLike = $this->db->query("SELECT COUNT(ip) AS cantidad FROM (SELECT DISTINCT ip FROM app_like WHERE IDapp = '{$registro->id}') AS t");
			$like = $sqlLike->result_object();
			if ($sqlLike->num_rows() > 0) {
				$registroLike = $like[0];
				$registro->like = $registroLike->cantidad;
			}
			$registro->fecha = Texto::setFormatoFecha($registro->fecha, "M d, Y");
			$registro->id = ($encode) ? Encryption::encode($registro->id) : $registro->id;
			$registro->imgPost = (file_exists(IMAGE_UPLOAD."app/"."post-".$registro->img) && $registro->img != "") ? IMAGEAPP."post-".$registro->img : IMAGEAPP."default.jpg";
			$registro->imgBlock = (file_exists(IMAGE_UPLOAD."app/"."block-".$registro->img) && $registro->img != "") ? IMAGEAPP."block-".$registro->img : IMAGEAPP."default.jpg";
			$registro->imgMin = (file_exists(IMAGE_UPLOAD."app/"."min-".$registro->img) && $registro->img != "") ? IMAGEAPP."min-".$registro->img : IMAGEAPP."default.jpg";
			return $registro;
		}
	}

	function existeAplicacionEstatus($idAplicacion = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('app');
		$sql = $this->db->where('IDapp', $idAplicacion);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function registrar($objeto) {
		$this->db->insert('app', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($objeto) {
		$this->db->where('IDapp', $objeto["IDapp"]);
		$this->db->update('app', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDapp', $objeto["IDapp"]);
		$this->db->update('app', $objeto);
	}


		
	public function obtenerAppIdUsuarioActivo($idUsuario = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("estatus", 'A');
		$sql = $this->db->get("app");
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$lista[] = EntApp($registro['IDapp'], $registro['IDusuario'], $registro['nombre'], $registro['descripcion'], $registro['web'], $registro['callback_url'], $registro['img'], $registro['fecha'], $registro['estatus']);
		}
		return $lista;
	}
	
	function obtenerAppIdUsuarioIdApp($idUsuario, $idApp) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("IDapp", $idApp);
		$sql = $this->db->get("app");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return new EntApp("", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			return new EntApp($registro['IDapp'], $registro['IDusuario'], $registro['nombre'], $registro['descripcion'], $registro['web'], $registro['callback_url'], $registro['img'], $registro['fecha'], $registro['estatus']);
		}
	}
	
	function obtenerAppIdApp($idApp) {
		$sql = $this->db->where("IDapp", $idApp);
		$sql = $this->db->get("app");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return new EntApp("", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			return new EntApp($registro['IDapp'], $registro['IDusuario'], $registro['nombre'], $registro['descripcion'], $registro['web'], $registro['callback_url'], $registro['img'], $registro['fecha'], $registro['estatus']);
		}
	}
	
	public function cambiarEstatusApp($idUsuario = 0, $idApp = 0, $estatus = "") {
		$sql = $this->db->query("update app set estatus = '{$estatus}' where IDusuario = '{$idUsuario}' and IDapp = '{$idApp}'");
	}
	
	public function cambiarImagenApp($idUsuario = 0, $idApp = 0, $imagen = "") {
		$sql = $this->db->query("update app set img = '{$imagen}' where IDusuario = '{$idUsuario}' and IDapp = '{$idApp}'");
	}
	
	public function existeAppIdAppIdUsuario($idApp = 0, $idUsuario = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("IDapp", $idApp);
		$sql = $this->db->get("app");
		$lista = array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existeAppKeyKeySecretoActivo($key = "", $keySecreto = "") {
		//$sql = $this->db->where("estatus", "A");
		$sql = $this->db->where("key", $key);
		$sql = $this->db->where("key_secreto", $keySecreto);
		$sql = $this->db->get("app_token");
		$lista = array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}


	function registrarLike($objeto) {
		$this->db->insert('app_like', $objeto);
	}

	/**
	* App token
	*/
	private function rand_chars($c, $l, $u = FALSE) { 
		if (!$u) for ($s = '', $i = 0, $z = strlen($c)-1; $i < $l; $x = rand(0,$z), $s .= $c{$x}, $i++); 
		else for ($i = 0, $z = strlen($c)-1, $s = $c{rand(0,$z)}, $i = 1; $i != $l; $x = rand(0,$z), $s .= $c{$x}, $s = ($s{$i} == $s{$i-1} ? substr($s,0,-1) : $s), $i=strlen($s)); 
		return $s; 
	} 
	
	function generarToken() {
		$codigo = rand().$this->rand_chars("ASDAMMXQW", 7);
		$token = Encryption::encode($codigo);
		$tokenSecreto = Encryption::encode($this->rand_chars("VFSAYDBHJQNNX", 10));
		return array("token"=>$token, "tokenSecreto"=>$tokenSecreto);
	}
	
	function registrarAppToken(EntAppToken $appToken) {
		$insert = array('IDapp' => $appToken->getIdApp(),
		'key' => $appToken->getKey(),
		'key_secreto' => $appToken->getKeySecreto(), 
		'fecha' => $appToken->getFecha());
		$this->db->insert('app_token', $insert);
	}
	
	function obtenerAppTokenIdApp($idApp) {
		$sql = $this->db->where("IDapp", $idApp);
		$sql = $this->db->get("app_token");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return new EntAppToken("", "", "", "", "");
		} else {
			$registro = $registro[0];
			return new EntAppToken($registro['IDapp_token'], $registro['IDapp'], $registro['key'], $registro['key_secreto'], $registro['fecha']);
		}
	}

}
?>