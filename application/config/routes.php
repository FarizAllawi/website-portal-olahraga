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
$route['default_controller'] = 'home/indexUser';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/user/action'] = 'user/actions';
$route['admin/user/action/:num'] = 'user/actions';
$route['admin/user/delete/:num'] = 'user/delete';

$route['admin/sport-type'] = 'sport/sportType';
$route['admin/sport-type/action'] = 'sport/sportType_actions';
$route['admin/sport-type/action/:num'] = 'sport/sportType_actions';
$route['admin/sport-type/delete/:num'] = 'sport/sportType_delete';

$route['admin/league'] = 'league/indexAdmin';
$route['admin/league/action'] = 'league/actions';
$route['admin/league/action/:num'] = 'league/actions';
$route['admin/league/delete/:num'] = 'league/delete';

$route['admin/sport-club'] = 'sport/sportClub';
$route['admin/sport-club/action'] = 'sport/sportClub_actions';
$route['admin/sport-club/action/:num'] = 'sport/sportClub_actions';
$route['admin/sport-club/delete/:num'] = 'sport/sportClub_delete';


