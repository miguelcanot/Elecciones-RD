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
 * @see entidades: EntServicio
 */

class ModeloServicio extends CI_Model {


	function registrarContenido($objeto) {
		//$wordpress = $this->load->database('wordpress', TRUE);
		$this->db->insert('post', $objeto);
	}

	function existePost($nombre = "") {
		//$wordpress = $this->load->database('wordpress', TRUE);
		$sql = $this->db->where('cond', $nombre);
		$sql = $this->db->get('post');
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function registrarObjeto($objeto, $tabla = "") {
		//$wordpress = $this->load->database('wordpress', TRUE);
		$this->db->insert($tabla, $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function existeObjeto($nombre = "", $tabla = "", $campo = "") {
		//$wordpress = $this->load->database('wordpress', TRUE);
		$sql = $this->db->where($campo, $nombre);
		$sql = $this->db->get($tabla);
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function actualizarObjeto($objeto, $tabla = "") {
		//$wordpress = $this->load->database('wordpress', TRUE);
		$this->db->where('ID'+$tabla, $objeto["ID"+$tabla]);
		$this->db->update($tabla, $objeto);
	}

	function actualizarPreferencia($objeto, $tabla = "") {
		//$wordpress = $this->load->database('wordpress', TRUE);
		$this->db->where('opcion_1', $objeto["opcion_1"]);
		$this->db->update($tabla, $objeto);
	}


	/**
	 *
	 *
	 *
	 *
	 * 
	 */


	public function obtenerServicio() {
		$sql = $this->db->get("servicio");
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$lista[] = new EntServicio($registro['IDservicio'], $registro['nombre'], $registro['descripcion'], $registro['comentario'], $registro['icono'], $registro['estatus']);
		}
		return $lista;
	}

	public function obtenerServicioActivo($json = false) {
		$sql = $this->db->where('estatus', "A");
		$sql = $this->db->get("servicio");
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			if ($json) {
				$lista[] = array("id"=>Encryption::encode($registro['IDservicio']), "nombre"=>$registro['nombre'], "descripcion"=>$registro['descripcion'], "comentario"=>$registro['comentario'], "icono"=>$registro['icono'], "estatus"=>$registro['estatus']);
			} else {
				$lista[] = new EntServicio($registro['IDservicio'], $registro['nombre'], $registro['descripcion'], $registro['comentario'], $registro['icono'], $registro['estatus']);
			}
		}
		return $lista;
	}

	public function registrar(EntServicio $servicio = null) {
		$this->db->query("INSERT INTO servicio (nombre, descripcion, comentario, icono, estatus)
			 VALUES ('{$servicio->getNombre()}', '{$servicio->getDescripcion()}', '{$servicio->getComentario()}', '{$servicio->getIcono()}', '{$servicio->getEstatus()}')");
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function obtenerServicioPorIdServicio($idServicio = 0) {
		$sql = $this->db->where('IDservicio', $idServicio);
		$sql = $this->db->get("servicio");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$servicio = new EntServicio("", "", "", "", "");
		} else {
			$registro = $registro[0];
			$servicio = new EntServicio($registro['IDservicio'], $registro['nombre'], $registro['descripcion'], $registro['comentario'], $registro['icono'], $registro['estatus']);
		}
		return $servicio;
	}

	public function actualizar(EntServicio $servicio = null) {
		$this->db->query("UPDATE servicio SET nombre = '{$servicio->getNombre()}', descripcion = '{$servicio->getDescripcion()}', comentario = '{$servicio->getComentario()}', icono = '{$servicio->getIcono()}' where IDservicio = '{$servicio->getIdServicio()}'");
	}

	public function cambiarEstatus($idServicio = 0, $estatus = '') {
		$this->db->query("UPDATE servicio SET estatus = '{$estatus}' where IDservicio = '{$idServicio}'");
	}

	/**
	 * Combustible
	 */
	
	public function obtenerCombustible($fecha = "") {
		if ($fecha != "") {
			$sql = $this->db->where("fecha like '%{$fecha}%'");
		}
		$sql = $this->db->where('estatus', "A");
		$sql = $this->db->order_by('nombre', "asc");
		$sql = $this->db->get("combustible");
		foreach ($sql->result_object() as $registro) {
			$fechaDia = Texto::obtenerDiaSemana(Texto::setFormatoFecha($registro->fecha, "w"))." ".Texto::setFormatoFecha($registro->fecha, 'd')." de ".Texto::obtenerNombreDelMes(Texto::setFormatoFecha($registro->fecha, 'm '));
			$fechaTiempo = Texto::setFormatoFecha($registro->fecha, 'h:i a');
			$fecha = $fechaDia.", ".$fechaTiempo.".";
			$registro->fecha = $fecha;
			$registro->valor = Texto::formatoMoneda($registro->valor, 2, "RD$");
		}
		return $sql->result_object();
	}

	function registrarCombustible($objeto) {
		$this->db->insert('combustible', $objeto);
	}

	function desactivarCombustible() {
		$objeto = array('estatus' => "I");
		$this->db->where('estatus', "A");
		$this->db->update('combustible', $objeto);
	}

	/**
	 * Moneda
	 */
	
	public function obtenerMoneda($fecha = "") {
		if ($fecha != "") {
			$sql = $this->db->where("fecha like '%{$fecha}%'");
		}
		$sql = $this->db->where('estatus', "A");
		$sql = $this->db->order_by('nombre', "asc");
		$sql = $this->db->get("moneda");
		foreach ($sql->result_object() as $registro) {
			$fechaDia = Texto::obtenerDiaSemana(Texto::setFormatoFecha($registro->fecha, "w"))." ".Texto::setFormatoFecha($registro->fecha, 'd')." de ".Texto::obtenerNombreDelMes(Texto::setFormatoFecha($registro->fecha, 'm '));
			$fechaTiempo = Texto::setFormatoFecha($registro->fecha, 'h:i a');
			$fecha = $fechaDia.", ".$fechaTiempo.".";
			$registro->fecha = $fecha;
			$registro->compra = Texto::formatoMoneda($registro->compra, 2, "");
			$registro->venta = Texto::formatoMoneda($registro->venta, 2, "");
			$registro->remesas = Texto::formatoMoneda($registro->remesas, 2, "");
		}
		return $sql->result_object();
	}

	function registrarMoneda($objeto) {
		$this->db->insert('moneda', $objeto);
	}

	function desactivarMoneda() {
		$objeto = array('estatus' => "I");
		$this->db->where('estatus', "A");
		$this->db->update('moneda', $objeto);
	}

	/**
	 * Loteria
	 */
	
	public function obtenerLoteria($fecha = "") {
		if ($fecha != "") {
			$sql = $this->db->where("fecha like '%{$fecha}%'");
		}
		$sql = $this->db->where('estatus', "A");
		$sql = $this->db->order_by('nombre', "asc");
		$sql = $this->db->get("loteria");
		foreach ($sql->result_object() as $registro) {
			$fechaDia = Texto::obtenerDiaSemana(Texto::setFormatoFecha($registro->fecha, "w"))." ".Texto::setFormatoFecha($registro->fecha, 'd')." de ".Texto::obtenerNombreDelMes(Texto::setFormatoFecha($registro->fecha, 'm '));
			$fechaTiempo = Texto::setFormatoFecha($registro->fecha, 'h:i a');
			$fecha = $fechaDia.", ".$fechaTiempo.".";
			$registro->fecha = $fecha;
		}
		return $sql->result_object();
	}

	function registrarLoteria($objeto) {
		$this->db->insert('loteria', $objeto);
	}

	function desactivarLoteria() {
		$objeto = array('estatus' => "I");
		$this->db->where('estatus', "A");
		$this->db->update('loteria', $objeto);
	}

	/**
	 * Horoscopo
	 */
	
	public function obtenerHoroscopo($fecha = "") {
		if ($fecha != "") {
			$sql = $this->db->where("fecha like '%{$fecha}%'");
		}
		$sql = $this->db->where('estatus', "A");
		$sql = $this->db->order_by('nombre', "asc");
		$sql = $this->db->get("horoscopo");
		foreach ($sql->result_object() as $registro) {
			$fechaDia = Texto::obtenerDiaSemana(Texto::setFormatoFecha($registro->fecha, "w"))." ".Texto::setFormatoFecha($registro->fecha, 'd')." de ".Texto::obtenerNombreDelMes(Texto::setFormatoFecha($registro->fecha, 'm '));
			$fechaTiempo = Texto::setFormatoFecha($registro->fecha, 'h:i a');
			$fecha = $fechaDia.", ".$fechaTiempo.".";
			$registro->fecha = $fecha;
		}
		return $sql->result_object();
	}

	function registrarHoroscopo($objeto) {
		$this->db->insert('horoscopo', $objeto);
	}

	function desactivarHoroscopo() {
		$objeto = array('estatus' => "I");
		$this->db->where('estatus', "A");
		$this->db->update('horoscopo', $objeto);
	}


}
?>