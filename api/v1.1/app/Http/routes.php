<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
$app->get('/', function () use ($app) {
    return $app->welcome();
});
 
$app->group(['prefix' => 'login', 'namespace' => 'App\Http\Controllers'], function($app) {
    $app->post('/auth', 'LoginController@auth');
    $app->post('/logout', 'LoginController@logout');
    $app->get('/index', 'LoginController@index');
    
});

$app->group(['prefix' => 'user', 'namespace' => 'App\Http\Controllers'], function($app) {
	$app->post('/register_user', 'UserController@register_user');
	$app->get('/list', 'UserController@get_all_user_list');
	$app->post('/event', 'UserController@add_event');
	$app->post('/invites_list', 'UserController@get_all_invites_list');
});

$app->group(['prefix' => 'dashboard', 'namespace' => 'App\Http\Controllers'], function($app) {
    $app->post('/', 'UserController@get_dashboard_data');
});

