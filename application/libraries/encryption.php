<?php
class Encryption {
	var $skey = "001eLeccionesRD2016";

	public function safe_b64encode($string) {
		$data = base64_encode($string);
		$data = str_replace(array('+','/','='),array('-','_',''),$data);
		return $data;
	}

	public function safe_b64decode($string) {
		$data = str_replace(array('-','_'),array('+','/'),$string);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
			$data .= substr('====', $mod4);
		}
		return base64_decode($data);
	}
	
	public static function encodeCrc($value = "", $tamano = 32) {
		if ($tamano == 32) {
			return trim(hash("crc32", $value));
		}
		return trim(hash("crc32", $value));
	}
	

	public static function encode($value){
		$converter = new Encryption();
		if(!$value){return false;}
		$text = $value;
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $converter->skey, $text, MCRYPT_MODE_ECB, $iv);
		return trim($converter->safe_b64encode($crypttext));
	}

	public static function decode($value){
		$converter = new Encryption();
		if(!$value){return false;}
		$crypttext = $converter->safe_b64decode($value);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $converter->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
		return trim($decrypttext);
	}
	
	public static function encrypt($value = '') {
		//Data to be encrypted.Take note that it has to be text.
		$Input_data  = "i want a apple";//Place the text here
		$Encrypter_variables= array("1", "2", "3", "4", "5", "6", "7", "8", "9");
		$Variables_replace = array("9", "8", "7", "6", "5", "4", "3", "2", "1");
		//$Encrypter_variables= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
		//$Variables_replace = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "%", "!", "@", "#", "$", "^", "&", "*","~", "+", ":", "-", "=", "?", "'", ".", "<");
		$New_data = str_replace($Encrypter_variables, $Variables_replace, $value);
		return $New_data;
	}
	
	public static function desencrypt($value = '') {
		//Data to be decrypted
		$Output_data  = "9 ?1$: 1 1&&@5";////Place the encrypted data here
		//$Decrypter_variables =  array("1", "2", "3", "4", "5", "6", "7", "8", "9", "%", "!", "@", "#", "$", "^", "&", "*","~", "+", ":", "-", "=", "?", "'", ".", "<");
		//$Variables_assign  = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
		$Decrypter_variables = array("9", "8", "7", "6", "5", "4", "3", "2", "1", "0");
		$Variables_assign = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
		$Newer = str_replace($Decrypter_variables, $Variables_assign  , $value);
		return $Newer;
	}
}
?>