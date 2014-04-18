<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |registrarUsuario
 */

Route::controller('/ajaxValidator', 'Ajax_ValidatorController');
Route::controller('/ajaxSelect', 'Ajax_SelectController');

Route::get('/', array('before' => 'guest', "as" => "inicio", "uses" => "HomeController@showWelcome"));
Route::post('/registrarUsuario', array('before' => 'guest', "as" => "registrarUsuario", "uses" => "UsuarioController@registrarUsuario"));
Route::post('/login', array('before' => 'guest', "as" => "login", "uses" => "AuthController@doLogin"));
Route::post('/logout', array('before' => 'auth', "as" => "logout", "uses" => "AuthController@doLogout"));

Route::get('/eventos', array('before' => 'auth', "uses" => "EventoController@showEventos"));
Route::post('/eventos', array('before' => 'auth', "uses" => "EventoController@showEventos"));
Route::group(array('prefix' => 'evento', 'before' => 'auth'), function() {
            Route::get('/ver/{id_evento}', array("as" => "verEvento", "uses" => "EventoController@verEvento"));
            Route::post('/votar', array("as" => "votarEvento", "uses" => "EventoController@votarEvento"));
        });
        
        