<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class ModeloCiudad extends CI_Model {

	public function obtenerCiudadIdPais($idPais = 0, $encode = false, $json = false){		
		$sql = $this->db->select("ciudad.*");
		$sql = $this->db->from("ciudad");
		$sql = $this->db->join("provincia", "ciudad.IDprovincia = provincia.IDprovincia", "inner");
		$sql = $this->db->join("pais", "pais.IDpais = provincia.IDpais", "inner");
		$sql = $this->db->where('pais.IDpais', $idPais);
		$sql = $this->db->where('ciudad.estatus', "A");
		$sql = $this->db->order_by("ciudad.descripcion", "asc");
		$sql = $this->db->get();
		$lista = array();
		foreach ($sql->result_object() as $registro) {
			$registro->IDciudad = ($encode) ? Encryption::encode($registro->IDciudad) : $registro->IDciudad;
		}
		return $sql->result_object;
	}











	public function obtenerCiudad($encode = false){
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->get('ciudad');
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$idCiudad = ($encode) ? Encryption::encode($registro['IDciudad']) : $registro['IDciudad'];
			$lista[] = new EntCiudad($idCiudad, $registro['IDprovincia'], $registro['descripcion'], $registro['estatus']);
		}
		return $lista;
	}

	public function obtenerCiudadIdProvincia($idProvincia = 0, $encode = false, $json = false){
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->where('IDprovincia', $idProvincia);
		$sql = $this->db->get('ciudad');
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			if ($json) {
				$idCiudad = ($encode) ? Encryption::encode($registro['IDciudad']) : $registro['IDciudad'];
				$lista[] = array("idCiudad"=>$idCiudad, "idProvincia"=>$registro['IDprovincia'], "descripcion"=>$registro['descripcion']);
			} else {
				$idCiudad = ($encode) ? Encryption::encode($registro['IDciudad']) : $registro['IDciudad'];
				$lista[] = new EntCiudad($idCiudad, $registro['IDprovincia'], $registro['descripcion'], $registro['estatus']);
			}
		}
		return $lista;
	}

	public function obtenerCiudadePorNombre($nombre = ''){
		$nombre = Text::quitarAcento($nombre);
		$seleccion = mssql_query("select * from (
select LOWER(
replace(
replace(
replace(
replace(
	replace(
		replace(
  replace(
	replace(
		replace(
			replace(
				replace(
					replace(
						replace(
							descripcion, 'á', 'a')
							,'é', 'e')
						, 'í', 'i')
					, 'ó', 'o')
				 ,'�', 'u')
			,'ñ', '�')
		,'É', 'E')
		,'�', 'a')
			,'�', 'e')
			,'ú', 'u') 
			,'�', 'u')
			,'�', '0')
			,'�', 'i'))
			as 'descripcion', IDpais, nacionalidad, descripcion_iso
		 from Ciudad) as t where Descripcion = '{$nombre}' order by descripcion");
		$registro = mssql_fetch_array($seleccion);
		$paise = new Ciudad($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		return $paise;
	}

	public function obtenerCiudadPorId($idCiudad = 0){
		$sql = $this->db->query("select * from ciudad where IDciudad = '{$idCiudad}'");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$ciudad = new EntCiudad("", "", "", "");
		} else {
			$registro = $registro[0];
			$ciudad = new EntCiudad($registro['IDciudad'], $registro['IDprovincia'], $registro['descripcion'], $registro['estatus']);
		}
		return $ciudad;
	}
	
	public function obtenerCiudadporIdCiudad($idCiudad){
		
		$seleccion = mssql_query(" select p.* from pais p, ciudad as pr, municipio as m, ciudad as c where p.IDpais = pr.IDpais and pr.IDciudad = m.IDciudad and m.IDmunicipio = c.IDmunicipio and c.IDciudad = '{$idCiudad}' order by descripcion");
		$pais = array();
			while ($registro = mssql_fetch_array($seleccion)) {
				$pais = new Ciudad($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
			}
			return $pais;
		
		
	}
	
	public function obtenerCiudadIdCiudad($idCiudad){
		$seleccion = mssql_query(" select p.* from pais p, ciudad as pr, municipio as m, ciudad as c where p.IDpais = pr.IDpais and pr.IDciudad = m.IDciudad and m.IDmunicipio = c.IDmunicipio and c.IDciudad = '{$idCiudad}' order by descripcion");
		$registro = mssql_fetch_array($seleccion);
		$pais = new Ciudad($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		return $pais;	
	}
	
	public function registrarCiudad(Ciudad $pais= null) {
		mssql_query("INSERT INTO Ciudad (descripcion, nacionalidad, descripcion_iso)
			 VALUES ('{$pais->getDescripcion()}', '{$pais->getNacionalidad()}', '{$pais->getDescripcionIso()}')");
	}

	public function actualizarCiudad(Ciudad $pais= null) {
		mssql_query("UPDATE Ciudad SET descripcion = '{$pais->getDescripcion()}', nacionalidad = '{$pais->getNacionalidad()}', descripcion_iso = '{$pais->getDescripcionIso()}'
			WHERE IDpais = '{$pais->getIdCiudad()}' ");			 
	}
	
	public function ejecutarSQL($sql) {
		$seleccion = mssql_query("select * from pais where ".$sql);
		$listaCiudades = array();
		while ($registro = mssql_fetch_array($seleccion)) {
			$listaCiudades[] = new Ciudad($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		}
		return $listaCiudades;
	}


}