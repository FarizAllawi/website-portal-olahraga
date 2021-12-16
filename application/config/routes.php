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

// USER
$route['login'] = 'UserController/loginUser';
$route['logout'] = 'UserController/logout';
$route['news/(:any)'] = 'NewsController/news_page';
$route['sport/(:any)'] = 'SportController/sport';
$route['league/(:any)'] = 'LeagueController/league';
$route['league/(:any)/match'] = 'LeagueController/league_match';

$route['review'] = 'NewsController/reviews';
$route['review/action/:num'] = 'NewsController/reviews_actions';
$route['review/action/:num/:num'] = 'NewsController/reviews_actions';
$route['review/delete/:num'] = 'NewsController/reviews_delete';

// ADMIN
$route['admin/login'] = 'UserController/loginAdmin';
$route['admin/dashboard'] = 'HomeController/indexAdmin';


$route['admin/user'] = 'UserController/index';
$route['admin/user/action'] = 'UserController/actions';
$route['admin/user/action/:num'] = 'UserController/actions';
$route['admin/user/delete/:num'] = 'UserController/delete';

$route['admin/sport-type'] = 'SportController/sportType';
$route['admin/sport-type/action'] = 'SportController/sportType_actions';
$route['admin/sport-type/action/:num'] = 'SportController/sportType_actions';
$route['admin/sport-type/delete/:num'] = 'SportController/sportType_delete';

$route['admin/league'] = 'LeagueController/select_sportType';
$route['admin/league/:num'] = 'LeagueController/indexAdmin';
$route['admin/league/action/:num'] = 'LeagueController/actions';
$route['admin/league/action/:num/:num'] = 'LeagueController/actions';
$route['admin/league/delete/:num'] = 'LeagueController/delete';

$route['admin/sport-club'] = 'SportController/select_sportType';
$route['admin/sport-club/sport/:num'] = 'SportController/select_league';
$route['admin/sport-club/league/:num'] = 'SportController/sportClub';
$route['admin/sport-club/action/:num'] = 'SportController/sportClub_actions';
$route['admin/sport-club/action/:num/:num'] = 'SportController/sportClub_actions';
$route['admin/sport-club/delete/:num'] = 'SportController/sportClub_delete';

$route['admin/player-type'] = 'AthleteController/playerType_selectSport';
$route['admin/player-type/:num'] = 'AthleteController/playerType';
$route['admin/player-type/action/:num'] = 'AthleteController/playerType_actions';
$route['admin/player-type/action/:num/:num'] = 'AthleteController/playerType_actions';
$route['admin/player-type/delete/:num'] = 'AthleteController/playerType_delete';

$route['admin/foul-type'] = 'AthleteController/foulType_selectSport';
$route['admin/foul-type/:num'] = 'AthleteController/foulType';
$route['admin/foul-type/action/:num'] = 'AthleteController/foulType_actions';
$route['admin/foul-type/action/:num/:num'] = 'AthleteController/foulType_actions';
$route['admin/foul-type/delete/:num'] = 'AthleteController/foulType_delete';

$route['admin/match'] = 'MatchController/select_sportType';
$route['admin/match/sport/:num'] = 'MatchController/select_league';
$route['admin/match/league/:num'] = 'MatchController/indexAdmin';
$route['admin/match/action/:num'] = 'MatchController/actions';
$route['admin/match/action/:num/:num'] = 'MatchController/actions';
$route['admin/match/delete/:num'] = 'MatchController/delete';

$route['admin/athlete'] = 'AthleteController/athlete_selectSport';
$route['admin/athlete/sport/:num'] = 'AthleteController/athlete_selectLeague';
$route['admin/athlete/league/:num'] = 'AthleteController/athlete_selectClub';
$route['admin/athlete/club/:num'] = 'AthleteController/athlete';
$route['admin/athlete/action/:num'] = 'AthleteController/actions';
$route['admin/athlete/action/:num/:num'] = 'AthleteController/actions';
$route['admin/athlete/delete/:num'] = 'AthleteController/delete';

$route['admin/foul'] = 'AthleteController/foul_selectSport';
$route['admin/foul/sport/:num'] = 'AthleteController/foul_selectLeague';
$route['admin/foul/league/:num'] = 'AthleteController/foul';
$route['admin/foul/action/:num'] = 'AthleteController/foul_actions';
$route['admin/foul/action/:num/:num'] = 'AthleteController/foul_actions';
$route['admin/foul/delete/:num'] = 'AthleteController/foul_delete';

$route['admin/news'] = 'NewsController/select_sportType';
$route['admin/news/sport/:num'] = 'NewsController/select_league';
$route['admin/news/league/:num'] = 'NewsController/news';
$route['admin/news/action/:num'] = 'NewsController/news_actions';
$route['admin/news/action/:num/:num'] = 'NewsController/news_actions';
$route['admin/news/delete/:num'] = 'NewsController/news_delete';


