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
 * @see entidades: Recinto
 */

class ModeloRecinto extends CI_Model {


	public function obtenerRecinto($encode = false) {
		$sql = $this->db->order_by("Nombre", "asc");
		$sql = $this->db->get("recinto");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDRecinto = Encryption::encode($registro->IDRecinto);
			}
		}
		return $sql->result_object();
	}

	public function obtenerRecintoIdMunicipio($idMunicipio = "", $encode = false) {
		$sql = $this->db->where("IDMunicipio", $idMunicipio);
		$sql = $this->db->order_by("Nombre", "asc");
		$sql = $this->db->get("recinto");
		foreach ($sql->result_object() as $registro) {
			$registro->IDRecinto = ($encode) ? Encryption::encode($registro->IDRecinto) : $registro->IDRecinto;
			$registro->IDMunicipio = ($encode) ? Encryption::encode($registro->IDMunicipio) : $registro->IDMunicipio;
		}
        return $sql->result_object();
	}

	public function obtenerRecintoActivo($encode = false) {
		$sql = $this->db->select('recinto.*');
		$sql = $this->db->from('recinto');
        $sql = $this->db->where("Estatus", "A");
		$sql = $this->db->order_by("Nombre", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDRecinto = ($encode) ? Encryption::encode($registro->IDRecinto) : $registro->IDRecinto;
		}
		return $sql->result_object();
	}	
	
	function existeRecintoEstatus($idRecinto = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('recinto');
		$sql = $this->db->where('IDRecinto', $idRecinto);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function registrar($objeto) {
		$this->db->insert('recinto', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($objeto) {
		$this->db->where('IDRecinto', $objeto["IDRecinto"]);
		$this->db->update('recinto', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDRecinto', $objeto["IDRecinto"]);
		$this->db->update('recinto', $objeto);
	}

}
?>