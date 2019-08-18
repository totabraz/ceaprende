<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'admin/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['setup']  					                = 'setup/setup';
$route['setup/instalar']  					        = 'setup/setup/install';

$route['admin/login']						        = 'admin/login';
$route['admin/admin']     			    	        = 'admin';
$route['admin/home']			    	            = 'admin/home';
$route['logout']              				        = 'admin/logout';

$route['home']                                      = 'admin/';

$route['compartilhar']                              = 'compartilhar/';
$route['compartilhar/listar']                       = 'compartilhar/listar';
$route['compartilhar/cadastrar']                    = 'compartilhar/cadastrar';
$route['compartilhar/editar']                       = 'compartilhar/editar';
$route['compartilhar/excluir/:num']                 = 'compartilhar/excluir';

$route['aprender']                                  = 'aprender/listar';
$route['aprender/listar']                                  = 'aprender/listar';
$route['aprender/:num/']                            = 'aprender/categorias';
$route['aprender/:num/:num']                        = 'aprender/assunto';
$route['aprender/:num/:num/:num']                   = 'aprender/responder';
$route['aprender/:num/:num/:num']                   = 'aprender/curtir';
$route['aprender/buscar']                           = 'aprender/buscar';


$route['admin/users']              	                = 'users/list';
$route['admin/users/listar']              	        = 'users/list';
$route['admin/users/cadastrar']                     = 'users/create';
$route['admin/users/blocker/:num']                  = 'users/blocker';
$route['admin/users/editar/:num']                   = 'users/edit';



