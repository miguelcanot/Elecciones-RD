<?php 
	class EntTimezone {
		private $idTimezone;
		private $nombre;
		private $zona;

		function __construct($idTimezone, $nombre, $zona) { 
			$this->idTimezone = $idTimezone; 
			$this->nombre = $nombre; 
			$this->zona = $zona; 
		} 

		public function setIdTimezone($idTimezone) { 
			$this->idTimezone = $idTimezone; 
		} 

		public function getIdTimezone() { 
			return $this->idTimezone; 
		} 

		public function setNombre($nombre) { 
			$this->nombre = $nombre; 
		} 

		public function getNombre() { 
			return $this->nombre; 
		} 

		public function setZona($zona) { 
			$this->zona = $zona; 
		} 

		public function getZona() { 
			return $this->zona; 
		} 
	}
?>