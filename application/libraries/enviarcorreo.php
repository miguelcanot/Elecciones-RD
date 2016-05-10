<?php
	if ( ! defined('APPPATH')) exit('No direct script access allowed');
	/**
	 * Dominican Code
	 *
	 * Controlador enviar correos 
	 * 
	 * @category   controlador
	 * @package    controladores 
	 * @copyright  Copyright (c) 2013 Dominican Code.
	 * @license    ---
	 */
	/**
	 * @see modelo/mail: PHPMailer *
	 */

	class EnviarCorreo {
		
		/**
		 * Envia un email
		 * @param string $destinatario
		 * @param string $asunto
		 * @param string $cuerpo
		 * @param string $emisor
		 * @param string $contrasena
		 * @return boolean
		 */
		
		function comprobarExistencia($paquete, $archivo, $clase = "") {
			if (!class_exists($clase)) {
				Cargador::modeloPaquete($paquete,$archivo);
			}
		}
		
		static function enviarEmailComun($destinatario, $asunto, $cuerpo, $empresa, $emisor, $contrasena, $host, $puerto, $archivo = null) {
			require "mail/PHPMailerAutoload.php";
			$mail = new PHPMailer;//PHPMailer::getInstancia();
			$mail -> From = $emisor;
			$mail -> FromName = $empresa;
			$mail -> AddAddress($destinatario);
			$mail -> Subject = $asunto;
			$mail -> Body = $cuerpo;
			$mail -> IsHTML(true);
			$mail->IsSMTP();
			//$mail->SMTPSecure = 'ssl';
			//$mail->Host = 'smtp.gmail.com';
			$mail->Host = $host;//'ssl://smtp.gmail.com';
			//ssl://smtpout.secureserver.net
			$mail->Port = $puerto;//465;
			$mail->SMTPAuth = true;
			$mail->Username = $emisor;
			$mail->Password = $contrasena;
			if ($archivo != null) {
				$mail->AddAttachment($archivo['direccion'], $archivo['nombre']);
			}
			try {
				$mensaje = $mail->Send();
				return array("estatus"=>true, "mensaje"=>$mensaje);
			} catch (Exception $e) {
				return array("estatus"=>false, "mensaje"=>$e);
			}
		}
		
	
	}
?>