<?php
class Texto {

	protected static $_vars = array();
	/**
	 *
	 * Recive como entrada el string a validar
	 */


	public static function idioma($texto = "", $idiomaAlternativo = null, $link = false) {
		$idioma = (is_null($idiomaAlternativo)) ?  IDIOMA : $idiomaAlternativo;
		$arreglo = Texto::cargarIdioma($idioma);
		if (array_key_exists($texto, $arreglo)){
			if (!self::isUTF8($texto)) {
				$texto = utf8_encode($texto);
			}
			//return $arreglo[$texto];
			return  utf8_encode($arreglo[$texto]);
		}
		if (!self::isUTF8($texto)) {
			$texto = utf8_encode($texto);
		}
		return ($link) ? self::formatoLink($texto) : $texto;
	}
	
	public static function formatoLink($texto = "") {
		//filtro los enlaces normales
		$cadenaResultante = preg_replace("/((http|https|www)[^\s]+)/", '<a href="$1">$0</a>', $texto);
		//miro si hay enlaces con solamente www, si es así le añado el http://
		$cadenaResultante = preg_replace("/href=\"www/", 'href="http://www', $cadenaResultante);		
		//saco los enlaces de twitter
		$cadenaResultante = preg_replace("/(@[^\s]+)/", '<a target=\"_blank\"  href="http://twitter.com/$1">$0</a>', $cadenaResultante);
		$cadenaResultante =  str_replace("twitter.com/@", "twitter.com/", $cadenaResultante);
		$cadenaResultante = preg_replace("/(#[^\s]+)/", '<a target=\"_blank\"  href="http://twitter.com/search?q=$1&src=tren">$0</a>', $cadenaResultante);
		$cadenaResultante =  str_replace("twitter.com/search?q=#", "twitter.com/search?q=", $cadenaResultante);
		return $cadenaResultante;
	} 
	

	public static function formatoMoneda($valor = "", $puntoDecimal = 2, $moneda = "$") {
		$valorNuevo = $moneda.number_format($valor, $puntoDecimal, '.', ',');
		return $valorNuevo;
	}

	static function cargarIdioma($archivo, $forzar = false){
		$archivo = strtolower($archivo);
		if (!file_exists("idiomas/{$archivo}_hc.ini")) {
			$archivo = 'es';
		}
		if (isset(self::$_vars[$archivo]) && !$forzar) {
			return self::$_vars[$archivo];
		}
		self::$_vars[$archivo] = parse_ini_file("idiomas/{$archivo}_hc.ini", true);
		return self::$_vars[$archivo];

	}

	public static function _($params) {
		if (!isset($_SESSION['LANGUAGE'])) {
			$_SESSION['LANGUAGE'] = 'es';
		}
		$params = trim($params);
		$array = Configuracion::leerIdioma($_SESSION['LANGUAGE']);
		if(array_key_exists($params, $array)){
			if (!self::isUTF8($params)) {
				$params = utf8_encode($params);
			}
			return $array[$params];
		}
		if(!self::isUTF8($params)){
			$params = utf8_encode($params);
		}
		return $params;
	}

	/**
	 *
	 * Conveirte una cadena en Mayuscula filtrandolo por UTF-8.
	 * @param String $string
	 */
	public static function strtoupper($string){
		if(self::isUTF8($string)){
			$string = utf8_decode($string);
		}
		$string = self::idioma(strtoupper($string));
		return $string;
	}

	/**
	 *
	 * conveirte una cadena en miniscula filtrandolo por UTF-8
	 * @param String $string
	 */
	public static function strtolower($string){
		if(self::isUTF8($string)){
			$string = utf8_decode($string);
		}
		$string = self::idioma(strtolower($string));
		return $string;
	}

	/**
	 *
	 * confirma si una cadena contiene caracteres UTF-8.
	 * @param String $string
	 */
	public static function isUTF8($string)
	{
		for ($idx = 0, $strlen = strlen($string); $idx < $strlen; $idx++)
		{
			$byte = ord($string[$idx]);

			if ($byte & 0x80){
				if (($byte & 0xE0) == 0xC0)
				{
					// 2 byte char
					$bytes_remaining = 1;
				}
				else if (($byte & 0xF0) == 0xE0)
				{
					// 3 byte char
					$bytes_remaining = 2;
				}
				else if (($byte & 0xF8) == 0xF0){
					// 4 byte char
					$bytes_remaining = 3;
				}
				else{
					return false;
				}

				if ($idx + $bytes_remaining >= $strlen) {
					return false;
				}

				while ($bytes_remaining--){
					if ((ord($string[++$idx]) & 0xC0) != 0x80)
					{
						return false;
					}
				}
			}
		}

		return true;
	}

	/**
	 *
	 * Enter description here ...
	 * @param string $string
	 * @param string $formato: Para devolver la fecha deseada.
	 * @return $fecha:
	 * defaul : str
	 * 	$formato:									 |
	 *  str = string formato date YY-MM-DD H:i:s.	 |
	 *  unix = formato Unix.							 |
	 *  dt = Objecto DateTime						 |
	 *  c = string ISO 8601 date.					 |
	 *  y-m-d = string en formato YY-MM-DD			 |
	 *
	 */
	public static function setFormatoFecha($string, $formato = 'str'){
		if ($string == "" || $string == "0000-00-00") {
			return date('Y');
		}
		$fecha=  strtotime($string);
		$fechaFormato = date('c', $fecha);
		switch ($formato){
			case 'str':
				return date('Y-m-d H:i:s', $fecha);
				break;

			case 's':
				return $fechaFormato;
				break;

			case 'unix' :
				return $fecha;
				break;
			case 'dt':
				try{
					$dateTime = new  DateTime($fechaFormato);
				} catch (Exception $e) {
					echo $e->getMessage();
					exit(1);
				}
				return $dateTime;
				break;
			case 'Y-m-d':
				return date('Y-m-d', $fecha);
				break;
			default:
				return date($formato, $fecha);
				break;
		}
	}

	/**
	 *
	 * Retorna la diferencia de dias
	 * @param DateTime $fechaInicio
	 * @param DateTime $fechaFin
	 */
	public static function diferenciaFecha(DateTime $fechaInicio, DateTime $fechaFin) {
		//defino fecha 1
		$ano1 = $fechaInicio->format("Y");
		$mes1 = $fechaInicio->format("m");
		$dia1 = $fechaInicio->format("d");
			
		//defino fecha 2
		$ano2 = $fechaFin->format("Y");
		$mes2 = $fechaFin->format("m");
		$dia2 = $fechaFin->format("d");
			
		//calculo timestam de las dos fechas
		$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
		$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);
			
		//resto a una fecha la otra
		$segundosDiferencia = $timestamp1 - $timestamp2;
		//echo $segundos_diferencia;
			
		//convierto segundos en d�as
		$diasDiferencia = $segundosDiferencia / (60 * 60 * 24);
			
		//obtengo el valor absoulto de los d�as (quito el posible signo negativo)
		$diasDiferencia = abs($diasDiferencia);
			
		//quito los decimales a los d�as de diferencia
		$diasDiferencia = floor($diasDiferencia);
			
		return $diasDiferencia;
	}

	public static function diferenciaEntreFechas($fecha1, $fecha2){
		$fechaInicio= $fecha1;
		$fechaFin= $fecha2;
		$s = strtotime($fechaFin)-strtotime($fechaInicio);
		$d = intval($s/86400);
		$s -= $d*86400;
		$h = intval($s/3600);
		$s -= $h*3600;
		$m = intval($s/60);
		$s -= $m*60;
		$mes = $d/30;
		$trimestre = $d/90;
		$cuatrimestre = $d/120;
		$diferencia['segundos'] = $s;
		$diferencia['minutos'] = $m;
		$diferencia['horas'] = (($d*24)+$h);
		$diferencia['dias'] = $d;
		$diferencia['mes'] = floor($mes);
		$diferencia['trimestre'] = floor($trimestre);
		$diferencia['cuatrimestre'] = floor($cuatrimestre);
		return $diferencia;
	}

	/**
	 *
	 * @author Miguel Canot
	 * @param Date $fecha ...Separada con /
	 * @param int $cantidadDia
	 */
	public static function sumarDia($fecha = '', $cantidadDia = 0) {
		$fechaParametro = explode("/",$fecha);
		if (count($fechaParametro) < 3) {
			$fechaParametro = explode("-",$fecha);
		}
		$fechaSystem = getdate(mktime(0, 0, 0, $fechaParametro[1], $fechaParametro[2], $fechaParametro[0]) + 24*60*60*$cantidadDia);
		return $fechaSystem['year']."/".$fechaSystem['mon']."/".$fechaSystem['mday'];
	}

	static function obtenerNombreDelMes($numeroMes){
		$nombreMes = '';
		switch ($numeroMes){
			case 1:
				$nombreMes = Texto::idioma("Enero");
				break;
			case 2:
				$nombreMes = Texto::idioma("Febrero");
				break;
			case 3:
				$nombreMes = Texto::idioma("Marzo");
				break;
			case 4:
					
				$nombreMes =  Texto::idioma("Abril");
				break;
			case 5:
				$nombreMes =  Texto::idioma("Mayo");
				break;
			case 6:
				$nombreMes =  Texto::idioma("Junio");
				break;
			case 7:
				$nombreMes =  Texto::idioma("Julio");
				break;
			case 8:
				$nombreMes =  Texto::idioma("Agosto");
				break;
			case 9:
				$nombreMes =  Texto::idioma("Septiembre");
				break;
			case 10:
				$nombreMes = Texto::idioma("Octubre");
				break;
			case 11:
				$nombreMes = Texto::idioma("Noviembre");
				break;
			case 12:
				$nombreMes = Texto::idioma("Diciembre");
				break;
		}
			
		return $nombreMes;
	}

	static function obtenerLetraDiaSemana($numeroDia){
		$letraDia = '';
		switch ($numeroDia){
			case 0:
				$letraDia =  "D";
				break;
			case 1:
				$letraDia = "L";
				break;
			case 2:
				$letraDia = "K";
				break;
			case 3:
				$letraDia = "M";
				break;
			case 4:
				$letraDia =  "J";
				break;
			case 5:
				$letraDia =  "V";
				break;
			case 6:
				$letraDia =  "S";
				break;
		}
			
		return $letraDia;
	}

	static function obtenerDiaSemana($numeroDia){
		$letraDia = '';
		switch ($numeroDia){
			case 0:
				$letraDia =  "Domingo";
				break;
			case 1:
				$letraDia = "Lunes";
				break;
			case 2:
				$letraDia = "Martes";
				break;
			case 3:
				$letraDia = "Miércoles";
				break;
			case 4:
				$letraDia =  "Jueves";
				break;
			case 5:
				$letraDia =  "Viernes";
				break;
			case 6:
				$letraDia =  "Sabado";
				break;
		}
			
		return $letraDia;
	}
	

	public static function validarCedula($cedula = '') {
		//Declaración de variables a nivel de método o función.
		$verificador = 0;
		$digito = 0;
		$digitoVerificador=0;
		$digitoImpar = 0;
		$sumaPar = 0;
		$sumaImpar = 0;
		$longitud = strlen($cedula);
		/*Control de errores en el código*/
		try
		{
			//verificamos que la longitud del parametro sea igual a 11
			if ($longitud == 11)
			{
				$digitoVerificador = substr($cedula, 10, 1);
				//recorremos en un ciclo for cada dígito de la cédula
				for ($i = 9; $i >= 0; $i--)
				{
					//si el digito no es par multiplicamos por 2
					$digito = substr($cedula, $i, 1);
					if (($i % 2) != 0)
					{
						$digitoImpar = $digito * 2;
						//si el digito obtenido es mayor a 10, restamos 9
						if ($digitoImpar >= 10)
						{
							$digitoImpar = $digitoImpar - 9;
						}
						$sumaImpar = $sumaImpar + $digitoImpar;
					}
					/*En los demás casos sumamos el dígito y lo aculamos
					 en la variable */
					else
					{
						$sumaPar = $sumaPar + $digito;
					}
				}
				/*Obtenemos el verificador restandole a 10 el modulo 10
				 de la suma total de los dígitos*/
				$verificador = 10 - (($sumaPar + $sumaImpar) % 10);
				/*si el verificador es igual a 10 y el dígito verificador
				 es igual a cero o el verificador y el dígito verificador
				son iguales retorna verdadero*/
				if ((($verificador == 10) > ($digitoVerificador == 0))
				|| ($verificador == $digitoVerificador))
				{
					return true;
				}
			}
			else
			{
				return false;
				echo "La cédula debe contener once(11) digitos";
			}
		}
		catch(e $e)
		{
			return false;
			echo "No se pudo validar la cédula";
		}
		return false;
	}
	
	public static function primeraMayuscula($string){
		if(self::isUTF8($string)){
			$string = utf8_decode($string);
		}
		$string = ucwords(self::idioma(strtolower($string)));
		return $string;
	}
	
	public static function primeraMayusculaPalabraFrase($string = '') {
		$stringNuevo = '';
		$parametroString = explode(" ", $string);
		foreach ($parametroString as $parteString) {
			$stringNuevo .= Text::primeraMayuscula($parteString)." ";
		}
		return trim($stringNuevo);
	}
	
	public static function primeraMayusculaPalabraFraseJunta($string = '') {
		$stringNuevo = '';
		$parametroString = explode(" ", $string);
		foreach ($parametroString as $parteString) {
			$stringNuevo .= Text::primeraMayuscula($parteString);
		}
		return trim($stringNuevo);
	}
	
	public static function validarCorreo($correo = "") {
		if(!preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$correo)) {
			return false;
		} else {
			return true;
		}
	}

	function cortarFrase($frase_entrada,$cortar){ 
		/*
	   $frase_corta=substr($frase_entrada,0,$cortar); // obtener la frase cortada. 
	   $palabras=str_word_count($frase_corta,1); // obtener array con las palabras. 
	   $total_palabras=count($palabras)-1; // contar total array elementos y restar 1 elementos 
	   $palabras=array_splice($palabras,0,$total_palabras); // le quitamos la ultima palabra. 
	   $frase_salida=implode(' ',$palabras); //  y concatenamos con el espacio hacia una cadena. 
	   $frase_salida .= "..."; // se añaden los puntos suspensivos a la cadena obtenida.. 
		*/
		$frase_salida = substr($frase_entrada, 0, $cortar)."...";
	  return $frase_salida; 
	} 

	function textoConPublicidadM($string){ 

	   $resultado = explode('.', $string, 2);
	   $resultado = $resultado[0].".".self::obtenerPublicidadM().$resultado[1];
	   return $resultado;
	} 

	function obtenerPublicidadM() {
		return "";// '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
'<!-- In Text Sancocho Movil -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-5425999171913782"
     data-ad-slot="3358247753"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
	}

	function urlAmigable($url = "") {
		// Tranformamos todo a minusculas

		$url = strtolower($url);

		//Rememplazamos caracteres especiales latinos

		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

		$repl = array('a', 'e', 'i', 'o', 'u', 'n');

		$url = str_replace ($find, $repl, $url);

		// Añaadimos los guiones

		$find = array(' ', '&', '\r\n', '\n', '+', '.'); 
		$url = str_replace ($find, '-', $url);

		// Eliminamos y Reemplazamos demás caracteres especiales

		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

		$repl = array('', '-', '');

		$url = preg_replace ($find, $repl, $url);

		return $url;
	}

	public static function formatoComa($valor = "", $puntoDecimal = 2) {
		$valorNuevo = number_format($valor, $puntoDecimal, '.', ',');
		return $valorNuevo;
	}

	public static function saveImage($inPath,$outPath)
		{ //Download images from remote server
		    $in=    fopen($inPath, "rb");
		    $out=   fopen($outPath, "wb");
		    while ($chunk = fread($in,8192))
		    {
		        fwrite($out, $chunk, 8192);
		    }
		    fclose($in);
		    fclose($out);
		}



/*
	public static function genDonut($listado, $nombreSerie = '') {

		$nombreSerie = Texto::idioma($nombreSerie);
		$res = "";
		foreach ($listado as $valor) {
			$res .= ($res == "") ? "" : ", ";
			$res .= "{
            	label: '{$valor->nombre}',
            	value: {$valor->cantidad}
        	}";
		}
		return $res;
	}

	public static function genSeriesLinea($listado, $nombreSerie = '') {
		$nombreSerie = Texto::idioma($nombreSerie);
		$res = "{";
		$res .= "name: '{$nombreSerie}', data: [";
		foreach ($data as $nombre => $valor) {
			$res .= "$valor,";
		}
		$res=substr($res,0, -1);
		$res .= "]}";
		return $res;
	}
	*/


	
}



/*
 * $cadena = $_SERVER["HTTP_HOST"];
 $patrones = array();
 $patrones[0] = '/http\/\/:/';
 $patrones[1] = '/www\./';
 $patrones[2] = '/\.doctores\.do/';
 $patrones[3] = '/\.medicos\.do/';
 $sustituciones = '';
 $usuario=preg_replace($patrones, $sustituciones, $cadena);
 */

?>