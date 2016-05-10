<?php 
if ( ! defined('APPPATH')) exit('No direct script access allowed');

	class EntPais {
		private $idPais;
		private $descripcion;
		private $nacionalidad;
		private $descripcionIso;

		function __construct($idPais, $descripcion, $nacionalidad, $descripcionIso) { 
			$this->idPais = $idPais; 
			$this->descripcion = $descripcion; 
			$this->nacionalidad = $nacionalidad; 
			$this->descripcionIso = $descripcionIso; 
		} 

		public function setIdPais($idPais) { 
			$this->idPais = $idPais; 
		} 

		public function getIdPais() { 
			return $this->idPais; 
		} 

		public function setDescripcion($descripcion) { 
			$this->descripcion = $descripcion; 
		} 

		public function getDescripcion() { 
			return Texto::primeraMayuscula($this->descripcion); 
		} 

		public function setNacionalidad($nacionalidad) { 
			$this->nacionalidad = $nacionalidad; 
		} 

		public function getNacionalidad() { 
			return Texto::primeraMayuscula($this->nacionalidad); 
		} 

		public function setDescripcionIso($descripcionIso) { 
			$this->descripcionIso = $descripcionIso; 
		} 

		public function getDescripcionIso() { 
			return Texto::primeraMayuscula($this->descripcionIso); 
		} 
	}
?>