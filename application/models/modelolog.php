<?php
	class ModeloLog extends CI_Model {
		
		public function obtenerLog() {
			$sql = $this->db->get("log");
			$lista = array();
			foreach ($sql->result_array() as $registro) {
				$lista[] = new EntLog($registro['IDlog'], $registro['IDusuario'], $registro['ip'], $registro['navegador'], $registro['fecha'], $registro['estatus']);
			}
			return $lista;
		}
		
		function registrar(EntLog $entLog) {
			$insert = array('IDusuario' => $entLog->getIdUsuario(),
			'ip' => $entLog->getIp(), 
			'navegador' => $entLog->getNavegador(),
			'fecha' => $entLog->getFecha(),
			'estatus' => $entLog->getEstatus());
			$this->db->insert('log', $insert);
		}
		
		public function obtenerLogIdUsuario($idUsuario = 0) {
			$sql = $this->db->where("IDusuario", $idUsuario);
			$sql = $this->db->get("log");
			$lista = array();
			foreach ($sql->result_array() as $registro) {
				$lista[] = new EntLog($registro['IDlog'], $registro['IDusuario'], $registro['ip'], $registro['navegador'], $registro['fecha'], $registro['estatus']);
			}
			return $lista;
		}
		
		function obtenerLogIdLog($idLog) {
			$sql = $this->db->where("IDlog", $idLog);
			$sql = $this->db->get("log");
			$registro = $sql->result_array();
			if ($sql->num_rows() == 0) {
				return new EntLog("", "", "", "", "", "");
			} else {
				$registro = $registro[0];
				return new EntLog($registro['IDlog'], $registro['IDusuario'], $registro['ip'], $registro['navegador'], $registro['fecha'], $registro['estatus']);
			}
		}
	}
?>