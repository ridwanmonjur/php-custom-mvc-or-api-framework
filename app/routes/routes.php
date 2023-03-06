<?php

// require_once  realpath(".") . '/core/' . 'framework/Router.php';
require_once  realpath(".") . '/app/' . 'controllers/ProductController.php';

use Core\Router;


$router = new Router();

try{
    $router->get('/', 'ProductController@index');
    $router->post('/', 'ProductController@create');
    $router->delete('/', 'ProductController@delete');
}
catch (Exception $e){
    echo 'Message: ' .$e->getMessage();
}