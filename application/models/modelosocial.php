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
 * @see entidades: EntSocial
 */

class ModeloSocial extends CI_Model {


	public function obtenerSocial($encode = false) {
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->get("social");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDsocial = Encryption::encode($registro->IDsocial);
			}
		}
		return $sql->result_object();
	}

	public function obtenerSocialActivoJson($encode = false) {
		$sql = $this->db->select('social.*, tipo_cuenta.nombre');
		$sql = $this->db->where('social.estatus', "A");
		$sql = $this->db->join('tipo_cuenta', 'social.IDtipo_cuenta = social.IDtipo_cuenta', 'join');
		$sql = $this->db->get("social");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDsocial = Encryption::encode($registro->IDsocial);
			}
		}
		return $sql->result_object();
	}

	public function obtenerSocialActivo($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('social.*, tipo_cuenta.nombre as tipoCuenta');
		$sql = $this->db->join('tipo_cuenta', 'social.IDtipo_cuenta = tipo_cuenta.IDtipo_cuenta', 'join');
		$sql = $this->db->where('social.estatus', 'A');
		if ($busqueda != "") {
			$sql = $this->db->where("(tipo_cuenta.nombre like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("tipo_cuenta.nombre", "asc");
		$sql = $this->db->get('social');
		foreach ($sql->result_object() as $registro) {
			$registro->IDsocial = ($encode) ? Encryption::encode($registro->IDsocial) : $registro->IDsocial;
			$registro->IDtipo_cuenta = ($encode) ? Encryption::encode($registro->IDtipo_cuenta) : $registro->IDtipo_cuenta;
			$registro->access_token = Encryption::decode($registro->access_token);
			$registro->access_token_secret = Encryption::decode($registro->access_token_secret);
		}
		return $sql->result_object();
	}


	public function obtenerSocialActivoIdTipo($idTipoCuenta = 0, $encode = false) {
		$sql = $this->db->select('social.*');
		$sql = $this->db->where('estatus', 'A');
		$sql = $this->db->where('IDtipo_cuenta', $idTipoCuenta);
		$sql = $this->db->get('social');
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			return $registro;
		} else {
			$registro = $registro[0];
			$registro->access_token = Encryption::decode($registro->access_token);
			$registro->access_token_secret = Encryption::decode($registro->access_token_secret);
			return $registro;
		}
	}

	function existeSocialEstatus($idSocial = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('social');
		$sql = $this->db->where('IDsocial', $idSocial);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function registrar($objeto) {
		$this->db->insert('social', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($objeto) {
		$this->db->where('IDsocial', $objeto["IDsocial"]);
		$this->db->update('social', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDsocial', $objeto["IDsocial"]);
		$this->db->update('social', $objeto);
	}

}
?>