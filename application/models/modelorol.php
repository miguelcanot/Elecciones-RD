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
 * @see entidades: EntRol
 */

class ModeloRol extends CI_Model {

	public function obtenerRolActivoJson() {
		$sql = $this->db->where('estatus', "A");
		$sql = $this->db->get("rol");
		foreach ($sql->result_object() as $registro) {
			$idCrc = Encryption::encodeCrc($registro->IDrol);
			$registro->IDrol = Encryption::encode($registro->IDrol);
		}
		return $sql->result_object();
	}

	public function obtenerRol($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('rol.*');
		$sql = $this->db->from('rol');
		if ($busqueda != "") {
			$sql = $this->db->like('nombre', $busqueda);
			$sql = $this->db->or_like('descripcion', $busqueda);
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("nombre", "asc");
		$sql = $this->db->get();
		
		foreach ($sql->result_object() as $registro) {
			$registro->IDrol = ($encode) ? Encryption::encode($registro->IDrol) : $registro->IDrol;
		}
		return $sql->result_object();
	}

	public function obtenerRolActivo($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('rol.*');
		$sql = $this->db->from('rol');
		$sql = $this->db->where('estatus', 'A');
		if ($busqueda != "") {
			$sql = $this->db->where("(nombre like '%{$busqueda}%' or descripcion like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("nombre", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDrol = ($encode) ? Encryption::encode($registro->IDrol) : $registro->IDrol;
		}
		return $sql->result_object();
	}

	function existeRolEstatus($idRol = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('rol');
		$sql = $this->db->where('IDrol', $idRol);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	function registrar($objeto) {
		$this->db->insert('rol', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($objeto) {
		$this->db->where('IDrol', $objeto["IDrol"]);
		$this->db->update('rol', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDrol', $objeto["IDrol"]);
		$this->db->update('rol', $objeto);
	}
	


}
?>