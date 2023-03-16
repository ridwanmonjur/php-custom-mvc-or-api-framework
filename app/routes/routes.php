<?php

namespace App\Routes;

use Illuminate\Router;

$router = new Router();

try{
    $router->get('/', 'ProductController@index');
    $router->post('/', 'ProductController@create');
    $router->get('/error', 'ProductController@error');
    $router->post('/deleteProduct', 'ProductController@destroy');
    $router->get('/addProduct', 'ProductController@show');
    $router->get('/reset', 'ProductController@reset');
    $router->get('/app/views/*', 'ProductController@serve');
    $router->redirectTo404();
}
catch (\Exception $e){
    die ('Message: ' .$e->getMessage());
}