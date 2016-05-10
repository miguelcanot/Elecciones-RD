<?php
/**
 * 
 * Esta es la clase que sube archivos al servidor.
 * @author Grequis Xavier Perez
 * 
 * @category  	Upload
 * @package     Modelo 
 * @copyright  Copyright (c) 2010 SoftwareFactory Team
 *
 */
require_once('upload.php');

Class Subir
{
	/**
	 * 
	 * @var unknown_type
	 */
	var $maxupload_size = 300000;
	
	/**
	 * 
	 * @var unknown_type
	 */
	var $isPosted;
	
		/**
		 * 
		 * @param $name
		 * @param $path
		 * @param $new_name
		 */
	public static function subir_en_directorio($nombre, $directorio, $nuevoNombre=null)
    {
		if(isset($_FILES[$nombre])){
			if(!$nuevoNombre) {
				$nuevoNombre = $_FILES[$nombre]['name'];
			}
			return move_uploaded_file($_FILES[$nombre]['tmp_name'], $directorio . $nuevoNombre);
		} else {
			return false;
		}
	}

    
  	/**
  	 * 
  	 * @param $field //es el nombre del archivo con su extenxion
  	 */
    public static function comprobarExistenciaArchivo($nombre)
    {
    	if(file_exists($nombre)){
    		return true;
    	}else{
    		return false;
    	}
    }
    /**
     * Sube archivos al servidor, directamente en la carpeta documentos
     * @param $field nombre del campo
     * @param $new_name
     */
    public static function archivo($campo, $nuevoNombre=null, $directorio=null){
    	
    	if($directorio==null){
    	$directorio = DOC_UPLOAD_PATH;
    	}
		
		if(file_exists($_FILES[$campo]['name'])){			
			return self::subir_en_directorio($campo, $directorio, $nuevoNombre);			
		}else{			
			return false;
		}   	 	
				
    }
    
    /**
     * 
     * @param $campo
     * @param $new_name
     */
    
    public static function imagen($campo, $nuevoNombre=null, $directorio = null, $formato = null, $formatosAceptados = null, $tamanoMax = 0, $calidad = 100, $x = "", $y = "", $crop = false) {
    	$procesada = false;
    	$mensaje = "";
    	if ($directorio == null) {
    		$directorio = IMG_UPLOAD_PATH;
    	} else {
    		$directorio = $directorio;
    	}
    	if (isset($_FILES[$campo])) {
	    	$tipo =  $_FILES[$campo]["type"];
	    	$tamano = $_FILES[$campo]["size"];
	    	$extension = explode('/', $tipo);
	    	$formato = ($formato == null) ? $extension[1] : $formato;
	    	$ext = $formato;
	    	if ($formatosAceptados != null) {
	    		if (!in_array(Texto::strtolower($extension[1]), $formatosAceptados)) {
	    			return array("estado"=>false, "tipo"=>"", "nombre"=>"", "tamano"=>"", "ext"=>"", "mensaje"=>"Formato_Incorrecto");
	    		}	
	    	}
	    	if ($nuevoNombre!=null) {
	    		$nombre = $nuevoNombre;
	    		$nuevoNombre = $nuevoNombre.".".$formato;    	
	    	} else {
	    		$nombre = $_FILES[$campo]['name'];
	    		$nuevoNombre = $_FILES[$campo]['name'];
	    	}
	    	if (self::imagenOptimizada($_FILES[$campo]['tmp_name'], $directorio, $nombre,  $ext, $calidad, $x, $y, $crop)) {
	    		$procesada = true;
	    		$mensaje = "Cargada";
	    	}
	    	return array("estado"=>$procesada, "tipo"=>$tipo, "nombre"=>$nombre, "tamano"=>$tamano, "ext"=>$ext, "mensaje"=>$mensaje);
    	} else {
    		return array("estado"=>false, "tipo"=>"", "nombre"=>"", "tamano"=>"", "ext"=>"", "mensaje"=>"Error_Campo");
    	}
    }

    public static function imagenFile($campo, $nuevoNombre=null, $directorio = null, $formato = null, $formatosAceptados = null, $tamanoMax = 0, $calidad = 100, $medida = null, $crop = false) {
        $procesada = false;
        $mensaje = "";
        if ($directorio == null) {
            $directorio = IMG_UPLOAD_PATH;
        } else {
            $directorio = $directorio;
        }
        $tipo =  $campo["type"];
        $tamano = $campo["size"];
        $extension = explode('/', $tipo);
        $formato = ($formato == null) ? $extension[1] : $formato;
        $ext = $formato;
        if ($formatosAceptados != null) {
            if (!in_array(Texto::strtolower($extension[1]), $formatosAceptados)) {
                return array("estado"=>false, "tipo"=>"", "nombre"=>"", "tamano"=>"", "ext"=>"", "mensaje"=>"Formato_Incorrecto");
            }   
        }
        if ($nuevoNombre!=null) {
            $nombre = $nuevoNombre;
            $nuevoNombre = $nuevoNombre.".".$formato;       
        } else {
            $nombre = $campo['name'];
            $nuevoNombre = $campo['name'];
        }
        if (self::imagenCrop($campo['tmp_name'], $directorio, $nombre,  $ext, $calidad, $medida, $crop)) {
            $procesada = true;
            $mensaje = "Cargada";
        }
        return array("estado"=>$procesada, "tipo"=>$tipo, "nombre"=>$nombre, "tamano"=>$tamano, "ext"=>$ext, "mensaje"=>$mensaje);
    }

     function imagenCrop($archivo = "", $directorio, $nuevoNombre, $ext, $calidad, $medida, $crop = false) {
        $foo = new Upload($archivo);
        if ($foo->uploaded) {
            // save uploaded image with a new name
            $foo->file_new_name_body = "full-".$nuevoNombre;
            $foo->file_new_name_ext = $ext;
            $foo->Process($directorio);
            if (!$foo->processed) {
                return false;
            }
            foreach ($medida as $key => $value) {
                $foo->file_new_name_body = $value["pref"].$nuevoNombre;
                $foo->file_new_name_ext = $ext;
                $foo->image_ratio_crop = $crop;
                $foo->image_resize = true;
                $foo->image_x = $value["x"];
                $foo->image_ratio_y = true;
                $foo->image_resize = true;
                $foo->image_y = $value["y"];
                $foo->image_ratio_y = false;
                $foo->Process($directorio);
                if (!$foo->processed) {
                    return false;
                }
            }
            $foo->Clean();
            return true;
        } else {
            return false;
        }
    }
    
    function imagenOptimizada($archivo = "", $directorio, $nuevoNombre,  $ext, $calidad, $x = "", $y = "", $crop = false) {
    	$foo = new Upload($archivo);
    	if ($foo->uploaded) {
    		// save uploaded image with a new name
    		$foo->file_new_name_body = "full-".$nuevoNombre;
    		$foo->file_new_name_ext = $ext;
    		$foo->Process($directorio);
    		if (!$foo->processed) {
    			return false;
    		}

            $foo->file_new_name_body = "ag-".$nuevoNombre;
            $foo->file_new_name_ext = $ext;
            $foo->image_ratio_crop = true;
            $foo->image_resize = true;
            $foo->image_x = 524;
            $foo->image_ratio_y = true;
            $foo->image_resize = true;
            $foo->image_y = 646;
            $foo->image_ratio_y = false;
            $foo->Process($directorio);
            if (!$foo->processed) {
                return false;
            }
    		
    		// save uploaded image with a new name,
    		// resized to 100px wide
    		$foo->file_new_name_body = $nuevoNombre;
    		$foo->file_new_name_ext = $ext;
    		$foo->jpeg_quality = $calidad;
    		if ($crop) {
    			///$foo->image_crop  = '10%';
    			$foo->image_ratio_crop = true;
    		}
    		
    		
    		if ($x != "") {
    			$foo->image_resize = true;
    			$foo->image_x = $x;
    			$foo->image_ratio_y = true;
    		}
    		if ($y != "") {
    			$foo->image_resize = true;
    			$foo->image_y = $y;
    			$foo->image_ratio_y = false;
    		} 
    		
    		$foo->Process($directorio);
    		if ($foo->processed) {
    			$foo->Clean();
    			return true;
    		} else {
    			return false;
    		}
    	} else {
    		return false;
    	}
    }
    
    public static function convertirBinario($field){
    	
    	self::subir_en_directorio($field,  'imagenes/temp/');
    	$nombre = $_FILES[$field]["name"];
		$directorio = IMG_PATH.'temp/'.$nombre;
		
    	$image = imagecreatefromjpeg($directorio);
		ob_start();
		imagejpeg($image);
		$jpg = ob_get_contents();
		ob_end_clean();
		
		return $jpg;
    	
    } 
    
    /**
     * 
     * @param $field
     * @param $overwrite
     * @param $mode
     */
	public static function convertirImageBinario($field)
	{		
			//if ($_FILES[$field]['size'] < $this->maxupload_size && $_FILEs[$field]['size'] >0){
				
				self::subir_en_directorio($field,  IMG_PATH.'temp/');
				
				$tamanio = $_FILES[$field]["size"];
				$tipo = $_FILES[$field]["type"];
				$nombre = $_FILES[$field]["name"];
				$directorio = IMG_PATH.'temp/'.$nombre;

				if(file_exists($directorio)){

					//$fp = fopen($directorio, "rb");
				    //$contenido = fread($fp, $tamanio);
				    //$contenido = addslashes($contenido);
				    $contenido = "'".addslashes(fread(fopen($directorio, "r+"), filesize($directorio)))."'";
				    
				  //  fclose($fp);

				    return $contenido;
				}else{
					return false;
				}			
				
				//$path = 'imagenes/temp/'.$_FILES[$field]['name'];				
				/*
				if(file_exists($path)){
				$binario_contenido = "'".addslashes(fread(fopen($directorio, "r+"), filesize($directorio)))."'";					
				}else {
					throw new Exception("No se encuentra el archivo para convetir en binary");
				}				
				*/			
//			}
			
	}
	
}
?>