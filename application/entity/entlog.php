<?php 
	class EntLog {
		private $idLog;
		private $idUsuario;
		private $ip;
		private $navegador;
		private $fecha;
		private $estatus;

		function __construct($idLog, $idUsuario, $ip, $navegador, $fecha, $estatus) { 
			$this->idLog = $idLog; 
			$this->idUsuario = $idUsuario; 
			$this->ip = $ip; 
			$this->navegador = $navegador; 
			$this->fecha = $fecha; 
			$this->estatus = $estatus; 
		} 

		public function setIdLog($idLog) { 
			$this->idLog = $idLog; 
		} 

		public function getIdLog() { 
			return $this->idLog; 
		} 

		public function setIdUsuario($idUsuario) { 
			$this->idUsuario = $idUsuario; 
		} 

		public function getIdUsuario() { 
			return $this->idUsuario; 
		} 

		public function setIp($ip) { 
			$this->ip = $ip; 
		} 

		public function getIp() { 
			return $this->ip; 
		} 

		public function setNavegador($navegador) { 
			$this->navegador = $navegador; 
		} 

		public function getNavegador() { 
			return $this->navegador; 
		} 

		public function setFecha($fecha) { 
			$this->fecha = $fecha; 
		} 

		public function getFecha() { 
			return $this->fecha; 
		} 

		public function setEstatus($estatus) { 
			$this->estatus = $estatus; 
		} 

		public function getEstatus() { 
			return $this->estatus; 
		} 

	}
?>