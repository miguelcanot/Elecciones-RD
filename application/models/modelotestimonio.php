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
 * @see entidades: EntTestimonio
 */

class ModeloTestimonio extends CI_Model {


	public function obtenerTestimonio($encode = false) {
		$sql = $this->db->order_by("fecha", "desc");
		$sql = $this->db->get("testimonio");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDtestimonio = Encryption::encode($registro->IDtestimonio);
			}
		}
		return $sql->result_object();
	}

	public function obtenerTestimonioActivo($encode = false) {
		$sql = $this->db->where('estatus', "A");
		$sql = $this->db->order_by("fecha", "desc");
		$sql = $this->db->get("testimonio");
		foreach ($sql->result_object() as $registro) {
			if ($encode) {
				$registro->IDtestimonio = Encryption::encode($registro->IDtestimonio);
			}
			$registro->imagen = (file_exists(IMAGE_UPLOAD."testimonio/".$registro->imagen) && $registro->imagen != "") ? IMAGETESTIMONIO.$registro->imagen : IMAGETESTIMONIO."default.jpg";
		}
		return $sql->result_object();
	}

	function registrar($objeto) {
		$this->db->insert('testimonio', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($update, $objeto) {
		$this->db->where('IDtestimonio', $objeto["IDtestimonio"]);
		$this->db->update('testimonio', $update);
	}
	
	function cambiarEstatus($objeto) {
		$this->db->where('IDtestimonio', $objeto["IDtestimonio"]);
		$this->db->update('testimonio', $update);
	}

}
?>