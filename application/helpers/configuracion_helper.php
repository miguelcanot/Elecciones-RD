<?php
function obtenerConfiguracion()
{
    $CI = get_instance();

    $CI->load->model('ModeloConfiguracion');

    return $CI->ModeloConfiguracion->obtenerConfiguracion();
}

function obtenerTimezoneUsuarioSesion()
{
    $CI = get_instance();

    $CI->load->model('ModeloTimezone');
	$usuario = $CI->session->userdata("sUsuario");
    return $CI->ModeloTimezone->obtenerTimezonePorIdUsuarioArray($usuario['id']);
}

function obtenerDatoUsuario()
{
    $CI = get_instance();

    $CI->load->model('ModeloUsuario');

    return $CI->ModeloUsuario->obtenerUsuarioUrlIdUsuario(16);
}

function obtenerCuentaSocialUsuario()
{
    $CI = get_instance();

    $CI->load->model('ModeloCuenta');

    return $CI->ModeloCuenta->obtenerCuentaActivaUsuario(16);
}
