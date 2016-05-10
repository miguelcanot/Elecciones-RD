<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
/**
 *
 * @category   Db
 * @package    modelos
 * @copyright  Copyright (c) 2016 DominicanCode.
 * @license    ---
 */
/**
 * @see Modelo
 * @see entidades: PostSocial
 */

class ModeloPostSocial extends CI_Model {


	public function obtenerPostSocialActivoJson($encode = false) {
		$sql = $this->db->where('Estatus', "A");
		$sql = $this->db->order_by("Fecha", "desc");
		$sql = $this->db->get("post_social");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDPostSocial = Encryption::encode($registro->IDPostSocial);
				$registro->Imagen = (empty($registro->Imagen)) ? IMAGEPROFILE."user.png" : $registro->Imagen;
			}
		}
		return $sql->result_object();
	}
	
	public function obtenerPostSocialConfigActivo($encode = false) {
		$sql = $this->db->select('post_social_config.*, tipo_cuenta.nombre as TipoCuenta, tipo_cuenta.descripcion as Icono');
		$sql = $this->db->join('tipo_cuenta', 'tipo_cuenta.IDtipo_cuenta = post_social_config.IDTipoCuenta', 'inner');
		$sql = $this->db->where('post_social_config.Estatus', "A");
		$sql = $this->db->order_by("Descripcion", "asc");
		$sql = $this->db->get("post_social_config");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDPostSocialConfig = ($encode) ? Encryption::encode($registro->IDPostSocialConfig) : $registro->IDPostSocialConfig;
				$registro->IDTipoCuenta = ($encode) ? Encryption::encode($registro->IDTipoCuenta) : $registro->IDTipoCuenta;
			}
		}
		return $sql->result_object();
	}

	public function obtenerPostSocial($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('post_social.*, tipo_cuenta.nombre as TipoCuenta, tipo_cuenta.descripcion as Icono');
		$sql = $this->db->from('post_social');
		$sql = $this->db->join('tipo_cuenta', 'tipo_cuenta.IDtipo_cuenta = post_social.IDTipoCuenta', 'inner');
		//$sql = $this->db->where('estatus', 'A');
		if ($busqueda != "") {
			$sql = $this->db->where("(tipo_cuenta.descripcion like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("Estatus", "desc");
		$sql = $this->db->order_by("Fecha", "desc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDPostSocial = ($encode) ? Encryption::encode($registro->IDPostSocial) : $registro->IDPostSocial;
			//$registro->IDPostSocial = ($encode) ? Encryption::encode($registro->IDPostSocial) : $registro->IDPostSocial;
		}
		return $sql->result_object();
	}

	function existePostSocialEstatus($idPostSocial = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('post_social');
		$sql = $this->db->where('IDPostSocial', $idPostSocial);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function registrar($objeto) {
		$this->db->insert('post_social', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($objeto) {
		$this->db->where('IDPostSocial', $objeto["IDPostSocial"]);
		$this->db->update('post_social', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDPostSocial', $objeto["IDPostSocial"]);
		$this->db->update('post_social', $objeto);
	}
	
	function eliminarConfig($objeto) {
		$this->db->where('IDPostSocialConfig', $objeto["IDPostSocialConfig"]);
		$this->db->update('post_social_config', $objeto);
	}
	
	function registrarConfig($objeto) {
		$this->db->insert('post_social_config', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}
	
	function obtenerHashtag($string = "") {
		$this->load->model("ModeloSocial");
		$social = $this->ModeloSocial->obtenerSocialActivoIdTipo(2);
		$this->load->library('twitter/twitteroauth');
		$consumerKey    = $social->access_token; //inserta tu consumer key</span>
		$consumerSecret = $social->access_token_secret; //inserta tu consumer secret</span>
		$tweet = new TwitterOAuth($consumerKey, $consumerSecret);
		$lista = array();
		$sql = $this->db->select('Id');
		$sql = $this->db->from('post_social');
		$sql = $this->db->limit(1);
		$sql = $this->db->order_by("Fecha", "desc");
		$sql = $this->db->get();
		$ultimoId = "";
		if ($sql->num_rows() > 0) {
			$registro = $sql->result_object();
			$registro = $registro[0];
			$ultimoId = $registro->Id;
		}
		$resultado = $tweet->get('https://api.twitter.com/1.1/search/tweets.json', array('q' => urlencode("#EleccionesRD2016"), "count"=>"100", "since_id"=>$ultimoId));
		foreach ($resultado->statuses as $registro) {
			$fechaT = strtotime($registro->created_at);
			$fecha = date("Y/m/d H:i:s", $fechaT);
			$imagen = (isset($registro->user->profile_image_url)) ? $registro->user->profile_image_url : "";
			$objeto = array("RT"=>$registro->retweet_count, "Cuerpo"=>$registro->text, "Usuario"=>$registro->user->screen_name, "Nombre"=>$registro->user->name, "Estatus"=>"P", "Fecha"=>$fecha, "Id"=>$registro->id_str, "Imagen"=>$imagen, "IDTipoCuenta"=>2);
			$this->registrar($objeto);
		}
		return true;
	}
	
	function obtenerPublicacionSocial() {
		//Config Twitter
		$this->load->model("ModeloSocial");
		$social = $this->ModeloSocial->obtenerSocialActivoIdTipo(2);
		$this->load->library('twitter/twitteroauth');
		$consumerKey    = $social->access_token; //inserta tu consumer key</span>
		$consumerSecret = $social->access_token_secret; //inserta tu consumer secret</span>
		$tweet = new TwitterOAuth($consumerKey, $consumerSecret);

		$sqlConfig = $this->db->where('Estatus', "A");
		$sqlConfig = $this->db->get("post_social_config");
		foreach ($sqlConfig->result_object() as $registroConfig) {
			if ($registroConfig->IDTipoCuenta == 2) {
				$pre = ($registroConfig->Tipo == "H") ? "#" : (($registroConfig->Tipo == "A") ? "@" : "" );
				//Ultimo ID
				$sql = $this->db->select('Id');
				$sql = $this->db->from('post_social');
				$sql = $this->db->where('IDPostSocialConfig', $registroConfig->IDPostSocialConfig);
				$sql = $this->db->limit(1);
				$sql = $this->db->order_by("Fecha", "desc");
				$sql = $this->db->get();
				$ultimoId = "";
				if ($sql->num_rows() > 0) {
					$registro = $sql->result_object();
					$registro = $registro[0];
					$ultimoId = $registro->Id;
				}
				
				$resultado = $tweet->get('https://api.twitter.com/1.1/search/tweets.json', array('q' => urlencode($pre.$registroConfig->Descripcion), "count"=>"100", "since_id"=>$ultimoId));
				foreach ($resultado->statuses as $registro) {
					$fechaT = strtotime($registro->created_at);
					$fecha = date("Y/m/d H:i:s", $fechaT);
					$imagen = (isset($registro->user->profile_image_url)) ? $registro->user->profile_image_url : "";
					$objeto = array("RT"=>$registro->retweet_count, "Cuerpo"=>$registro->text, "Usuario"=>$registro->user->screen_name, "Nombre"=>$registro->user->name, "Estatus"=>"P", "Fecha"=>$fecha, "Id"=>$registro->id_str, "Imagen"=>$imagen, "IDTipoCuenta"=>2, "IDPostSocialConfig"=>$registroConfig->IDPostSocialConfig);
					$this->registrar($objeto);
				}
			}
		}
		return true;
	}
	
	public function obtenerCantidadPostSocial() {
		$sql = $this->db->query("SELECT (SELECT COUNT(IDPostSocial) AS cantidad FROM post_social WHERE Estatus = 'A') AS A, (SELECT COUNT(IDPostSocial) AS cantidad FROM post_social WHERE Estatus = 'P') AS P");
		if ($sql->num_rows() == 0) {
			return $sql->result_object();
		} else {
			$registro = $sql->result_object();
			$registro = $registro[0];
			return $registro;
		}
	}	


}
?>