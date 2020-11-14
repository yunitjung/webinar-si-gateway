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

$router->group(['prefix' => 'api'], function () use ($router){
    $router->group(['prefix' => 'v1', 'namespace' => 'V1'], function () use ($router){
        $router->group(['prefix' => 'user', 'namespace' => 'User'], function () use ($router){
            $router->group(['prefix' => 'product'], function () use ($router){
                $router->get('/list', 'ProductController@list');
                $router->post('/find', 'ProductController@find');
            });

            $router->group(['prefix' => 'category'], function () use ($router){
                $router->get('/list', 'CategoryController@list');
                $router->post('/find', 'CategoryController@find');
            });
        });

        $router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function () use ($router){
            $router->group(['prefix' => 'auth'], function () use ($router){
                $router->post('/create-token', 'AuthController@createToken');
                $router->post('/login', 'AuthController@login');
            });

            $router->group(['middleware' => 'auth:admin_api'], function () use ($router){
                $router->group(['prefix' => 'product'], function () use ($router){
                    $router->get('/list', 'ProductController@list');
                    $router->post('/find', 'ProductController@find');
                    $router->post('/store', 'ProductController@store');
                    $router->put('/update', 'ProductController@update');
                    $router->delete('/remove', 'ProductController@delete');
                });

                $router->group(['prefix' => 'category'], function () use ($router){
                    $router->get('/list', 'CategoryController@list');
                    $router->post('/find', 'CategoryController@find');
                    $router->post('/store', 'CategoryController@store');
                    $router->put('/update', 'CategoryController@update');
                    $router->delete('/remove', 'CategoryController@delete');
                });
            });
            
        });
    });
});




