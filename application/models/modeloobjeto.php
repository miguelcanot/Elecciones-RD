<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
/**
 *
 * @category   Db
 * @package    modelos
 * @copyright  Copyright (c) 2013 DominicanCode.
 * @license    ---
 */
/**
 * @see Modelo
 * @see entidades: EntObjeto
 */

class ModeloObjeto extends CI_Model {

	public function obtenerObjetoActivoJson() {
		$sql = $this->db->where('estatus', "A");
		$sql = $this->db->get("objeto");
		foreach ($sql->result_object() as $registro) {
			$registro->IDobjeto = Encryption::encode($registro->IDobjeto);
			$registro->IDobjeto_relacionado = ($registro->IDobjeto_relacionado != "") ? Encryption::encode($registro->IDobjeto_relacionado) : $registro->IDobjeto_relacionado;

		}
		return $sql->result_object();
	}

	public function obtenerObjeto($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('objeto.*');
		$sql = $this->db->from('objeto');
		if ($busqueda != "") {
			$sql = $this->db->like('usuario', $busqueda);
			$sql = $this->db->or_like('puesto', $busqueda);
			$sql = $this->db->or_like('comentario', $busqueda);
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("usuario", "asc");
		$sql = $this->db->get();
		
		foreach ($sql->result_object() as $registro) {
			$registro->IDobjeto = ($encode) ? Encryption::encode($registro->IDobjeto) : $registro->IDobjeto;
		}
		return $sql->result_object();
	}

	public function obtenerObjetoActivo($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('objeto.*, o2.nombre_logico as objetoRelacionado');
		$sql = $this->db->from('objeto');
		$sql = $this->db->join('objeto as o2', 'objeto.IDobjeto_relacionado = o2.IDobjeto', 'left');
		$sql = $this->db->where('objeto.estatus', 'A');
		if ($busqueda != "") {
			$sql = $this->db->where("(objeto.nombre_logico like '%{$busqueda}%' or objeto.nombre_fisico like '%{$busqueda}%' or o2.nombre_logico like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("objeto.nombre_logico", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDobjeto = ($encode) ? Encryption::encode($registro->IDobjeto) : $registro->IDobjeto;
			$registro->IDobjeto_relacionado = ($encode && $registro->IDobjeto_relacionado != "") ? Encryption::encode($registro->IDobjeto_relacionado) : $registro->IDobjeto_relacionado;
		}
		return $sql->result_object();
	}

	function existeObjetoEstatus($idObjeto = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('objeto');
		$sql = $this->db->where('IDobjeto', $idObjeto);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	function registrar($objeto) {
		$this->db->insert('objeto', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function registrarSocial($objeto) {
		$this->db->insert('objeto_social', $objeto);
	}

	function eliminarSocial($idObjeto) {
		$this->db->query("delete from objeto_social where IDobjeto = '{$idObjeto}'");
	}


	function actualizar($objeto) {
		$this->db->where('IDobjeto', $objeto["IDobjeto"]);
		$this->db->update('objeto', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDobjeto', $objeto["IDobjeto"]);
		$this->db->update('objeto', $objeto);
	}

	/**
	 * Permiso
	 */

	public function obtenerObjetoSinAsignarIdRol($idRol = 0) {
		$sql = $this->db->query("select IDobjeto, nombre_logico from objeto where IDobjeto not in (select IDobjeto from rol_objeto where IDrol = '{$idRol}')");
		foreach ($sql->result_object() as $registro) {
			$registro->IDobjeto = Encryption::encode($registro->IDobjeto);
		}
		return $sql->result_object();
	}

	public function obtenerObjetoAsignadoIdRol($idRol = 0) {
		$sql = $this->db->query("select IDobjeto, nombre_logico from objeto where IDobjeto in (select IDobjeto from rol_objeto where IDrol = '{$idRol}')");
		foreach ($sql->result_object() as $registro) {
			$registro->IDobjeto = Encryption::encode($registro->IDobjeto);
		}
		return $sql->result_object();
	}

	public function obtenerObjetoMenuPermiso($idUsuario = 0, $idRol = 0) {
		$sql = $this->db->query("select distinct o.nombre_fisico from objeto as o
			inner join rol_objeto as ro on ro.IDobjeto = o.IDobjeto
			inner join usuario_rol as ur on ur.IDrol = ro.IDrol
			inner join rol as r on r.IDrol = ur.IDrol
			inner join usuario as u on u.IDusuario = ur.IDusuario
			where ro.IDrol = '{$idRol}' and ur.IDusuario = '{$idUsuario}' and r.estatus = 'A' and o.estatus = 'A' and u.estatus = 'A' and o.tipo_objeto = 'B'
			AND o.nombre_fisico LIKE 'm%'
			");
		return $sql->result_object();
	}

	public function obtenerListaPermisoBotonPantalla($idUsuario = 0, $idRol = 0, $pantalla = "") {
		$sql = $this->db->query("select distinct o.nombre_fisico from objeto as o
			inner join rol_objeto as ro on ro.IDobjeto = o.IDobjeto
			inner join usuario_rol as ur on ur.IDrol = ro.IDrol
			inner join rol as r on r.IDrol = ur.IDrol
			inner join usuario as u on u.IDusuario = ur.IDusuario
			where ro.IDrol = '{$idRol}' and ur.IDusuario = '{$idUsuario}' and r.estatus = 'A' and o.estatus = 'A' and u.estatus = 'A' and o.tipo_objeto = 'B'
			AND o.IDobjeto_relacionado = (select IDobjeto from objeto where nombre_fisico = '{$pantalla}') 
			");
		return $sql->result_object();
	}


	function registrarPermiso($objeto) {
		$this->db->insert('rol_objeto', $objeto);
	}

	function eliminarPermiso($objeto) {
		$this->db->delete('rol_objeto', $objeto);
	}

	function verificarPermiso($nombreFisico = "", $idRol = 0) {
		$sql = $this->db->query("select o.* from objeto as o 
			inner join rol_objeto as ro on o.IDobjeto = ro.IDobjeto
			inner join rol as r on r.IDrol = ro.IDrol
			where o.nombre_fisico = '{$nombreFisico}' and ro.IDrol = '{$idRol}' and o.estatus = 'A' and r.estatus = 'A'");
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	


}
?>