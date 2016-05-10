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
 * @see entidades: Municipio
 */

class ModeloMunicipio extends CI_Model {


	public function obtenerMunicipio($encode = false) {
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->get("municipio");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDMunicipio = Encryption::encode($registro->IDMunicipio);
			}
		}
		return $sql->result_object();
	}

	public function obtenerMunicipioActivoJson($encode = false, $autoComplete = false, $busqueda = "", $filtro = "") {
		$sql = $this->db->select($filtro);
		$sql = $this->db->distinct();
		$sql = $this->db->like($filtro, $busqueda, 'both');
		$sql = $this->db->order_by($filtro, "asc");
		$sql = $this->db->limit(20);
		$sql = $this->db->get("municipio");
		$lista = array();
		if ($autoComplete) {
			foreach ($sql->result_object() as $registro) {
				$lista[] = $registro->$filtro;
			}
			return $lista;
		} else {
			foreach ($sql->result_object() as $registro) {
				if ($encode) {
					$registro->IDMunicipio = Encryption::encode($registro->IDMunicipio);
				}
			}
			return $sql->result_object();
		}
	}

	public function obtenerMunicipioActivo($encode = false) {
		$sql = $this->db->select('municipio.*');
		$sql = $this->db->from('municipio');
        $sql = $this->db->where("Estatus", "A");
		$sql = $this->db->order_by("Nombre", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDMunicipio = ($encode) ? Encryption::encode($registro->IDMunicipio) : $registro->IDMunicipio;
		}
		return $sql->result_object();
	}	
	
	function existeMunicipioEstatus($idMunicipio = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('municipio');
		$sql = $this->db->where('IDMunicipio', $idMunicipio);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function registrar($objeto) {
		$this->db->insert('municipio', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($objeto) {
		$this->db->where('IDMunicipio', $objeto["IDMunicipio"]);
		$this->db->update('municipio', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDMunicipio', $objeto["IDMunicipio"]);
		$this->db->update('municipio', $objeto);
	}

}
?>