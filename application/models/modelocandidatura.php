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
 * @see entidades: Candidatura
 */

class ModeloCandidatura extends CI_Model {


	public function obtenerCandidatura($encode = false) {
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->get("candidatura");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDcandidatura = Encryption::encode($registro->IDcandidatura);
			}
		}
		return $sql->result_object();
	}

	public function obtenerCandidaturaActivoJson($encode = false, $autoComplete = false, $busqueda = "", $filtro = "") {
		$sql = $this->db->select($filtro);
		$sql = $this->db->distinct();
		$sql = $this->db->like($filtro, $busqueda, 'both');
		$sql = $this->db->order_by($filtro, "asc");
		$sql = $this->db->limit(20);
		$sql = $this->db->get("candidatura");
		$lista = array();
		if ($autoComplete) {
			foreach ($sql->result_object() as $registro) {
				$lista[] = $registro->$filtro;
			}
			return $lista;
		} else {
			foreach ($sql->result_object() as $registro) {
				if ($encode) {
					$registro->IDCandidatura = Encryption::encode($registro->IDCandidatura);
				}
			}
			return $sql->result_object();
		}
	}

	public function obtenerCandidaturaActivo($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('candidatura.*');
		$sql = $this->db->from('candidatura');
		if ($busqueda != "") {
			$sql = $this->db->where("(Nombres like '%{$busqueda}%' or Nivel like '%{$busqueda}%' or Demarcacion like '%{$busqueda}%' or Cargo like '%{$busqueda}%' or Posicion like '%{$busqueda}%' or Partido like '%{$busqueda}%' or Siglas like '%{$busqueda}%' or Sexo like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("Nombres", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDCandidatura = ($encode) ? Encryption::encode($registro->IDCandidatura) : $registro->IDCandidatura;
		}
		return $sql->result_object();
	}	
	
	function existeCandidaturaEstatus($idCandidatura = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('candidatura');
		$sql = $this->db->where('IDcandidatura', $idCandidatura);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function registrar($objeto) {
		$this->db->insert('candidatura', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($objeto) {
		$this->db->where('IDcandidatura', $objeto["IDcandidatura"]);
		$this->db->update('candidatura', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDcandidatura', $objeto["IDcandidatura"]);
		$this->db->update('candidatura', $objeto);
	}

}
?>