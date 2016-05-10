<?php 
	class EntMensajePredeterminado {
		private $idMensajePredeterminado;
		private $idUsuario;
		private $descripcion;
		private $comentario;
		private $estatus;

		function __construct($idMensajePredeterminado, $idUsuario, $descripcion, $comentario, $estatus) { 
			$this->idMensajePredeterminado = $idMensajePredeterminado; 
			$this->idUsuario = $idUsuario; 
			$this->descripcion = $descripcion; 
			$this->comentario = $comentario; 
			$this->estatus = $estatus; 
		} 

		public function setIdMensajePredeterminado($idMensajePredeterminado) { 
			$this->idMensajePredeterminado = $idMensajePredeterminado; 
		} 

		public function getIdMensajePredeterminado() { 
			return $this->idMensajePredeterminado; 
		} 

		public function setIdUsuario($idUsuario) { 
			$this->idUsuario = $idUsuario; 
		} 

		public function getIdUsuario() { 
			return $this->idUsuario; 
		} 

		public function setDescripcion($descripcion) { 
			$this->descripcion = $descripcion; 
		} 

		public function getDescripcion() { 
			return $this->descripcion; 
		} 

		public function setComentario($comentario) { 
			$this->comentario = $comentario; 
		} 

		public function getComentario() { 
			return $this->comentario; 
		} 

		public function setEstatus($estatus) { 
			$this->estatus = $estatus; 
		} 

		public function getEstatus() { 
			return $this->estatus; 
		} 
	}
?>