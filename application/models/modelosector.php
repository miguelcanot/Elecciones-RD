<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class ModeloSector extends CI_Model {

	public function obtenerSector($encode = false){
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->get('sector');
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$idSector = ($encode) ? Encryption::encode($registro['IDsector']) : $registro['IDsector'];
			$lista[] = new EntSector($idSector, $registro['IDciudad'], $registro['descripcion'], $registro['estatus']);
		}
		return $lista;
	}

	public function obtenerSectorIdCiudad($idCiudad = 0, $encode = false, $json = false){
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->where('IDciudad', $idCiudad);
		$sql = $this->db->get('sector');
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			if ($json) {
				$idSector = ($encode) ? Encryption::encode($registro['IDsector']) : $registro['IDsector'];
				$lista[] = array("idSector"=>$idSector, "idCiudad"=>$registro['IDciudad'], "descripcion"=>$registro['descripcion']);
			} else {
				$idSector = ($encode) ? Encryption::encode($registro['IDsector']) : $registro['IDsector'];
				$lista[] = new EntSector($idSector, $registro['IDciudad'], $registro['descripcion'], $registro['estatus']);
			}
		}
		return $lista;
	}

	public function obtenerSectorePorId($idSector = 0){
		$sql = $this->db->query("select * from sector where IDsector = '{$idSector}'");
		$registro = $sql->result_array();
		if ($sql->num_rows() == 0) {
			$sector = new EntSector("", "", "", "");
		} else {
			$registro = $registro[0];
			$sector = new EntSector($registro['IDsector'], $registro['IDciudad'], $registro['descripcion'], $registro['estatus']);
		}
		return $sector;
	}

	public function obtenerSectorActivo($encode = false){
		$sql = $this->db->order_by("descripcion", "asc");
		$sql = $this->db->where("estatus", "A");
		$sql = $this->db->get('sector');
		$lista = array();
		foreach ($sql->result_array() as $registro) {
			$idSector = ($encode) ? Encryption::encode($registro['IDsector']) : $registro['IDsector'];
			$lista[] = new EntSector($idSector, $registro['IDciudad'], $registro['descripcion'], $registro['estatus']);
		}
		return $lista;
	}

	public function obtenerSectorePorNombre($nombre = ''){
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
		 from Sector) as t where Descripcion = '{$nombre}' order by descripcion");
		$registro = mssql_fetch_array($seleccion);
		$paise = new Sector($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		return $paise;
	}

	
	public function registrarSector(Sector $pais= null) {
		mssql_query("INSERT INTO Sector (descripcion, nacionalidad, descripcion_iso)
			 VALUES ('{$pais->getDescripcion()}', '{$pais->getNacionalidad()}', '{$pais->getDescripcionIso()}')");
	}

	public function actualizarSector(Sector $pais= null) {
		mssql_query("UPDATE Sector SET descripcion = '{$pais->getDescripcion()}', nacionalidad = '{$pais->getNacionalidad()}', descripcion_iso = '{$pais->getDescripcionIso()}'
			WHERE IDpais = '{$pais->getIdSector()}' ");			 
	}
	
	public function ejecutarSQL($sql) {
		$seleccion = mssql_query("select * from pais where ".$sql);
		$listaSectores = array();
		while ($registro = mssql_fetch_array($seleccion)) {
			$listaSectores[] = new Sector($registro['IDpais'], $registro['descripcion'], $registro['nacionalidad'], $registro['descripcion_iso']);
		}
		return $listaSectores;
	}


}