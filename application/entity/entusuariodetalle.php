<?php 
	class EntUsuarioDetalle {
		private $idUsuario;
		private $cedula;
		private $fechaNacimiento;
		private $sexo;
		private $direccion;
		private $telefonoCasa;
		private $celular;
		private $telefonoTrabajo;
		private $ocupacion;
		private $estadoCivil;
		private $idPais;

		function __construct($idUsuario, $cedula, $fechaNacimiento, $sexo, $direccion, $telefonoCasa, $celular, $telefonoTrabajo, $ocupacion, $estadoCivil, $idPais, $idTimezone) { 
			$this->idUsuario = $idUsuario; 
			$this->cedula = $cedula; 
			$this->fechaNacimiento = $fechaNacimiento; 
			$this->sexo = $sexo; 
			$this->direccion = $direccion; 
			$this->telefonoCasa = $telefonoCasa; 
			$this->celular = $celular; 
			$this->telefonoTrabajo = $telefonoTrabajo; 
			$this->ocupacion = $ocupacion; 
			$this->estadoCivil = $estadoCivil; 
			$this->idPais = $idPais;
			$this->idTimezone = $idTimezone;
		} 

		public function setIdUsuario($idUsuario) { 
			$this->idUsuario = $idUsuario; 
		} 

		public function getIdUsuario() { 
			return $this->idUsuario; 
		} 

		public function setCedula($cedula) { 
			$this->cedula = $cedula; 
		} 

		public function getCedula() { 
			return $this->cedula; 
		} 

		public function setFechaNacimiento($fechaNacimiento) { 
			$this->fechaNacimiento = $fechaNacimiento; 
		} 

		public function getFechaNacimiento() { 
			return $this->fechaNacimiento; 
		} 

		public function setSexo($sexo) { 
			$this->sexo = $sexo; 
		} 

		public function getSexo() { 
			return $this->sexo; 
		} 

		public function setDireccion($direccion) { 
			$this->direccion = $direccion; 
		} 

		public function getDireccion() { 
			return $this->direccion; 
		} 

		public function setTelefonoCasa($telefonoCasa) { 
			$this->telefonoCasa = $telefonoCasa; 
		} 

		public function getTelefonoCasa() { 
			return $this->telefonoCasa; 
		} 

		public function setCelular($celular) { 
			$this->celular = $celular; 
		} 

		public function getCelular() { 
			return $this->celular; 
		} 

		public function setTelefonoTrabajo($telefonoTrabajo) { 
			$this->telefonoTrabajo = $telefonoTrabajo; 
		} 

		public function getTelefonoTrabajo() { 
			return $this->telefonoTrabajo; 
		} 

		public function setOcupacion($ocupacion) { 
			$this->ocupacion = $ocupacion; 
		} 

		public function getOcupacion() { 
			return $this->ocupacion; 
		} 

		public function setEstadoCivil($estadoCivil) { 
			$this->estadoCivil = $estadoCivil; 
		} 

		public function getEstadoCivil() { 
			return $this->estadoCivil; 
		} 
		
		public function setIdPais($idPais) {
			$this->idPais = $idPais;
		}
		
		public function getIdPais() {
			return $this->idPais;
		}
		
		public function setIdTimezone($idTimezone) {
			$this->idTimezone = $idTimezone;
		}
		
		public function getIdTimezone() {
			return $this->idTimezone;
		}
	}
?>