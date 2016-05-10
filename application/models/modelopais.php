<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class ModeloPais extends CI_Model {

	public function obtenerPaises($encode = false){
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->get('pais');
		$lista = array();
		foreach ($sql->result_object() as $registro) {
			$registro->IDpais = ($encode) ? Encryption::encode($registro->IDpais) : $registro->IDpais;
		}
		return $sql->result_object();
	}

	public function obtenerPaisePorNombre($nombre = ''){
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
		 from Pais) as t where Descripcion = '{$nombre}' order by descripcion");
		$registro = mssql_fetch_array($seleccion);
		$paise = new Pais($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		return $paise;
	}

	public function obtenerPaisPorId($idPais, $encode = false){
		$sql = $this->db->where("IDpais", $idPais);
		$sql = $this->db->get('pais');
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			return $registro;
		} else {
			$registro = $registro[0];
			return $registro;
		}
	}
	
	public function obtenerPaisporIdCiudad($idCiudad){
		
		$seleccion = mssql_query(" select p.* from pais p, provincia as pr, municipio as m, ciudad as c where p.IDpais = pr.IDpais and pr.IDprovincia = m.IDprovincia and m.IDmunicipio = c.IDmunicipio and c.IDciudad = '{$idCiudad}' order by descripcion");
		$pais = array();
			while ($registro = mssql_fetch_array($seleccion)) {
				$pais = new Pais($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
			}
			return $pais;
		
		
	}
	
	public function obtenerPaisIdCiudad($idCiudad){
		$seleccion = mssql_query(" select p.* from pais p, provincia as pr, municipio as m, ciudad as c where p.IDpais = pr.IDpais and pr.IDprovincia = m.IDprovincia and m.IDmunicipio = c.IDmunicipio and c.IDciudad = '{$idCiudad}' order by descripcion");
		$registro = mssql_fetch_array($seleccion);
		$pais = new Pais($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		return $pais;	
	}
	
	public function obtenerPaisIdProvincia($idProvincia){
		$seleccion = mssql_query("select p.* from pais as p inner join provincia  as pr on p.IDpais = pr.IDpais and pr.IDprovincia = '{$idProvincia}'");
		$registro = mssql_fetch_array($seleccion);
		$pais = new Pais($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		return $pais;	
	}
	
	public function registrarPais(Pais $pais= null) {
		mssql_query("INSERT INTO Pais (descripcion, nacionalidad, descripcion_iso)
			 VALUES ('{$pais->getDescripcion()}', '{$pais->getNacionalidad()}', '{$pais->getDescripcionIso()}')");
	}

	public function actualizarPais(Pais $pais= null) {
		mssql_query("UPDATE Pais SET descripcion = '{$pais->getDescripcion()}', nacionalidad = '{$pais->getNacionalidad()}', descripcion_iso = '{$pais->getDescripcionIso()}'
			WHERE IDpais = '{$pais->getIdPais()}' ");			 
	}
	
	public function ejecutarSQL($sql) {
		$seleccion = mssql_query("select * from pais where ".$sql);
		$listaPaises = array();
		while ($registro = mssql_fetch_array($seleccion)) {
			$listaPaises[] = new Pais($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		}
		return $listaPaises;
	}


}