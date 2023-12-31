<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

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

// $router->group(['middleware' => 'auth'], function ($router)
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('notes', 'NoteController@index');
    $router->post('notes', 'NoteController@store');
    $router->get('notes/{id}', 'NoteController@show');
    $router->put('notes/{id}', 'NoteController@update');
    $router->delete('notes/{id}', 'NoteController@destroy');
});
$router->get('usernotes/{id}', 'NoteController@usernotes');
$router->group(['prefix' => 'api'], function ($router) {
    $router->post('/login', 'UserController@login');
});

$router->post('/register', 'UserController@register');

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('notes', 'NoteController@index');
$router->post('notes', 'NoteController@store');
$router->get('notes/{id}', 'NoteController@show');
$router->post('notes/{id}', 'NoteController@update');
$router->delete('notes/{id}', 'NoteController@destroy');

