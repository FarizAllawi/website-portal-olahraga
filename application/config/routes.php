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
$route['default_controller'] = 'HomeController/indexUser';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['review'] = 'NewsController/reviews';
$route['review/action/:num'] = 'NewsController/reviews_actions';
$route['review/action/:num/:num'] = 'NewsController/reviews_actions';
$route['review/delete/:num'] = 'NewsController/reviews_delete';


$route['admin/user'] = 'UserController/index';
$route['admin/user/action'] = 'UserController/actions';
$route['admin/user/action/:num'] = 'UserController/actions';
$route['admin/user/delete/:num'] = 'UserController/delete';

$route['admin/sport-type'] = 'SportController/sportType';
$route['admin/sport-type/action'] = 'SportController/sportType_actions';
$route['admin/sport-type/action/:num'] = 'SportController/sportType_actions';
$route['admin/sport-type/delete/:num'] = 'SportController/sportType_delete';

$route['admin/league'] = 'LeagueController/indexAdmin';
$route['admin/league/action'] = 'LeagueController/actions';
$route['admin/league/action/:num'] = 'LeagueController/actions';
$route['admin/league/delete/:num'] = 'LeagueController/delete';

$route['admin/sport-club'] = 'SportController/sportClub';
$route['admin/sport-club/action'] = 'SportController/sportClub_actions';
$route['admin/sport-club/action/:num'] = 'SportController/sportClub_actions';
$route['admin/sport-club/delete/:num'] = 'SportController/sportClub_delete';

$route['admin/player-type'] = 'AthleteController/playerType';
$route['admin/player-type/action'] = 'AthleteController/playerType_actions';
$route['admin/player-type/action/:num'] = 'AthleteController/playerType_actions';
$route['admin/player-type/delete/:num'] = 'AthleteController/playerType_delete';

$route['admin/foul-type'] = 'AthleteController/foulType';
$route['admin/foul-type/action'] = 'AthleteController/foulType_actions';
$route['admin/foul-type/action/:num'] = 'AthleteController/foulType_actions';
$route['admin/foul-type/delete/:num'] = 'AthleteController/foulType_delete';

$route['admin/match/'] = 'MatchController/indexAdmin';
$route['admin/match/action/:num/:num'] = 'MatchController/actions';
$route['admin/match/action/:num/:num/:num'] = 'MatchController/actions';
$route['admin/match/delete/:num'] = 'MatchController/delete';

$route['admin/athlete'] = 'AthleteController/athlete';
$route['admin/athlete/action/:num'] = 'AthleteController/actions';
$route['admin/athlete/action/:num/:num'] = 'AthleteController/actions';
$route['admin/athlete/delete/:num'] = 'AthleteController/delete';

$route['admin/foul'] = 'AthleteController/foul';
$route['admin/foul/action/:num'] = 'AthleteController/foul_actions';
$route['admin/foul/action/:num/:num'] = 'AthleteController/foul_actions';
$route['admin/foul/delete/:num'] = 'AthleteController/foul_delete';

$route['admin/news'] = 'NewsController/news';
$route['admin/news/action/:num'] = 'NewsController/news_actions';
$route['admin/news/action/:num/:num'] = 'NewsController/news_actions';
$route['admin/news/delete/:num'] = 'NewsController/news_delete';