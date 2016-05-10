<?php
	if ( ! defined('APPPATH')) exit('No direct script access allowed'); 
	/**
	 * 
	 * @category   Db
	 * @package    modelos 
	 * @copyright  Copyright (c) 2014 DominicanCode.
	 * @license    ---
	 */
	/**
	 * @see Modelo
	 * @see entidades: EntTimezone
	 */
				  
	class ModeloTimezone extends CI_Model { 

		public function obtenerTimezone() {
			$sql = $this->db->get('timezone');
			$lista = array();
			foreach ($sql->result_array() as $registro) {
				$lista[] = new EntTimezone($registro['IDtimezone'], $registro['nombre'], $registro['zona']);
			}
			return $lista;
		} 
 
		function obtenerTimezonePorIdTimezone($idTimezone = 0) {
			$listaUsuario = array();
			$sql = $this->db->where('IDtimezone', $idTimezone);
			$sql = $this->db->get('timezone');
			$registro = $sql->result_array();
			if ($sql->num_rows() == 0) {
				$timezone = new EntTimezone("", "", "");
			} else {
				$registro = $registro[0];
				$timezone = new EntTimezone($registro['IDtimezone'], $registro['nombre'], $registro['zona']); 	
			}
			return $timezone;
		} 
		
		function obtenerTimezonePorIdUsuario($idUsuario = 0) {
			$listaUsuario = array();
			$sql = $this->db->query("SELECT t.zona FROM usuario AS u INNER JOIN usuario_detalle as ud on u.IDusuario = ud.IDusuario
			inner join timezone AS t ON ud.IDtimezone = t.IDtimezone
			where u.IDusuario = '{$idUsuario}'");
			$registro = $sql->result_array();
			if ($sql->num_rows() == 0) {
				$timezone = "America/Santo_Domingo";
			} else {
				$registro = $registro[0];
				$timezone = $registro['zona'];
			}
			return $timezone;
		}
		
		function obtenerTimezonePorIdUsuarioArray($idUsuario = 0) {
			$listaUsuario = array();
			$sql = $this->db->query("SELECT t.zona, t.nombre FROM usuario AS u INNER JOIN usuario_detalle as ud on u.IDusuario = ud.IDusuario
					inner join timezone AS t ON ud.IDtimezone = t.IDtimezone
					where u.IDusuario = '{$idUsuario}'");
			$registro = $sql->result_array();
			if ($sql->num_rows() == 0) {
				$timezone = "America/Santo_Domingo";
				$nombre = "(GMT-04:00) La Paz";
			} else {
				$registro = $registro[0];
				$nombre = $registro['nombre'];
				$timezone = $registro['zona'];
			}
			return array("zona"=>$timezone, "nombre"=>$nombre);
		}
	} 
 ?>