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
 * @see entidades: EntContacto
 */

class ModeloContacto extends CI_Model {

	public function obtenerContacto($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('mensaje_contacto.*');
		$sql = $this->db->from('mensaje_contacto');
		$sql = $this->db->where("estatus in ('A', 'P')");
		if ($busqueda != "") {
			$sql = $this->db->where("(nombre like '%{$busqueda}%' or correo like '%{$busqueda}%' or telefono like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("fecha", "desc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDmensaje_contacto = ($encode) ? Encryption::encode($registro->IDmensaje_contacto) : $registro->IDmensaje_contacto;
		}
		return $sql->result_object();
	}

	function existeContactoEstatus($idContacto = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('mensaje_contacto');
		$sql = $this->db->where('IDmensaje_contacto', $idContacto);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function registrar($objeto) {
		$this->db->insert('mensaje_contacto', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($objeto) {
		$this->db->where('IDmensaje_contacto', $objeto["IDmensaje_contacto"]);
		$this->db->update('mensaje_contacto', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDmensaje_contacto', $objeto["IDmensaje_contacto"]);
		$this->db->update('mensaje_contacto', $objeto);
	}

}
?>