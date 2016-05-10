<?php 
	class EntSuscripcion {
		private $idSuscripcion;
		private $nombre;
		private $correo;
		private $fecha;
		private $estatus;

		function __construct($idSuscripcion, $nombre, $correo, $fecha, $estatus) { 
			$this->idSuscripcion = $idSuscripcion; 
			$this->nombre = $nombre; 
			$this->correo = $correo; 
			$this->fecha = $fecha; 
			$this->estatus = $estatus; 
		} 

		public function setIdSuscripcion($idSuscripcion) { 
			$this->idSuscripcion = $idSuscripcion; 
		} 

		public function getIdSuscripcion() { 
			return $this->idSuscripcion; 
		} 

		public function setNombre($nombre) { 
			$this->nombre = $nombre; 
		} 

		public function getNombre() { 
			return $this->nombre; 
		} 

		public function setCorreo($correo) { 
			$this->correo = $correo; 
		} 

		public function getCorreo() { 
			return $this->correo; 
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