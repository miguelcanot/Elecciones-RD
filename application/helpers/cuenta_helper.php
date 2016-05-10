<?php
	function obtenerCuentaUsuario() {
		$ci = get_instance();
		$ci->load->Model("ModeloCuenta");
		$usuario = $ci->session->userdata("sUsuario");
		return $ci->ModeloCuenta->obtenerCuentaUsuarioKey($usuario["id"]); 
	}
	
	function obtenerCuentaPaginaUsuario() {
		$ci = get_instance();
		$ci->load->Model("ModeloCuenta");
		$usuario = $ci->session->userdata("sUsuario");
		return $ci->ModeloCuenta->obtenerCuentaPaginaUsuarioKey($usuario["id"]); 
	}
	
	function obtenerCuentaGrupoUsuario() {
		$ci = get_instance();
		$ci->load->Model("ModeloCuenta");
		$usuario = $ci->session->userdata("sUsuario");
		return $ci->ModeloCuenta->obtenerCuentaGrupoUsuarioKey($usuario["id"]); 
	}
?>