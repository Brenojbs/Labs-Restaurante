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

$router->post('login/', 'UsuarioController@index');

//  Parte de Cliente
$router->get('prato/', 'PratoController@index');
$router->get('reserva/', 'ReservaController@index');
$router->post('reserva/', 'ReservaController@store');
$router->put('reserva/{id}', 'ReservaController@update');
$router->delete('reserva/{id}', 'ReservaController@destroy');

// Parte de Admin
$router->get('prato/', 'PratoController@index');
$router->post('prato/', 'PratoController@store');
$router->put('prato/{id}', 'PratoController@update');
$router->delete('prato/{id}', 'PratoController@destroy');