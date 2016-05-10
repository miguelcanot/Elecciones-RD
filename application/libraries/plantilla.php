<?php


class Plantilla {
	
    public $titulo;
    public $encabezado;
    public $cuerpo;
    private $pie;
    private $tipo;
    private $archivo;
    private $css='';    
    private $html;
    private $path;
    
    public static function iniciar($path="",$archivo='default', $extension = "html", $url = 'plantillas') {
    	
    	//PLANTILLA_PATH;
        //global $debut_chemin;
        
        $filename = PLANTILLA.$archivo.".".$extension;
        $handle = fopen($filename,'r');
        $html = fread($handle,filesize($filename));
        $css = $path;
        $plantilla = new EntPlantilla("", "", "", "", "", $archivo, $css, $html, "");
        fclose($handle);
        return $plantilla;
    }
    
    
    public static function replace(EntPlantilla $plantilla, $before,$after) {
        if ($before{0}!="{")
            $before="{".$before."}";
        $plantilla->html = str_replace($before,$after,$plantilla->html);
        return $plantilla;
    }
    
    public static function get(EntPlantilla $plantilla) {
        $plantilla = self::replace($plantilla, '{CSS_FILE}',$plantilla->css);
        $plantilla = self::replace($plantilla, '{HEAD}',$plantilla->encabezado);
        $plantilla = self::replace($plantilla, '{BODY}',$plantilla->cuerpo);
        $plantilla = self::replace($plantilla, '{PIE}',$plantilla->pie);
        return $plantilla->html;
        
    }
    
    public function campos(){
    	
    }
    
   
}

?>