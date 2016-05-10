<?php 
	class EntCuenta {
		private $idCuenta;
		private $idUsuario;
		private $descripcion;
		private $idTipoCuenta;
		private $id;
		private $accessToken;
		private $accessTokenSecret;
		private $primario;
		private $estatus;
		private $img;

		function __construct($idCuenta, $idUsuario, $descripcion, $idTipoCuenta, $id, $accessToken, $accessTokenSecret, $primario, $estatus, $img) { 
			$this->idCuenta = $idCuenta; 
			$this->idUsuario = $idUsuario; 
			$this->descripcion = $descripcion; 
			$this->idTipoCuenta = $idTipoCuenta; 
			$this->id = $id; 
			$this->accessToken = $accessToken; 
			$this->accessTokenSecret = $accessTokenSecret; 
			$this->primario = $primario; 
			$this->estatus = $estatus; 
			$this->img = $img; 
		} 

		public function setIdCuenta($idCuenta) { 
			$this->idCuenta = $idCuenta; 
		} 

		public function getIdCuenta() { 
			return $this->idCuenta; 
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

		public function setIdTipoCuenta($idTipoCuenta) { 
			$this->idTipoCuenta = $idTipoCuenta; 
		} 

		public function getIdTipoCuenta() { 
			return $this->idTipoCuenta; 
		} 

		public function setId($id) { 
			$this->id = $id; 
		} 

		public function getId() { 
			return $this->id; 
		} 

		public function setAccessToken($accessToken) { 
			$this->accessToken = $accessToken; 
		} 

		public function getAccessToken() { 
			return $this->accessToken; 
		} 

		public function setAccessTokenSecret($accessTokenSecret) { 
			$this->accessTokenSecret = $accessTokenSecret; 
		} 

		public function getAccessTokenSecret() { 
			return $this->accessTokenSecret; 
		} 

		public function setPrimario($primario) { 
			$this->primaria = $primario; 
		} 

		public function getPrimario() { 
			return $this->primario; 
		} 

		public function setEstatus($estatus) { 
			$this->estatus = $estatus; 
		} 

		public function getEstatus() { 
			return $this->estatus; 
		} 
		
		public function setImg($img) { 
			$this->img = $img; 
		} 

		public function getImg() { 
			return $this->img; 
		} 
	}
?>