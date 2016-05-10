<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	class EntityLoader {
		/**
		 * /**
		 * @author: Grequis Xavier Perez	 
		 * Metodo que incluye un archivo .php correspondiente a una entidad del sistema para ser utilizada.	
		 *
		 * @param string $entidad // entidad.php
		 */
		function __construct() {
			$this->entidades();
		}
		
		public static function entidad($entidad){
		 
	        $file = APPPATH . "entity/$entidad";
	        if (! is_file($file)) {            
	                echo "$entidad no encontrada"; 
	                return false;          
	        }
	        include_once $file;    
		}
		
		/**
		 * @author: Grequis Xavier Perez	 
		 * Metodo que incluye todas las entidades del sistema para ser utilizadas. 
		 */	
		public static function entidades() {
			$path =  APPPATH."entity/";
			
			//abrimos la carpeta
			$dir = opendir($path);
				
			//Mostramos los archivos
			while ($elemento = readdir($dir))
			{		 
				if ($elemento != "." && $elemento != "..") 
				{
					$esPhp = strpos($elemento, '.php');
						if ($esPhp == true) {
							
					// incluye las entidades ..			
						self::entidad( $elemento);
						}						
				}			
			}
			//Cerramos la carpeta
			closedir($dir);	
			 unset($dir);			 
		}
	}
?>