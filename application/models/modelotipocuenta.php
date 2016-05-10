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
 * @see entidades: EntTipoCuenta
 */

class ModeloTipoCuenta extends CI_Model {

	public function obtenerTipoCuentaActivo($encode = false) {
		$sql = $this->db->where('estatus', 'A');
		$sql = $this->db->order_by("nombre", "asc");
		$sql = $this->db->get('tipo_cuenta');
		foreach ($sql->result_object() as $registro) {
			$registro->IDtipo_cuenta = ($encode) ? Encryption::encode($registro->IDtipo_cuenta) : $registro->IDtipo_cuenta;
		}
		return $sql->result_object();
	}

}
?>