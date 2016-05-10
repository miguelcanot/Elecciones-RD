<?php 
	class EntRol {
		private $idRol;
		private $nombre;
		private $descripcion;
		private $estatus;

		function __construct($idRol, $nombre, $descripcion, $estatus) { 
			$this->idRol = $idRol; 
			$this->nombre = $nombre; 
			$this->descripcion = $descripcion; 
			$this->estatus = $estatus; 
		} 

		public function setIdRol($idRol) { 
			$this->idRol = $idRol; 
		} 

		public function getIdRol() { 
			return $this->idRol; 
		} 

		public function setNombre($nombre) { 
			$this->nombre = $nombre; 
		} 

		public function getNombre() { 
			return $this->nombre; 
		} 

		public function setDescripcion($descripcion) { 
			$this->descripcion = $descripcion; 
		} 

		public function getDescripcion() { 
			return $this->descripcion; 
		} 

		public function setEstatus($estatus) { 
			$this->estatus = $estatus; 
		} 

		public function getEstatus() { 
			return $this->estatus; 
		} 
	}
?>