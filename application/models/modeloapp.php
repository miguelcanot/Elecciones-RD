<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
/**
 *
 * @category   Db
 * @package    modelos
 * @copyright  Copyright (c) 2015 DominicanCode.
 * @license    ---
 */

class ModeloApp extends CI_Model {
	public function generarUrl($string, $modelo, $idUsuario = 0) {
		$url = Texto::urlAmigable($string);
		$validada = false;
		$i = 0;
		while (!$validada) {
			$sql = $this->db->where('url', $url);
			if ($idUsuario != 0) {
				$sql = $this->db->where('IDusuario != ', $idUsuario);
			}
			$sql = $this->db->get($modelo);
			$registro = $sql->result_array();
			if ($sql->num_rows > 0) {
				$url = Texto::urlAmigable($string);
				$url .= "-".$i;
			} else {
				$validada = true;
			}
			$i++;
		}
		return $url;
	}

	public function existeCorreoSuscriptor($correo = '') {
		$sql = $this->db->where('correo', $correo);
		$sql = $this->db->get('suscripcion');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function registrarSuscripcion($objeto) {
		$this->db->insert('suscripcion', $objeto);
	}
}

?>