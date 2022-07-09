<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => '/'], function ($router) {
  Route::post('cadastro', 'UserController@store');
  Route::post('login', 'Auth\AuthController@login');
  Route::post('logout', 'Auth\AuthController@logout');

  // Rotas com Auth
  Route::group(['middleware' => 'auth:api'], function ($router) {

      //  Parte de Cliente
      $router->get('cliente/prato', 'PratoController@index');
      $router->get('cliente/prato/{filtro}', 'PratoController@get');
      $router->get('cliente/reserva/', 'ReservaController@index');
      $router->post('cliente/reserva/', 'ReservaController@store');
      $router->put('cliente/reserva/{id}', 'ReservaController@update');
      $router->delete('cliente/reserva/{id}', 'ReservaController@destroy');

      // Parte de Admin
      $router->get('admin/prato/', 'PratoController@index');
      $router->get('admin/prato/{filtro}', 'PratoController@get');
      $router->post('admin/prato/', 'PratoController@store');
      $router->put('admin/prato/{id}', 'PratoController@update');
      $router->delete('admin/prato/{id}', 'PratoController@destroy');
      Route::get('me', 'UserController@me');
      Route::get('users', 'UserController@getUsers');
      Route::post('refresh', 'Auth\AuthController@refresh');
  });
});

