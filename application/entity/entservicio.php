<?php 
	class EntServicio {
		private $idServicio;
		private $nombre;
		private $descripcion;
		private $comentario;
		private $estatus;

		function __construct($idServicio, $nombre, $descripcion, $comentario, $icono, $estatus) { 
			$this->idServicio = $idServicio;  
			$this->nombre = $nombre; 
			$this->descripcion = $descripcion; 
			$this->comentario = $comentario; 
			$this->icono = $icono;
			$this->estatus = $estatus; 
		} 

		public function setIdServicio($idServicio) { 
			$this->idServicio = $idServicio; 
		} 

		public function getIdServicio() { 
			return $this->idServicio; 
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

		public function setComentario($comentario) { 
			$this->comentario = $comentario; 
		} 

		public function getComentario() { 
			return $this->comentario; 
		} 

		public function setIcono($icono) { 
			$this->icono = $icono; 
		} 

		public function getIcono() { 
			return $this->icono; 
		} 

		public function setEstatus($estatus) { 
			$this->estatus = $estatus; 
		} 

		public function getEstatus() { 
			return $this->estatus; 
		} 
	}
?>