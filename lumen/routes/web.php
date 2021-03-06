<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post('users/sign-in', 'UserController@login');
$router->post('users/register', 'UserController@register');
$router->post('users/recover-password', 'UserController@recover_password');
$router->get('users/info', [
    'middleware' => 'auth',
    'uses' => 'UserController@info'
]);
$router->get('users/companies', [
    'middleware' => 'auth',
    'uses' => 'CompanyController@get'
]);
$router->post('users/companies', [
    'middleware' => 'auth',
    'uses' => 'CompanyController@add'
]);
