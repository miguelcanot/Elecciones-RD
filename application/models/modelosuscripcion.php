<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
/**
 *
 * @category   Db
 * @package    modelos
 * @copyright  Copyright (c) 2013 DominicanCode.
 * @license    ---
 */
/**
 * @see Modelo
 * @see entidades: EntSuscripcion
 */

class ModeloSuscripcion extends CI_Model {

	public function obtenerSuscripcion() {
		$sql = $this->db->get("suscripcion");
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$lista[] = new EntSuscripcion($registro['IDsuscripcion'], $registro['nombre'], $registro['correo'], $registro['fecha'], $registro['estatus']);
		}
		return $lista;
	}
	
	function registrarSuscripcion(EntSuscripcion $suscripcion = null) {
		$this->db->query("INSERT INTO suscripcion(nombre, correo, fecha, estatus) values('{$suscripcion->getNombre()}', '{$suscripcion->getCorreo()}', '{$suscripcion->getFecha()}', '{$suscripcion->getEstatus()}')");
	}

	public function obtenerSuscripcionActivo() {
		$sql = $this->db->where("estatus", "A");
		$sql = $this->db->get("suscripcion");
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$lista[] = new EntSuscripcion($registro['IDsuscripcion'], $registro['nombre'], $registro['correo'], $registro['fecha'], $registro['estatus']);
		}
		return $lista;
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
	
	function registrar(EntSuscripcion $suscripcion = null) {
		$this->db->query("INSERT INTO suscripcion(nombre, correo, fecha, estatus) values('{$suscripcion->getNombre()}', '{$suscripcion->getCorreo()}', '{$suscripcion->getFecha()}', '{$suscripcion->getEstatus()}')");
	}

	function obtenerSuscripcionPorIdSuscripcion($idSuscripcion = 0) {
		$sql = $this->db->where("IDsuscripcion", $idSuscripcion);
		$sql = $this->db->get("suscripcion");		
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$suscripcion = new EntSuscripcion("", "", "", "", "");
		} else {
			$registro = $registro[0];
			$suscripcion = new EntSuscripcion($registro['IDsuscripcion'], $registro['nombre'], $registro['correo'], $registro['fecha'], $registro['estatus']);
		}
		return $suscripcion;
	}

	public function actualizar(EntSuscripcion $suscripcion = null) {
		$this->db->query("UPDATE suscripcion SET nombre = '{$suscripcion->getNombre()}', correo = '{$suscripcion->getCorreo()}' where IDsuscripcion = '{$suscripcion->getIdSuscripcion()}'");
	}

	public function cambiarEstatus($idSuscripcion = 0, $estatus = '') {
		$this->db->query("UPDATE suscripcion SET estatus = '{$estatus}' where IDsuscripcion = '{$idSuscripcion}'");
	}

}
?>