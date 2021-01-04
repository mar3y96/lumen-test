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
    // return redirect()->route('profile');

});

$router->group(['prefix' => 'user'], function () use ($router) {
    $router->post('register',['as'=>'register','uses'=>'AuthController@register']);
    $router->post('login',['as'=>'login','uses'=>'AuthController@login']);
});

$router->get('test',function(){
	 return 'test';
});


$router->get('profile',['as'=>'profile',function(){
return 'profile';
}
]);
$url = route('profile');




