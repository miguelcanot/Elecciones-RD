<?php 
	if ( ! defined('APPPATH')) exit('No direct script access allowed');	 
				  
	class EntUsuario { 
		private $idUsuario; 
		private $usuario; 
		private $nombre; 
		private $apellido; 
		private $correo; 
		private $clave; 
		private $estatus; 
		private $fechaCrea; 
		private $comentario;
		private $tipo; 
 
		public function __construct($idUsuario, $usuario, $nombre, $apellido, $correo, $clave, $estatus, $fechaCrea, $comentario, $tipo){
			$this->idUsuario = $idUsuario; 
			$this->usuario = $usuario; 
			$this->nombre = $nombre; 
			$this->apellido = $apellido; 
			$this->correo = $correo; 
			$this->clave = $clave; 
			$this->estatus = $estatus; 
			$this->fechaCrea = $fechaCrea; 
			$this->comentario = $comentario;
			$this->tipo = $tipo; 
		}		/**		
		* 
		* @param int $idUsuario 
		* @key: Usuario_PK 
		*/  
		public function setIdUsuario($idUsuario) { 
			$this->idUsuario = $idUsuario; 
		} 
 
		/**		
		* 
		* @return  int 
		*/
		public function getIdUsuario() { 
			return $this->idUsuario; 
		} 
 
				/**		
		* 
		* @param varchar $usuario 
		*  
		*/  
		public function setUsuario($usuario) { 
			$this->usuario = $usuario; 
		} 
 
		/**		
		* 
		* @return  varchar 
		*/
		public function getUsuario() { 
			return Texto::idioma($this->usuario); 
		} 
 
				/**		
		* 
		* @param varchar $nombre 
		*  
		*/  
		public function setNombre($nombre) { 
			$this->nombre = $nombre; 
		} 
 
		/**		
		* 
		* @return  varchar 
		*/
		public function getNombre() { 
			return Texto::idioma($this->nombre); 
		} 
 
				/**		
		* 
		* @param varchar $apellido 
		*  
		*/  
		public function setApellido($apellido) { 
			$this->apellido = $apellido; 
		} 
 
		/**		
		* 
		* @return  varchar 
		*/
		public function getApellido() { 
			return Texto::idioma($this->apellido); 
		} 
 
				/**		
		* 
		* @param varchar $correo 
		*  
		*/  
		public function setCorreo($correo) { 
			$this->correo = $correo; 
		} 
 
		/**		
		* 
		* @return  varchar 
		*/
		public function getCorreo() { 
			return Texto::idioma($this->correo); 
		} 
 
				/**		
		* 
		* @param varchar $clave 
		*  
		*/  
		public function setClave($clave) { 
			$this->clave = $clave; 
		} 
 
		/**		
		* 
		* @return  varchar 
		*/
		public function getClave() { 
			return Texto::idioma($this->clave); 
		} 
 
				/**		
		* 
		* @param varchar $estatus 
		*  
		*/  
		public function setEstatus($estatus) { 
			$this->estatus = $estatus; 
		} 
 
		/**		
		* 
		* @return  varchar 
		*/
		public function getEstatus() { 
			return Texto::idioma($this->estatus); 
		} 
 
				/**		
		* 
		* @param datetime $fechaCrea 
		*/  
		public function setFechaCrea($fechaCrea) { 
			$this->fechaCrea = $fechaCrea; 
		} 
 
		/**		
		* 
		* @return  datetime 
		*/
		public function getFechaCrea($formato = 'str') { 
			return Texto::setFormatoFecha($this->fechaCrea, $formato); 
		} 
 
				/**		
		* 
		* @param varchar $comentario 
		*  
		*/  
		public function setComentario($comentario) { 
			$this->comentario = $comentario; 
		} 
 
		/**		
		* 
		* @return  varchar 
		*/
		public function getComentario() { 
			return Texto::idioma($this->comentario); 
		} 
		
		public function setTipo($tipo) { 
			$this->tipo = $tipo; 
		} 
 
		public function getTipo() { 
			return $this->tipo; 
		} 
 
			} 
 ?>