<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "informacion";
$route['inicio'] = "informacion";
$route['terminoycondicion'] = "informacion/terminoycondicion";
$route['panel'] = "usuario";
$route['cambiarcontrasena'] = "usuario/cambiarcontrasena";
$route['perfil'] = "usuario/perfil";
$route['estadisticas'] = "estadistica/d";
$route['informate'] = "postsocial";


$route['oscarr/(:any)/(:any)'] = "oscar/u/$1/$2";


$route['contactenos'] = "contacto/contactar";
$route['propiedades/(:any)'] = "propiedad/index/$1";
$route['agente/(:any)'] = "agentes/detalle/$1";

$route['propiedad/d/(:any)'] = "propiedad/detalle/$1";

//$route['propiedad/a/(:any)'] = "propiedad/$1";

$route['video'] = "informacion/video";
$route['contact'] = "informacion/contact";
$route['rc'] = "informacion/rc";

$route['dashboard'] = "estadistica";
$route['admin'] = "usuario";
$route['b'] = "blog";
$route['r/(:num)'] = "blog/r/$1";
$route['r/(:num)/(:any)'] = "blog/r/$1/$2";
$route['d/(:any)'] = "blog/detalle/$1";
$route['c/(:any)'] = "blog/categoria/$1";
$route['cr/(:any)'] = "blog/categoriaregistro/$1";

$route['errorpagina'] = 'configuracion/errorpagina';
$route['404'] = 'configuracion/errorpagina';
//$route['404_override'] = '';
$route['404_override'] = 'configuracion/errorpagina';
//$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
