<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
/**
 *
 * @category   Db
 * @package    modelos
 * @copyright  Copyright (c) 2016 DominicanCode.
 * @license    ---
 */
/**
 * @see Modelo
 * @see entidades: Denuncia
 */

class ModeloDenuncia extends CI_Model {

	
	public function obtenerDenuncia($inicio = 0, $limite = 10, $busqueda = "", $encode = false) {
		$sql = $this->db->select('denuncia.*');
		$sql = $this->db->from('denuncia');
		if ($busqueda != "") {
			$sql = $this->db->where("(Denunciante like '%{$busqueda}%' or Comentario like '%{$busqueda}%')");
		}
		$sql = $this->db->limit($limite, $inicio);
		$sql = $this->db->order_by("Fecha", "desc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDDenuncia = ($encode) ? Encryption::encode($registro->IDDenuncia) : $registro->IDDenuncia;
			$registro->Imagen = (file_exists(IMAGE_UPLOAD."denuncia/"."full-".$registro->Imagen) && $registro->Imagen != "") ? IMAGEDENUNCIA."full-".$registro->Imagen : "";
		}
		return $sql->result_object();
	}
	
	public function obtenerDenunciaDetalle($idDenuncia, $encode = false) {
		$sql = $this->db->select('denuncia_detalle.*, tipo_denuncia.Nombre as TipoDenuncia');
		$sql = $this->db->from('denuncia_detalle');
		$sql = $this->db->join('tipo_denuncia', 'denuncia_detalle.IDTipoDenuncia = tipo_denuncia.IDTipoDenuncia', 'inner');
        $sql = $this->db->where("denuncia_detalle.IDDenuncia", $idDenuncia);
		$sql = $this->db->order_by("tipo_denuncia.Nombre", "desc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDDenuncia = ($encode) ? Encryption::encode($registro->IDDenuncia) : $registro->IDDenuncia;
		}
		return $sql->result_object();
	}	
	

	public function obtenerDenunciaIdMunicipio($idMunicipio = "", $encode = false) {
		$sql = $this->db->where("IDMunicipio", $idMunicipio);
		$sql = $this->db->order_by("Nombre", "asc");
		$sql = $this->db->get("Denuncia");
		foreach ($sql->result_object() as $registro) {
			$registro->IDDenuncia = ($encode) ? Encryption::encode($registro->IDDenuncia) : $registro->IDDenuncia;
			$registro->IDMunicipio = ($encode) ? Encryption::encode($registro->IDMunicipio) : $registro->IDMunicipio;
		}
        return $sql->result_object();
	}

	public function obtenerDenunciaActivo($encode = false) {
		$sql = $this->db->select('denuncia.*');
		$sql = $this->db->from('denuncia');
        $sql = $this->db->where("Estatus", "A");
		$sql = $this->db->order_by("Fecha", "desc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDDenuncia = ($encode) ? Encryption::encode($registro->IDDenuncia) : $registro->IDDenuncia;
		}
		return $sql->result_object();
	}	
	
	public function obtenerTipoDenunciaActivo($encode = false) {
		$sql = $this->db->select('*');
		$sql = $this->db->from('tipo_denuncia');
        $sql = $this->db->where("Estatus", "A");
		$sql = $this->db->order_by("Nombre", "asc");
		$sql = $this->db->get();
		foreach ($sql->result_object() as $registro) {
			$registro->IDTipoDenuncia = ($encode) ? Encryption::encode($registro->IDTipoDenuncia) : $registro->IDTipoDenuncia;
		}
		return $sql->result_object();
	}	
	
	function existeDenunciaEstatus($idDenuncia = 0, $estatus) {
		$sql = $this->db->select('estatus');
		$sql = $this->db->from('denuncia');
		$sql = $this->db->where('IDDenuncia', $idDenuncia);
		$sql = $this->db->where('estatus', $estatus);
		$sql = $this->db->get();
		if ($sql->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}

	function registrar($objeto) {
		$this->db->insert('denuncia', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}

	function actualizar($objeto) {
		$this->db->where('IDDenuncia', $objeto["IDDenuncia"]);
		$this->db->update('denuncia', $objeto);
	}
	
	function eliminar($objeto) {
		$this->db->where('IDDenuncia', $objeto["IDDenuncia"]);
		$this->db->update('denuncia', $objeto);
	}
    
    function registrarDetalle($objeto) {
		$this->db->insert('denuncia_detalle', $objeto);
		$query = $this->db->query("select @@IDENTITY as id");
		$registro = $query->result_array();
		$registro = $registro[0];
		return $registro["id"];
	}
	
	/**
	* Estadisticas
	*/
	public function obtenerDenunciaMunicipios($encode = false) {
		$sql = $this->db->query('SELECT m.Nombre, COUNT(m.IDMunicipio) as Cantidad FROM denuncia AS d INNER JOIN recinto AS r ON d.IDRecinto = r.IDRecinto INNER JOIN municipio AS m ON m.IDMunicipio = r.IDMunicipio GROUP BY m.IDMunicipio order by Cantidad desc');
		$listaEtiqueta = array();
		$listaValor = array();
		foreach ($sql->result_object() as $registro) {
			$listaEtiqueta[] = $registro->Nombre;
			$listaValor[] = $registro->Cantidad;
		}
		return array("etiqueta"=>$listaEtiqueta, "valor"=>$listaValor);
	}	
	
	public function obtenerDenunciaRecinto($encode = false) {
		$sql = $this->db->query('SELECT r.Nombre, COUNT(r.IDRecinto) AS Cantidad FROM denuncia AS d 
		INNER JOIN recinto AS r ON d.IDRecinto = r.IDRecinto 
		GROUP BY r.IDRecinto ORDER BY Cantidad DESC');
		$listaEtiqueta = array();
		$listaValor = array();
		foreach ($sql->result_object() as $registro) {
			$listaEtiqueta[] = $registro->Nombre;
			$listaValor[] = $registro->Cantidad;
		}
		return array("etiqueta"=>$listaEtiqueta, "valor"=>$listaValor);
	}	
	
	public function obtenerCantidadDenuncia() {
		$sql = $this->db->query("SELECT (SELECT COUNT(IDDenuncia) AS cantidad FROM denuncia WHERE Estatus = 'A') AS A, (SELECT COUNT(IDDenuncia) AS cantidad FROM denuncia WHERE Estatus = 'P') AS P");
		if ($sql->num_rows() == 0) {
			return $sql->result_object();
		} else {
			$registro = $sql->result_object();
			$registro = $registro[0];
			return $registro;
		}
	}	

}
?>