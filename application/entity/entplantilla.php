<?php
class EntPlantilla {
	public $titulo;
    public $encabezado;
    public $cuerpo;
    public $pie;
    public $tipo;
    public $archivo;
    public $css='';    
    public $html;
    public $path;
    
    function __construct($titulo, $encabezado, $cuerpo, $pie, $tipo, $archivo, $css, $html, $path) {
    	$this->titulo = $titulo;
    	$this->encabezado = $encabezado;
    	$this->cuerpo = $cuerpo;
    	$this->pie = $pie;
    	$this->tipo = $tipo;
    	$this->archivo = $archivo;
    	$this->css = $css;
    	$this->html = $html;
    	$this->path = $path;
    }
}
?>