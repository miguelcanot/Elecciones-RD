<?php 
	class EntConfiguracion {
		private $idConfiguracion;
		private $impuesto;
		private $logo;
		private $empresa;
		private $eslogan;
		private $direccion;
		private $telefono;
		private $fax;
		private $email;
		private $emailEnvio;
		private $clave;
		private $host;
		private $puerto;
		private $zonaHorario;

		function __construct($idConfiguracion, $impuesto, $logo, $empresa, $eslogan, $direccion, $telefono, $fax, $email, $emailEnvio, $clave, $host, $puerto, $zonaHorario) { 
			$this->idConfiguracion = $idConfiguracion; 
			$this->impuesto = $impuesto;  
			$this->logo = $logo; 
			$this->empresa = $empresa; 
			$this->eslogan = $eslogan; 
			$this->direccion = $direccion; 
			$this->telefono = $telefono; 
			$this->fax = $fax; 
			$this->email = $email;
			$this->emailEnvio = $emailEnvio; 
			$this->clave = $clave; 
			$this->host = $host; 
			$this->puerto = $puerto;
			$this->zonaHorario = $zonaHorario;   
		} 

		public function setIdConfiguracion($idConfiguracion) { 
			$this->idConfiguracion = $idConfiguracion; 
		} 

		public function getIdConfiguracion() { 
			return $this->idConfiguracion; 
		} 

		public function setImpuesto($impuesto) { 
			$this->impuesto = $impuesto; 
		} 

		public function getImpuesto() { 
			return $this->impuesto; 
		}
		 
		public function setLogo($logo) { 
			$this->logo = $logo; 
		} 

		public function getLogo() { 
			return $this->logo; 
		} 

		public function setEmpresa($empresa) { 
			$this->empresa = $empresa; 
		} 

		public function getEmpresa() { 
			return $this->empresa; 
		} 

		public function setEslogan($eslogan) { 
			$this->eslogan = $eslogan; 
		} 

		public function getEslogan() { 
			return $this->eslogan; 
		} 

		public function setDireccion($direccion) { 
			$this->direccion = $direccion; 
		} 

		public function getDireccion() { 
			return $this->direccion; 
		} 

		public function setTelefono($telefono) { 
			$this->telefono = $telefono; 
		} 

		public function getTelefono() { 
			return $this->telefono; 
		} 

		public function setFax($fax) { 
			$this->fax = $fax; 
		} 

		public function getFax() { 
			return $this->fax; 
		} 

		public function setEmail($email) { 
			$this->email = $email; 
		} 

		public function getEmail() { 
			return $this->email; 
		}

		public function setEmailEnvio($emailEnvio) { 
			$this->emailEnvio = $emailEnvio; 
		} 

		public function getEmailEnvio() { 
			return $this->emailEnvio; 
		} 

		public function setClave($clave) { 
			$this->clave = $clave; 
		} 

		public function getClave() { 
			return $this->clave; 
		} 

		public function setHost($host) { 
			$this->host = $host; 
		} 

		public function getHost() { 
			return $this->host; 
		} 

		public function setPuerto($puerto) { 
			$this->puerto = $puerto; 
		} 

		public function getPuerto() { 
			return $this->puerto; 
		}

		public function setZonaHorario($zonaHorario) { 
			$this->zonaHorario = $zonaHorario; 
		} 

		public function getZonaHorario() { 
			return $this->zonaHorario; 
		}
	}
?>