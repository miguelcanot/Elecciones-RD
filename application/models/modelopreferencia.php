<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');if ( ! defined('APPPATH')) exit('No direct script access allowed');
/**
 *
 * @category   Db
 * @package    modelos
 * @copyright  Copyright (c) 2014 DominicanCode.
 * @license    ---
 */
/**
 * @see Modelo
 * @see entidades: EntPago
 *
 */
class ModeloPreferencia extends CI_Model {


	public function obtenerPreferenciaSinResponder($ip = 0, $limite = 10, $idApliacion = 0, $categoria = "", $encode = true) {
		$sql = $this->db->query("select IDpreferencia as id, frase, opcion_1, opcion_2, info, opcion_1_total, opcion_2_total from preferencia where estatus = 'A' and IDapp = '{$idApliacion}' and IDpreferencia not in (select IDpreferencia from preferencia_respuesta where ip = '{$ip}' and IDapp = '{$idApliacion}') ORDER BY RAND() limit 10");
		//$sql = $this->db->from('preferencia');
		//$sql = $this->db->where('estatus', 'A');
		//$sql = $this->db->limit($limite, 0);
		//$sql = $this->db->order_by("id", "random"); 
		//$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$sqlRespuesta = $this->db->query("SELECT (SELECT COUNT(IDpreferencia_respuesta) FROM preferencia_respuesta WHERE IDpreferencia = '{$registro->id}' AND opcion = 1) AS opcion1,
			(SELECT COUNT(IDpreferencia_respuesta) FROM preferencia_respuesta WHERE IDpreferencia = '{$registro->id}' AND opcion = 2) AS opcion2");
			$respuesta = $sqlRespuesta->result_object();
			if ($sqlRespuesta->num_rows() > 0) {
				$registroRespuesta = $respuesta[0];
				$registro->cro1 = $registroRespuesta->opcion1;
				$registro->cro2 = $registroRespuesta->opcion2;
				//$total = $registroRespuesta->opcion1 + $registroRespuesta->opcion2;
				//$registro->pro1 = ($total == 0) ? 50 : ($registroRespuesta->opcion1 * 100) / $total;
				//$registro->pro2 = ($total == 0) ? 50 :($registroRespuesta->opcion2 * 100) / $total;
				$total = $registro->opcion_1_total + $registro->opcion_2_total;
				$registro->pro1 = ($total == 0) ? 50 : ($registro->opcion_1_total * 100) / $total;
				$registro->pro2 = ($total == 0) ? 50 :($registro->opcion_2_total * 100) / $total;
				$registro->opcion_1_total = Texto::formatoMoneda($registro->opcion_1_total, 0, "");
				$registro->opcion_2_total = Texto::formatoMoneda($registro->opcion_2_total, 0, "");
			}
			$registro->id = ($encode) ? Encryption::encode($registro->id) : $registro->id;
		}
		return $sql->result_object();
	}

	public function obtenerPreferenciaRand($idApliacion = 0, $sexo = "", $categoria = "", $encode = true) {
		$sexo = ($sexo != "") ? " and sexo = '{$sexo}'" : '';
		$sql = $this->db->query("select IDpreferencia as id, frase from preferencia where estatus = 'A' and IDapp = '{$idApliacion}' {$sexo} ORDER BY RAND() limit 1");
		//$sql = $this->db->from('preferencia');
		//$sql = $this->db->where('estatus', 'A');
		//$sql = $this->db->limit($limite, 0);
		//$sql = $this->db->order_by("id", "random"); 
		//$sql = $this->db->get();
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			return $registro;
		} else {
			$registro = $registro[0];
			$registro->id = ($encode) ? Encryption::encode($registro->id) : $registro->id;
			return $registro;
		}
	}

	public function obtenerPreferenciaId($idPreferencia = 0, $encode = true) {
		$sql = $this->db->where('IDpreferencia', $idPreferencia);
		$sql = $this->db->get('preferencia');
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			return $registro;
		} else {
			$registro = $registro[0];
			return $registro;
		}
	}

	public function registrarPreferenciaRespuesta($objeto) {
		$this->db->insert('preferencia_respuesta', $objeto);
	}


	/**
	 * Api Usuario
	 */
	
	public function obtenerUsuarioPerfil($idUsuario = 0) {
		$sql = $this->db->select('usuario.correo, usuario.nombre, usuario.apellido, usuario.usuario, usuario_detalle.fecha_nacimiento, usuario_detalle.sexo, usuario_detalle.direccion, usuario_detalle.telefono, usuario_detalle.celular, usuario_detalle.estado_civil, usuario_detalle.compartir_nombre, usuario_detalle.compartir_celular, usuario_detalle.compartir_correo');
		$sql = $this->db->from('usuario');
		$sql = $this->db->join('usuario_detalle', 'usuario.IDusuario = usuario_detalle.IDusuario', 'inner');
		$sql = $this->db->where('usuario.IDusuario', $idUsuario);
		$sql = $this->db->get();
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			return $registro;
		} else {
			$registro = $registro[0];
			return $registro;
		}
	}
	
	public function registrarPreferencia($objeto) {
		$this->db->insert('usuario', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	public function registrarPreferenciaDetalle($objeto) {
		$this->db->insert('usuario_detalle', $objeto);
	}

	

	public function actualizarPreferencia($objeto) {
		$this->db->where('IDusuario', $objeto["IDusuario"]);
		$this->db->where('IDmedico', $objeto["IDmedico"]);
		$this->db->update('usuario', $objeto);
	}

	public function actualizarPreferenciaDetalle($objeto) {
		$this->db->where('IDusuario', $objeto["IDusuario"]);
		$this->db->update('usuario_detalle', $objeto);			 
	}

	public function existeUsuarioIdPreferencia($usuario = '', $idUsuario = 0) {
		$sql = $this->db->where('IDusuario != ', $idUsuario);
		$sql = $this->db->where('usuario', $usuario);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function existeUsuario($usuario = '') {
		$sql = $this->db->where('usuario', $usuario);
		$sql = $this->db->get('usuario');
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function existeCorreo($correo = '') {
		$sql = $this->db->where('correo', $correo);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existeCedula($cedula = '') {	
		$sql = $this->db->where('cedula', $cedula);
		$sql = $this->db->get('usuario_detalle');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existeCorreoIdPreferencia($correo = '', $idUsuario = 0) {
		$sql = $this->db->where('IDusuario != ', $idUsuario);
		$sql = $this->db->where('correo', $correo);
		$sql = $this->db->get('usuario');
		$registro = $sql->result_array();
		if ($sql->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function existePreferenciaEstatus($idUsuario = 0, $idMedico = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('usuario');
		$sql = $this->db->where('IDusuario', $idUsuario);
		$sql = $this->db->where('IDmedico', $idMedico);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
}
?>