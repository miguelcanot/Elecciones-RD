<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */


/*
 |--------------------------------------------------------------------------
 | Personal Config
 |--------------------------------------------------------------------------
 |
 |
 | 
 */
$host = 'http://localhost:8090/eleccionesrd/';
$tema = "front";
$temaBlog = "blog";
$temaAdmin = "admin";

define("VIEWMODEL", $host.'assets/js/ViewModel/');
define("ASSETS", $host.'assets/');
define("ICO", $host.'assets/ico/');
define("CSS", $host.'assets/css/');
define("JS", $host.'assets/js/');
define("HOST", $host);
define("IMAGE", $host.'assets/img/');
define("IMAGEPOST", $host.'assets/img/post/');
define("IMAGEICON", $host.'assets/img/icon/');
define("IMAGEARTICULO", $host.'assets/img/articulo/');
define("IMAGEPROFILE", $host.'assets/img/perfil/');
define("IMAGETESTIMONIO", $host.'assets/img/testimonio/');
define("IMAGEPUBLICITY", $host.'assets/img/publicity/');
define("FILEUPLOAD", 'assets/file/uploads/');
define("IMAGEAPP", $host.'assets/img/app/');
define("IMGEVENTO", $host.'assets/img/evento/');
define("IMGSTAFF", $host.'assets/img/staff/');
define("IMGPROPIEDAD", $host.'assets/img/propiedad/');

define("IMAGENSLIDE", $host.'assets/img/slide/');
define("IMAGENBANNER", $host.'assets/img/banner/');
define("SCRIPT", $host.'scripts/');
define("IMAGE_UPLOAD", 'assets/img/');
define("IMAGEN_SUBIDA", 'assets/img/subida/');
define("ARCHIVO_SUBIDA", 'archivos/subida/');
define("PLANTILLA", 'assets/plantillas/');
define("ICONO", $host.'assets/img/icon/');
define("TEMA", "template/");
define("PLUGINS", $host.'assets/plugins/');
define("FONTS", $host."assets/font-awesome/");


define("TEMADEFAULT", "template/{$tema}/");
define("ASSETSDEFAULT", $host."assets/{$tema}/");
define("JSDEFAULT", $host."assets/{$tema}/js/");
define("CSSDEFAULT", $host."assets/{$tema}/css/");
define("IMGDEFAULT", $host."assets/{$tema}/img/");
define("PLUGINSDEFAULT", $host."assets/{$tema}/plugins/");

define("TEMABLOG", "template/{$temaBlog}/");
define("JSBLOG", $host."assets/{$temaBlog}/js/");
define("CSSBLOG", $host."assets/{$temaBlog}/css/");
define("IMGBLOG", $host."assets/{$temaBlog}/img/");

define("TEMADEFAULTADMIN", "template/{$temaAdmin}/");
define("JSDEFAULTADMIN", $host."assets/{$temaAdmin}/js/");
define("CSSDEFAULTADMIN", $host."assets/{$temaAdmin}/css/");
define("IMGDEFAULTADMIN", $host."assets/{$temaAdmin}/img/");
