<?php 
	class EntUsuarioRol {
		private $idUsuario;
		private $idRol;
		private $primario;

		function __construct($idUsuario, $idRol, $primario) { 
			$this->idUsuario = $idUsuario; 
			$this->idRol = $idRol; 
			$this->primario = $primario; 
		} 

		public function setIdUsuario($idUsuario) { 
			$this->idUsuario = $idUsuario; 
		} 

		public function getIdUsuario() { 
			return $this->idUsuario; 
		} 

		public function setIdRol($idRol) { 
			$this->idRol = $idRol; 
		} 

		public function getIdRol() { 
			return $this->idRol; 
		} 

		public function setPrimario($primario) { 
			$this->primario = $primario; 
		} 

		public function getPrimario() { 
			return $this->primario; 
		} 
	}
?>