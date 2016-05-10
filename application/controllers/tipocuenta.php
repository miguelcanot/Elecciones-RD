<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');

class TipoCuenta extends MY_Controller {
	

	/**
	 * Api Tipo Cuenta
	 */
	
	private $token = "d58n5y7q3Dus_BBkesxG2e_0g0FneXvo1Eg7L8-8TdQ";

	public function apiObtenerTipoCuentaActivo() {
		//$this->authApi("tipocuenta/consulta");
		$this->load->model("ModeloTipoCuenta");
		$resultado = $this->ModeloTipoCuenta->obtenerTipoCuentaActivo(true);
		echo json_encode(array("estatus"=>true, "resultado"=>$resultado));
	}


}
?>