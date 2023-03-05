<?php

// require_once  realpath(".") . '/core/' . 'framework/Router.php';
// require_once  realpath(".") . '/app/' . 'controllers/ProductController.php';

use Core\Router;

$router = new Router();

try{
    $router->get('/api/v1', 'ProductController@create');
    $router->get('/api/v1/:index', 'ProductController@index');

  
}
catch (Exception $e){
    echo 'Message: ' .$e->getMessage();
}