<?php 
	class EntTipoCuenta {
		private $idTipoCuenta;
		private $nombre;
		private $descripcion;
		private $estatus;

		function __construct($idTipoCuenta, $nombre, $descripcion, $estatus) { 
			$this->idTipoCuenta = $idTipoCuenta; 
			$this->nombre = $nombre; 
			$this->descripcion = $descripcion; 
			$this->estatus = $estatus; 
		} 

		public function setIdTipoCuenta($idTipoCuenta) { 
			$this->idTipoCuenta = $idTipoCuenta; 
		} 

		public function getIdTipoCuenta() { 
			return $this->idTipoCuenta; 
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