<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class ModeloCuenta extends CI_Model {
	

	function registrar($objeto) {
		$this->db->insert('cuenta', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}


	public function obtenerCuentaUsuarioIdActiva($idUsuario = 0, $id) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("id", $id);
		$sql = $this->db->where("estatus", "A");
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			$cuenta = $registro;
		} else {
			$registro = $registro[0];
			$cuenta = $registro;
		}
		return $cuenta;
	}

	public function actualizarDatosCuentaSesion($objeto) {
		$this->db->where('IDcuenta', $objeto["IDcuenta"]);
		$this->db->update('cuenta', $objeto);
	}
	
	function registrarCuentaGrupo(EntCuentaGrupo $entCuentaGrupo) {
		$insert = array('IDcuenta' => $entCuentaGrupo->getIdCuenta(),
		'nombre' => $entCuentaGrupo->getNombre(),
		'pendiente' => $entCuentaGrupo->getPendiente(),
		'id' => $entCuentaGrupo->getId(),
		'estatus' => $entCuentaGrupo->getEstatus(),
		'img' => $entCuentaGrupo->getImg());
		$this->db->insert('cuenta_grupo', $insert);
	}
	
	function registrarCuentaPagina(EntCuentaPagina $entCuentaPagina) {
		$insert = array('IDcuenta' => $entCuentaPagina->getIdCuenta(),
		'nombre' => $entCuentaPagina->getNombre(),
		'access_token' => $entCuentaPagina->getAccessToken(),
		'id' => $entCuentaPagina->getId(),
		'estatus' => $entCuentaPagina->getEstatus(),
		'img' => $entCuentaPagina->getImg());
		$this->db->insert('cuenta_pagina', $insert);
	}
	
	public function existeTipoCuentaUsuario($idUsuario = 0, $idTipoCuenta = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("IDtipo_cuenta", $idTipoCuenta);
		$sql = $this->db->where("estatus", 'A');
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() > 0) {
			return true;
		} else {
			return false;	
		}
	}
	
	function actualizarCuentaGrupo(EntCuentaGrupo $entCuentaGrupo) {
		$update = array('nombre' => $entCuentaGrupo->getNombre(),
				'pendiente' => $entCuentaGrupo->getPendiente(),
				'img' => $entCuentaGrupo->getImg(),
				'estatus' => $entCuentaGrupo->getEstatus());
		$this->db->where('IDcuenta_grupo', $entCuentaGrupo->getIdCuentaGrupo());
		$this->db->where('IDcuenta', $entCuentaGrupo->getIdCuenta());
		$this->db->update('cuenta_grupo', $update);
	}
	

	function actualizarCuentaPagina(EntCuentaPagina $entCuentaPagina) {
		$update = array('nombre' => $entCuentaPagina->getNombre(),
				'access_token' => $entCuentaPagina->getAccessToken(),
				'img' => $entCuentaPagina->getImg(),
				'estatus' => $entCuentaPagina->getEstatus());
		$this->db->where('IDcuenta_pagina', $entCuentaPagina->getIdCuentaPagina());
		$this->db->where('IDcuenta', $entCuentaPagina->getIdCuenta());
		$this->db->update('cuenta_pagina', $update);
	}
	
	public function obtenerCuentaUsuarioTipoCuenta($idUsuario = 0, $idTipoCuenta = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("IDtipo_cuenta", $idTipoCuenta);
		$sql = $this->db->where("estatus", 'A');
		$sql = $this->db->where("primario", true);
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$cuenta = new EntCuenta("", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$cuenta = new EntCuenta($registro['IDcuenta'], $registro['IDusuario'], $registro['descripcion'], $registro['IDtipo_cuenta'], $registro['id'], $registro['access_token'], $registro['access_token_secret'], $registro['primario'], $registro['estatus'], $registro['img']);	
		}
		return $cuenta;
	}
	
	public function obtenerCuentaIdCuenta($idCuenta = 0) {
		$sql = $this->db->where("IDcuenta", $idCuenta);
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$cuenta = new EntCuenta("", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$cuenta = new EntCuenta($registro['IDcuenta'], $registro['IDusuario'], $registro['descripcion'], $registro['IDtipo_cuenta'], $registro['id'], $registro['access_token'], $registro['access_token_secret'], $registro['primario'], $registro['estatus'], $registro['img']);
		}
		return $cuenta;
	}

	public function obtenerCuentaActivaIdCuenta($idCuenta = 0) {
		$sql = $this->db->where("IDcuenta", $idCuenta);
		$sql = $this->db->where("estatus", "A");
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$cuenta = new EntCuenta("", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$cuenta = new EntCuenta($registro['IDcuenta'], $registro['IDusuario'], $registro['descripcion'], $registro['IDtipo_cuenta'], $registro['id'], $registro['access_token'], $registro['access_token_secret'], $registro['primario'], $registro['estatus'], $registro['img']);
		}
		return $cuenta;
	}
	
	public function obtenerCuentaUsuarioIdCuenta($idUsuario = 0, $idCuenta = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("IDcuenta", $idCuenta);
		$sql = $this->db->where("estatus", 'A');
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$cuenta = new EntCuenta("", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$cuenta = new EntCuenta($registro['IDcuenta'], $registro['IDusuario'], $registro['descripcion'], $registro['IDtipo_cuenta'], $registro['id'], $registro['access_token'], $registro['access_token_secret'], $registro['primario'], $registro['estatus'], $registro['img']);	
		}
		return $cuenta;
	}
	
	public function obtenerCuentaUsuarioId($idUsuario = 0, $id = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("id", $id);
		$sql = $this->db->where("estatus", 'A');
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$cuenta = new EntCuenta("", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$cuenta = new EntCuenta($registro['IDcuenta'], $registro['IDusuario'], $registro['descripcion'], $registro['IDtipo_cuenta'], $registro['id'], $registro['access_token'], $registro['access_token_secret'], $registro['primario'], $registro['estatus'], $registro['img']);
		}
		return $cuenta;
	}
	
	public function obtenerCuentaUsuarioCuenta($idUsuario = 0, $idCuenta = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("IDcuenta", $idCuenta);
		$sql = $this->db->where("estatus !=", "E");
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$cuenta = new EntCuenta("", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$cuenta = new EntCuenta($registro['IDcuenta'], $registro['IDusuario'], $registro['descripcion'], $registro['IDtipo_cuenta'], $registro['id'], $registro['access_token'], $registro['access_token_secret'], $registro['primario'], $registro['estatus'], $registro['img']);	
		}
		return $cuenta;
	}

	
	public function obtenerCuentaUsuario($idUsuario = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("estatus !=", "E");
		$sql = $this->db->get("cuenta");
		$listaCuenta = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuenta[] = new EntCuenta($registro['IDcuenta'], $registro['IDusuario'], $registro['descripcion'], $registro['IDtipo_cuenta'], $registro['id'], $registro['access_token'], $registro['access_token_secret'], $registro['primario'], $registro['estatus'], $registro['img']);
		}
		return $listaCuenta;
	}
	
	public function obtenerCuentaGrupoUsuario($idUsuario = 0) {
		$sql = $this->db->query("select * from cuenta as c inner join cuenta_grupo as cg on c.IDcuenta = cg.IDcuenta where cg.estatus != 'E' and c.estatus = 'A' and c.IDusuario = '{$idUsuario}'");
		$listaCuentaGrupo = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuentaGrupo[] = new EntCuentaGrupo($registro['IDcuenta_grupo'], $registro['IDcuenta'], $registro['nombre'], $registro['pendiente'], $registro['id'], $registro['estatus'], $registro['img']);
		}
		return $listaCuentaGrupo;
	}
	
	public function obtenerCuentaPaginaUsuario($idUsuario = 0) {
		$sql = $this->db->query("select * from cuenta as c inner join cuenta_pagina as cp on c.IDcuenta = cp.IDcuenta where cp.estatus != 'E' and c.estatus = 'A' and c.IDusuario = '{$idUsuario}'");
		$listaCuentaPagina = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuentaPagina[] = new EntCuentaPagina($registro['IDcuenta_pagina'], $registro['IDcuenta'], $registro['nombre'], $registro['access_token'], $registro['id'], $registro['estatus'], $registro['img']);
		}
		return $listaCuentaPagina;
	}
	
	public function obtenerCuentaUsuarioKey($idUsuario = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("estatus", "A");
		$sql = $this->db->get("cuenta");
		$listaCuenta = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuenta[$registro['IDtipo_cuenta']][] = new EntCuenta($registro['IDcuenta'], $registro['IDusuario'], $registro['descripcion'], $registro['IDtipo_cuenta'], $registro['id'], $registro['access_token'], $registro['access_token_secret'], $registro['primario'], $registro['estatus'], $registro['img']);
		}
		return $listaCuenta;
	}
	
	public function obtenerCuentaPaginaUsuarioKey($idUsuario = 0) {
		$sql = $this->db->query("select * from cuenta as c inner join cuenta_pagina as cp on c.IDcuenta = cp.IDcuenta where cp.estatus = 'A' and c.estatus = 'A' and c.IDusuario = '{$idUsuario}'");
		$listaCuentaPagina = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuentaPagina[$registro['IDcuenta']][] = new EntCuentaPagina($registro['IDcuenta_pagina'], $registro['IDcuenta'], $registro['nombre'], $registro['access_token'], $registro['id'], $registro['estatus'], $registro['img']);
		}
		return $listaCuentaPagina;
	}
	
	public function obtenerCuentaPaginaUsuarioKeyPagina($idUsuario = 0) {
		$sql = $this->db->query("select * from cuenta as c inner join cuenta_pagina as cp on c.IDcuenta = cp.IDcuenta where cp.estatus = 'A' and c.estatus = 'A' and c.IDusuario = '{$idUsuario}'");
		$listaCuentaPagina = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuentaPagina[$registro['IDcuenta_pagina']] = new EntCuentaPagina($registro['IDcuenta_pagina'], $registro['IDcuenta'], $registro['nombre'], $registro['access_token'], $registro['id'], $registro['estatus'], $registro['img']);
		}
		return $listaCuentaPagina;
	}
	
	public function obtenerCuentaGrupoUsuarioKey($idUsuario = 0) {
		$sql = $this->db->query("select * from cuenta as c inner join cuenta_grupo as cg on c.IDcuenta = cg.IDcuenta where cg.estatus = 'A' and c.estatus = 'A' and c.IDusuario = '{$idUsuario}'");
		$listaCuentaGrupo = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuentaGrupo[$registro['IDcuenta']][] = new EntCuentaGrupo($registro['IDcuenta_grupo'], $registro['IDcuenta'], $registro['nombre'], $registro['pendiente'], $registro['id'], $registro['estatus'], $registro['img']);
		}
		return $listaCuentaGrupo;
	}
	
	public function obtenerCuentaGrupoUsuarioKeyGrupo($idUsuario = 0) {
		$sql = $this->db->query("select * from cuenta as c inner join cuenta_grupo as cg on c.IDcuenta = cg.IDcuenta where cg.estatus = 'A' and c.estatus = 'A' and c.IDusuario = '{$idUsuario}'");
		$listaCuentaGrupo = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuentaGrupo[$registro['IDcuenta_grupo']] = new EntCuentaGrupo($registro['IDcuenta_grupo'], $registro['IDcuenta'], $registro['nombre'], $registro['pendiente'], $registro['id'], $registro['estatus'], $registro['img']);
		}
		return $listaCuentaGrupo;
	}
	
	public function obtenerCuentaPaginaIdCuentaKeyId($idCuenta = 0) {
		$sql = $this->db->query("select * from cuenta_pagina where IDcuenta = '{$idCuenta}'");
		$listaCuentaPagina = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuentaPagina[$registro['id']] = new EntCuentaPagina($registro['IDcuenta_pagina'], $registro['IDcuenta'], $registro['nombre'], $registro['access_token'], $registro['id'], $registro['estatus'], $registro['img']);
		}
		return $listaCuentaPagina;
	}
	
	public function obtenerCuentaGrupoIDCuentaKeyId($idCuenta = 0) {
		$sql = $this->db->query("select * from cuenta_grupo where IDcuenta = '{$idCuenta}'");
		$listaCuentaGrupo = array();
		foreach ($sql->result_array() as $registro) {
			$listaCuentaGrupo[$registro['id']] = new EntCuentaGrupo($registro['IDcuenta_grupo'], $registro['IDcuenta'], $registro['nombre'], $registro['pendiente'], $registro['id'], $registro['estatus'], $registro['img']);
		}
		return $listaCuentaGrupo;
	}
	
	public function obtenerCuentaPrimarioActivoUsuario($idUsuario = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("estatus", 'A');
		$sql = $this->db->where("primario", '1');
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$cuenta = new EntCuenta("", "", "", "", "", "", "", "", "", "");
		} else {
			$registro = $registro[0];
			$cuenta = new EntCuenta($registro['IDcuenta'], $registro['IDusuario'], $registro['descripcion'], $registro['IDtipo_cuenta'], $registro['id'], $registro['access_token'], $registro['access_token_secret'], $registro['primario'], $registro['estatus'], $registro['img']);	
		}
		return $cuenta;
	}
	
	public function obtenerTipoCuentaIdTipoCuenta($idTipoCuenta = 0) {
		$sql = $this->db->where("IDtipo_cuenta", $idTipoCuenta);
		$sql = $this->db->get("tipo_cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$cuenta = new EntTipoCuenta("", "", "", "");
		} else {
			$registro = $registro[0];
			$cuenta = new EntTipoCuenta($registro['IDtipo_cuenta'], $registro['nombre'], $registro['descripcion'], $registro['estatus']);	
		}
		return $cuenta;
	}
	
	public function tieneCuentaActiva($idUsuario = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("estatus", "A");
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	public function existeCuentaFb($idUsuario = 0, $idTipoCuenta = 0, $id = "") {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("IDtipo_cuenta", $idTipoCuenta);
		$sql = $this->db->where("id", $id);
		$sql = $this->db->where("estatus != ", "E");
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	public function existeCuentaT($idUsuario = 0, $idTipoCuenta = 0, $accessToken = "", $accessTokenSecret = "") {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("IDtipo_cuenta", $idTipoCuenta);
		$sql = $this->db->where("access_token", $accessToken);
		$sql = $this->db->where("access_token_secret", $accessTokenSecret);
		$sql = $this->db->where("estatus != ", "E");
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function existeCuentaTSesion($idTipoCuenta = 0, $accessToken = "", $accessTokenSecret = "") {
		$sql = $this->db->where("IDtipo_cuenta", $idTipoCuenta);
		$sql = $this->db->where("access_token", $accessToken);
		$sql = $this->db->where("access_token_secret", $accessTokenSecret);
		$sql = $this->db->where("estatus != ", "E");
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	public function obtenerCantidadCuenta($idUsuario = 0) {
		$sql = $this->db->query("SELECT COUNT(IDcuenta) AS 'cantidad' FROM cuenta where IDusuario = '{$idUsuario}' and estatus = 'A'");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return 0;
		} else {
			$registro = $registro[0];
			return $registro['cantidad'];
		}
	}
	
	public function modificar(EntCuenta $cuenta = NULL) {
		$this->db->query("update cuenta set estatus = '{$cuenta->getEstatus()}', primario = '{$cuenta->getPrimario()}' where IDcuenta = '{$cuenta->getIdCuenta()}' and IDusuario = '{$cuenta->getIdUsuario()}' and estatus != 'E'");
	}
	
	public function actualizarDatosCuenta(EntCuenta $cuenta = NULL) {
		$this->db->query("update cuenta set descripcion = '{$cuenta->getDescripcion()}', img = '{$cuenta->getImg()}' where IDcuenta = '{$cuenta->getIdCuenta()}' and IDusuario = '{$cuenta->getIdUsuario()}'");
	}

	
	
	public function actualizarDatosCuentaFacebook(EntCuenta $cuenta = NULL) {
		$this->db->query("update cuenta set descripcion = '{$cuenta->getDescripcion()}', img = '{$cuenta->getImg()}', access_token = '{$cuenta->getAccessToken()}' where IDcuenta = '{$cuenta->getIdCuenta()}' and IDusuario = '{$cuenta->getIdUsuario()}'");
	}
	
	public function modificarPrimario($idCuenta = 0, $primario = 0, $idUsuario = 0) {
		$this->db->query("update cuenta set primario = '{$primario}' where IDcuenta = '{$idCuenta}' and IDusuario = '{$idUsuario}' and estatus != 'E'");
	}
	
	public function modificarEstatus($idCuenta = 0, $estatus = 0, $idUsuario = 0) {
		$this->db->query("update cuenta set estatus = '{$estatus}' where IDcuenta = '{$idCuenta}' and IDusuario = '{$idUsuario}' and estatus != 'E'");
	}
	
	
	public function quitarOtrosPrimarios($idCuenta = 0, $idTipoCuenta = 0, $idUsuario = 0) {
		$this->db->query("update cuenta set primario = 0 where IDcuenta != '{$idCuenta}' and IDtipo_cuenta = '{$idTipoCuenta}' and IDusuario = '{$idUsuario}'");
	}
	
	public function eliminar($idCuenta = 0, $idUsuario = 0) {
		$this->db->query("update cuenta set estatus = 'E' where IDcuenta = '{$idCuenta}' and IDusuario = '{$idUsuario}'");
	}
	
	public function inactivarCuentaGrupoPagina($idCuenta = 0) {
		$this->db->query("update cuenta_grupo set estatus = 'I' where IDcuenta = '{$idCuenta}'");
		$this->db->query("update cuenta_pagina set estatus = 'I' where IDcuenta = '{$idCuenta}'");
	}

	public function existeCuentaActivaIdUsuarioId($idUsuario = 0, $id = 0) {
		$sql = $this->db->where("IDusuario", $idUsuario);
		$sql = $this->db->where("id", $id);
		$sql = $this->db->where("estatus", "A");
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function existeCuentaActivaIdCuenta($id = 0) {
		$sql = $this->db->where("id", $id);
		$sql = $this->db->where("estatus", "A");
		$sql = $this->db->get("cuenta");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * 
	 * Api Twitter
	 */
	function obtenerTendenciaActivaWoeid($woeid) {
		$sql = $this->db->where("estatus", 'A');
		$sql = $this->db->where("id", $woeid);
		$sql = $this->db->get("tendencia");
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$lista[] = new EntTendencia($registro['IDtendencia'], $registro['id'], $registro['nombre'], $registro['codigo'], $registro['ubicacion'], $registro['fecha_inicio'], $registro['fecha_fin'], $registro['estatus'], $registro['posicion']);
		}
		return $lista;
	}
	
	function obtenerTendenciaActivaKeyId() {
		$sql = $this->db->where("estatus", 'A');
		$sql = $this->db->order_by("posicion", 'asc');
		$sql = $this->db->get("tendencia");
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$lista[$registro['id']][] = new EntTendencia($registro['IDtendencia'], $registro['id'], $registro['nombre'], $registro['codigo'], $registro['ubicacion'], $registro['fecha_inicio'], $registro['fecha_fin'], $registro['estatus'], $registro['posicion']);
		}
		return $lista;
	}
	
	function obtenerTendenciaWoeidKeyNombre($woeid) {
		$sql = $this->db->where("id", $woeid);
		$sql = $this->db->get("tendencia");
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$lista[$registro['nombre']] = new EntTendencia($registro['IDtendencia'], $registro['id'], $registro['nombre'], $registro['codigo'], $registro['ubicacion'], $registro['fecha_inicio'], $registro['fecha_fin'], $registro['estatus'], $registro['posicion']);
		}
		return $lista;
	}
	
	function obtenerTendenciaWoeid($woeid = "") {
		$this->load->library('twitter/twitteroauth');
		$consumerKey    = 'OWsRSkEd0ruIU1eqMvgN5xly9'; //inserta tu consumer key</span>
		$consumerSecret = 'MtEvwvEN2pVMVlSor35EWXvjxgduJ5TG9mBr1TYnfZ4wjOQcwB'; //inserta tu consumer secret</span>
		$tweet = new TwitterOAuth($consumerKey, $consumerSecret);
		$listaTrends = array();
		$trends = $tweet->get('trends/place', array('id' => $woeid));
		foreach ($trends[0]->trends as $trend) {
			$listaTrends[] = array("query"=>$trend->query, "nombre"=>$trend->name);
		}
		return $listaTrends;
	}
	
	function obtenerEInsertarTendenciaWoeid($woeid = "") {
		$this->load->library('twitter/twitteroauth');
		$consumerKey    = 'OWsRSkEd0ruIU1eqMvgN5xly9'; //inserta tu consumer key</span>
		$consumerSecret = 'MtEvwvEN2pVMVlSor35EWXvjxgduJ5TG9mBr1TYnfZ4wjOQcwB'; //inserta tu consumer secret</span>
		$tweet = new TwitterOAuth($consumerKey, $consumerSecret);
		$trends = $tweet->get('trends/place', array('id' => $woeid));
		$ubicacion = $trends[0]->locations[0]->name;
		$fecha = date("Y/m/d H:i:s");
		$listaTendencia = $this->obtenerTendenciaWoeidKeyNombre($woeid);
			$update = array('estatus' => "E",
			'fecha_fin' => $fecha);
			$this->db->where('id', $woeid);
			$this->db->where('estatus != ', "E");
			$this->db->update('tendencia', $update);
		$posicion = 1;
		foreach ($trends[0]->trends as $trend) {
			if (isset($listaTendencia[$trend->name])) {
				$diferenciaFecha = Texto::diferenciaEntreFechas($fecha, $listaTendencia[$trend->name]->getFechaInicio());
				if ($diferenciaFecha["dias"] > 7) {
					$insert = array('nombre' => $trend->name,
							'codigo' => $trend->query,
							'fecha_inicio' => $fecha,
							'id' => $woeid,
							'ubicacion' => $ubicacion,
							'posicion' => $posicion,
							'estatus' => "A");
					$this->db->insert('tendencia', $insert);
				} else {
					$update = array('estatus' => "A",
					'posicion' => $posicion);
					$this->db->where('IDtendencia', $listaTendencia[$trend->name]->getIdTendencia());
					$this->db->update('tendencia', $update);
				}
			} else {
				$insert = array('nombre' => $trend->name,
					'codigo' => $trend->query,
					'fecha_inicio' => $fecha,
					'id' => $woeid,
					'ubicacion' => $ubicacion,
					'posicion' => $posicion,
					'estatus' => "A");
				$this->db->insert('tendencia', $insert);
			}
			$posicion++;
		}
	}
	
	function obtenerTrends($idCuenta = "") {
		$this->load->model("ModeloCuenta");
		$cuenta = $this->ModeloCuenta->obtenerCuentaIdCuenta($idCuenta);
		$this->load->library('twitter/twitteroauth');
		$consumerKey    = 'OWsRSkEd0ruIU1eqMvgN5xly9'; //inserta tu consumer key</span>
		$consumerSecret = 'MtEvwvEN2pVMVlSor35EWXvjxgduJ5TG9mBr1TYnfZ4wjOQcwB'; //inserta tu consumer secret</span>
		$oAuthToken     = Encryption::decode($cuenta->getAccessToken()); //inserta tu access token
		$oAuthSecret    = Encryption::decode($cuenta->getAccessTokenSecret()); //inserta tu token secret
		$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
		$trend = $tweet->get('account/settings');
		$woeid = "";
		$listaTrends = array();
		if (isset($trend->trend_location) && count($trend->trend_location) > 0) {
			$woeid = $trend->trend_location[0]->woeid;
			$trends = $tweet->get('trends/place', array('id' => $woeid));
			foreach ($trends[0]->trends as $trend) {
				$listaTrends[] = array("query"=>$trend->query, "nombre"=>$trend->name);
			}
		}
		return $listaTrends;
	}

	public function obtenerCuentaActivaJson($idUsuario = 0) {
		$sql = $this->db->query("SELECT IDcuenta, descripcion, img, seguidores FROM cuenta WHERE IDusuario = '{$idUsuario}' AND estatus = 'A'");
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$id = Encryption::encode($registro['IDcuenta']);
			$seguidores = $registro['seguidores'];
			$descripcion = Texto::idioma($registro['descripcion']);
			$img = $registro['img'];
			$lista[$id] = array("id"=>$id, "seguidores"=>$seguidores, "descripcion"=>$descripcion, "img"=>$img);
		}
		return array("lista"=>$lista);
	}

	function postFb($idUsuario = 0, $mensaje = "", $descripcion = "", $id = "", $accessToken = "", Object $array = null, $tipo = "") {
		$this->load->model("ModeloSocial");
		$social = $this->ModeloSocial->obtenerSocialActivoIdTipo(1);
		if (empty($social)) {
			return false;
		}
		$mensaje = trim($mensaje);
		$this->load->library('facebook');
		$this->load->library("Encryption");
		$app_id = $social->id;
		$app_secret = $social->access_token;
		$this->load->model("ModeloCuenta");
		if ($idUsuario == 0) {
			$accessToken = Encryption::decode($accessToken);
		} else {
			$cuenta = $this->ModeloCuenta->obtenerCuentaUsuarioTipoCuenta($idUsuario, 1);
			$accessToken = Encryption::decode($cuenta->getAccessToken());
			$id = $cuenta->getId();
		}
		if ($mensaje != "") {
			$facebook = new Facebook(array('appId'  => $app_id,'secret' => $app_secret));
			if ($postImagen->getNombre() != '') {
				$accessTokenApp = $facebook->getAccessToken();
				$urlWeb = HOST."post/verpost/".Encryption::encode($postImagen->getIdPost());
				$urlPost = (Texto::obtenerLink($mensaje) == "") ? $urlWeb : Texto::obtenerLink($mensaje);
				$parametroPost = array(
					'message' => $mensaje,
					'description' => $descripcion,
					//'picture' => HOST.'assets/img/post/'.$postImagen->getNombre()."-full.".$postImagen->getExt(),
					'link' => $urlWeb ,
					'redirect_uri' => $urlWeb,
					'name' => $mensaje
				);
				if ($tipo == 'P') {
					$parametroPost["access_token"] = $accessToken;
				} else if ($tipo == "G") {
					$parametroPost["access_token"] = $accessToken;
				}
				try {
					$status = $facebook->api("/{$id}/feed", 'POST', $parametroPost);
				} catch (FacebookApiException $e) {
					$status = $e;
				}
				if ($status instanceof Exception) {
					$resultadoEnvio = $status->getResult();
					$mensajeResultado = "";
					$estatus = "E";
					if (isset($resultadoEnvio["error"])) {
						$mensajeResultado = $resultadoEnvio["error"]["message"];
					}
					$resultado = array("estatus"=>"E", "mensaje"=>$mensajeResultado);
				} else {
					$resultado = array("estatus"=>"A", "mensaje"=>Texto::idioma("Publicado"));
				}
			} else {
				$parametroPost = array(  
				    'message' => $mensaje,
				    'description' => $descripcion
				);
				if ($tipo == 'P') {
					$parametroPost["access_token"] = $accessToken;
				}
				try {
					$status = $facebook->api("/{$id}/feed", 'POST', $parametroPost);
				} catch (FacebookApiException $e) {
					$status = $e;
				}	
				if ($status instanceof Exception) {
					$resultadoEnvio = $status->getResult();
					$mensajeResultado = "";
					$estatus = "E";
					if (isset($resultadoEnvio["error"])) {
						$mensajeResultado = $resultadoEnvio["error"]["message"];
					}
					$resultado = array("estatus"=>"E", "mensaje"=>$mensajeResultado);
				} else {
					$resultado = array("estatus"=>"A", "mensaje"=>Texto::idioma("Publicado"));
				}					
			}
			return $resultado;
		} else {
			return false;
		}
	}
	
	function postTwitter($idUsuario = 0, $mensaje = "", $accessToken = "", $accessTokenSecret = "", EntPostImagen $postImagen = null) {
		$this->load->model("ModeloSocial");
		$social = $this->ModeloSocial->obtenerSocialActivoIdTipo(2);
		if (empty($social)) {
			return false;
		}
		$mensaje = trim($mensaje);
		$this->load->library('twitter/twitteroauth');
		$this->load->library("Encryption");
		$consumerKey    = $social->access_token; //inserta tu consumer key</span>
		$consumerSecret = $social->access_token_secret; //inserta tu consumer secret</span>
		$this->load->model("ModeloCuenta");
		if ($idUsuario == 0) {
			$accessToken = Encryption::decode($accessToken);
			$accessTokenSecret =  Encryption::decode($accessTokenSecret);
		} else {
			$cuenta = $this->ModeloCuenta->obtenerCuentaUsuarioTipoCuenta($idUsuario, 2);
			$accessToken = Encryption::decode($cuenta->getAccessToken());
			$accessTokenSecret =  Encryption::decode($cuenta->getAccessTokenSecret());
		}
		if ($accessToken != "" && $mensaje != "") {
			$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			if ($postImagen->getNombre() != "") {
				$url = IMAGE_UPLOAD."post/".$postImagen->getNombre()."-full.".$postImagen->getExt();
				$image = "@{$url};type={$postImagen->getTipo()};filename={$postImagen->getNombre()}";
				$parameters = array(
						'media[]'  => "{$image}",
						'status'   => "{$mensaje}"
				);
				
				$resultado = $tweet->post('https://api.twitter.com/1.1/statuses/update_with_media.json', $parameters, true);
				if ($resultado == "") {
					$resultado = array("estatus"=>"E", "mensaje"=>Texto::idioma("Error"));
				} else {
					$resultado = array("estatus"=>"A", "mensaje"=>Texto::idioma("Publicado"));
				}
			} else {
				$resultado = $tweet->post('statuses/update', array('status' => $mensaje));
				if (isset($resultado->errors)) {
					$resultado = array("estatus"=>"E", "mensaje"=>$resultado->errors[0]->message);
				} else {
					$resultado = array("estatus"=>"A", "mensaje"=>Texto::idioma("Publicado"));
				}
			}
			return $resultado;
		} else {
			return false;
		}
	}
	
	function obtenerHashtag($string = "") {
		$this->load->model("ModeloSocial");
		$social = $this->ModeloSocial->obtenerSocialActivoIdTipo(2);
		$this->load->library('twitter/twitteroauth');
		$consumerKey    = $social->access_token; //inserta tu consumer key</span>
		$consumerSecret = $social->access_token_secret; //inserta tu consumer secret</span>
		$tweet = new TwitterOAuth($consumerKey, $consumerSecret);
		$lista = array();
		$sql = $this->db->select('Id');
		$sql = $this->db->from('post_social');
		$sql = $this->db->limit(1);
		$sql = $this->db->order_by("Fecha", "desc");
		$sql = $this->db->get();
		$ultimoId = "";
		if ($sql->num_rows() > 0) {
			$registro = $sql->result_object();
			$registro = $registro[0];
			$ultimoId = $registro->Id;
		}
		$resultado = $tweet->get('https://api.twitter.com/1.1/search/tweets.json', array('q' => urlencode("#EleccionesRD2016"), "count"=>"100", "since_id"=>$ultimoId));
		foreach ($resultado->statuses as $registro) {
			$fechaT = strtotime($registro->created_at);
			$fecha = date("Y/m/d H:i:s", $fechaT);
			$objeto = array("RT"=>$registro->retweet_count, "Cuerpo"=>$registro->text, "Usuario"=>$registro->user->screen_name, "Nombre"=>$registro->user->name, "Estatus"=>"P", "Fecha"=>$fecha, "Id"=>$registro->id_str);
			$this->db->insert('post_social', $objeto);
		}
		return true;
	}
	

}
?>