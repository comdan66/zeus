<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";

$route['works/(:any)'] = "works/index/$1";
$route['work/(:num)'] = "works/content/$1";
$route['work/(:any)'] = "works/index";

$route['admin']        = 'admin/main';
$route['admin/edit']   = 'admin/main/edit';
$route['admin/login']  = 'admin/main/login';
$route['admin/logout'] = 'admin/main/logout';

$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */