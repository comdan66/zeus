<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";

$route['admin']        = 'admin/main';
$route['admin/edit']   = 'admin/main/edit';
$route['admin/login']  = 'admin/main/login';
$route['admin/logout'] = 'admin/main/logout';

$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */