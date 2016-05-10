<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class ModeloConfiguracion extends CI_Model {
	
	/*
	 * Configuracion
	 */
	
	function obtenerConfig() {
		$sql = $this->db->get("configuracion");
		if ($sql->num_rows() == 0) {
			$registro = $sql->result_object();
		} else {
			$registro = $sql->result_object();
			$registro = $registro[0];
		}
		return $registro;
	}

	function obtenerConfiguracion() {
		$sql = $this->db->select("*");
		$sql = $this->db->get("configuracion");
		if ($sql->num_rows() == 0) {
			$registro = $sql->result_object();
		} else {
			$registro = $sql->result_object();
			$registro = $registro[0];
		}
		return $registro;
	}

	function obtenerInformacionGeneral() {
		$sql = $this->db->select("email, direccion, empresa, eslogan, fax, telefono, logo");
		$sql = $this->db->get("configuracion");
		if ($sql->num_rows() == 0) {
			$registro = $sql->result_object();
		} else {
			$registro = $sql->result_object();
			$registro = $registro[0];
			$registro->logo = (file_exists(IMAGE_UPLOAD.$registro->logo) && $registro->logo != "") ? IMAGE.$registro->logo : IMAGE."logo.png";
		}
		return $registro;
	}

	function actualizar($objeto) {
		$this->db->where('IDconfiguracion', $objeto["IDconfiguracion"]);
		$this->db->update('configuracion', $objeto);
	}
	
	function obtenerConfiguracionIdConfiguracion($idConfiguracion = 0) {
		$sql = $this->db->where('IDconfiguracion', $idConfiguracion);
		$sql = $this->db->get("configuracion");
		$registro = $sql->result();
		if ($sql->num_rows() == 0) {
			$configuracion = new EntConfiguracion("", "", "", "", "", "", "", "", "", "", "", 0, "");
		} else {
			$registro = $registro[0];
			$configuracion = new EntConfiguracion($registro->IDconfiguracion, $registro->logo, $registro->empresa, $registro->eslogan, $registro->direccion, $registro->telefono, $registro->fax, $registro->email, $registro->email_envio, $registro->clave, $registro->host, $registro->puerto, $registro->zona_horario);	
		}
		return $configuracion;
	}
	
	/*
	public function crearConfiguracion(EntConfiguracion $formaPago = NULL) {
		$this->db->query("INSERT INTO forma_pago (impuesto, descripcion, comentario, estatus) VALUES ('{$formaPago->getIdUsuario()}', '{$formaPago->getDescripcion()}', '{$formaPago->getComentario()}', '{$formaPago->getEstatus()}')");
	}
	*/
	
	public function modificarConfiguracion(EntConfiguracion $configuracion = NULL) {
		$this->db->query("update configuracion set empresa = '{$configuracion->getEmpresa()}', eslogan = '{$configuracion->getEslogan()}', direccion = '{$configuracion->getDireccion()}', telefono = '{$configuracion->getTelefono()}', fax = '{$configuracion->getFax()}', email = '{$configuracion->getEmail()}', logo = '{$configuracion->getLogo()}', email_envio = '{$configuracion->getEmailEnvio()}', clave = '{$configuracion->getClave()}', host = '{$configuracion->getHost()}', puerto = '{$configuracion->getPuerto()}', zona_horario = '{$configuracion->getZonaHorario()}'  where IDconfiguracion = '{$configuracion->getIdConfiguracion()}'");
	}
}
?>