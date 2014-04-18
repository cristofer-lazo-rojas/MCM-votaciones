<?php

class HomeController extends BaseController {

    protected $layout = 'layouts.master';

    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function __construct() {
        //$this->beforeFilter('auth', array('except' => 'getLogin'));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function showWelcome() {
        $nav = View::make('login');
        $content = View::make('usuario.formRegistro');
        $this->layout->content = View::make('main', compact('nav', 'content'));
    }

}