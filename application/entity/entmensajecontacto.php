<?php 
	if ( ! defined('APPPATH')) exit('No direct script access allowed');	 
				  
	class EntMensajeContacto { 
		private $idMensajeContacto;
		private $correo;
		private $nombre; 
		private $mensaje;
		private $fecha;
		private $estatus; 
 
		function __construct($idMensajeContacto, $correo, $nombre, $mensaje, $fecha, $estatus) {
			$this->idMensajeContacto = $idMensajeContacto;
			$this->correo = $correo;
			$this->nombre = $nombre; 
			$this->mensaje = $mensaje;
			$this->fecha = $fecha;
			$this->estatus = $estatus; 
		}		/**		
		* 
		* @param int $idMensajeContacto
		*  
		*/  
		public function setIdMensajeContacto($idMensajeContacto) { 
			$this->idMensajeContacto = $idMensajeContacto; 
		} 
 
		/**		
		* 
		* @return  int 
		*/
		public function getIdMensajeContacto() { 
			return $this->idMensajeContacto; 
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
		
		public function setCorreo($correo) {
			$this->correo = $correo;
		}

		public function getCorreo() {
			return $this->correo;
		}
 
				/**		
		* 
		* @param varchar $mensaje 
		*  
		*/  
		public function setMensaje($mensaje) { 
			$this->mensaje = $mensaje; 
		} 
 
		/**		
		* 
		* @return  varchar 
		*/
		public function getMensaje() { 
			return Texto::idioma($this->mensaje); 
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
			return $this->estatus; 
		} 
		
		public function setFecha($fecha) {
			$this->fecha = $fecha;
		}
		
		public function getFecha() {
			return $this->fecha;
		}
 
			} 
 ?>