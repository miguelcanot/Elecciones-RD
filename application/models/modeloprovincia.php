<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class ModeloProvincia extends CI_Model {

	public function obtenerProvincia($encode = false){
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->get('provincia');
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$idProvincia = ($encode) ? Encryption::encode($registro['IDprovincia']) : $registro['IDprovincia'];
			$lista[] = new EntProvincia($idProvincia, $registro['IDpais'], $registro['descripcion']);
		}
		return $lista;
	}

	public function obtenerProvinciaIdPais($idPais = 0, $encode = false, $json = false){
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->where('IDpais', $idPais);
		$sql = $this->db->get('provincia');
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			if ($json) {
				$idProvincia = ($encode) ? Encryption::encode($registro['IDprovincia']) : $registro['IDprovincia'];
				$lista[] = array("IDprovincia"=>$idProvincia, "IDpais"=>$registro['IDpais'], "descripcion"=>$registro['descripcion']);
			} else {
				$idProvincia = ($encode) ? Encryption::encode($registro['IDprovincia']) : $registro['IDprovincia'];
				$lista[] = new EntProvincia($idProvincia, $registro['IDpais'], $registro['descripcion']);
			}

		}
		return $lista;
	}

	public function obtenerProvinciaePorNombre($nombre = ''){
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
		 from Provincia) as t where Descripcion = '{$nombre}' order by descripcion");
		$registro = mssql_fetch_array($seleccion);
		$paise = new Provincia($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		return $paise;
	}

	public function obtenerProvinciaPorId($idProvincia = 0){
		$sql = $this->db->where("IDprovincia", $idProvincia);
		$sql = $this->db->get('provincia');
		$registro = $sql->result_object();
		if ($sql->num_rows() == 0) {
			return $registro;
		} else {
			$registro = $registro[0];
			return $registro;
		}
	}
	
	public function obtenerProvinciaporIdCiudad($idCiudad){
		
		$seleccion = mssql_query(" select p.* from pais p, provincia as pr, municipio as m, ciudad as c where p.IDpais = pr.IDpais and pr.IDprovincia = m.IDprovincia and m.IDmunicipio = c.IDmunicipio and c.IDciudad = '{$idCiudad}' order by descripcion");
		$pais = array();
			while ($registro = mssql_fetch_array($seleccion)) {
				$pais = new Provincia($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
			}
			return $pais;
		
		
	}
	
	public function obtenerProvinciaIdCiudad($idCiudad){
		$seleccion = mssql_query(" select p.* from pais p, provincia as pr, municipio as m, ciudad as c where p.IDpais = pr.IDpais and pr.IDprovincia = m.IDprovincia and m.IDmunicipio = c.IDmunicipio and c.IDciudad = '{$idCiudad}' order by descripcion");
		$registro = mssql_fetch_array($seleccion);
		$pais = new Provincia($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		return $pais;	
	}
	
	public function obtenerProvinciaIdProvincia($idProvincia){
		$seleccion = mssql_query("select p.* from pais as p inner join provincia  as pr on p.IDpais = pr.IDpais and pr.IDprovincia = '{$idProvincia}'");
		$registro = mssql_fetch_array($seleccion);
		$pais = new Provincia($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		return $pais;	
	}
	
	public function registrarProvincia(Provincia $pais= null) {
		mssql_query("INSERT INTO Provincia (descripcion, nacionalidad, descripcion_iso)
			 VALUES ('{$pais->getDescripcion()}', '{$pais->getNacionalidad()}', '{$pais->getDescripcionIso()}')");
	}

	public function actualizarProvincia(Provincia $pais= null) {
		mssql_query("UPDATE Provincia SET descripcion = '{$pais->getDescripcion()}', nacionalidad = '{$pais->getNacionalidad()}', descripcion_iso = '{$pais->getDescripcionIso()}'
			WHERE IDpais = '{$pais->getIdProvincia()}' ");			 
	}
	
	public function ejecutarSQL($sql) {
		$seleccion = mssql_query("select * from pais where ".$sql);
		$listaProvinciaes = array();
		while ($registro = mssql_fetch_array($seleccion)) {
			$listaProvinciaes[] = new Provincia($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		}
		return $listaProvinciaes;
	}


}