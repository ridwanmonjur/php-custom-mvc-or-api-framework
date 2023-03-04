<?php

require_once  realpath(".") . '/core/' . 'framework/Router.php';
require_once  realpath(".") . '/app/' . 'controllers/ProductController.php';

use Core\Framework\Router;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$router = new Router();

try{
    // $productController = new ProductController();
    // $productController::create();
    $router->get('/api/v1', 'ProductController@create');
    $router->get('/api/v1/:index', 'ProductController@index');

  
}
catch (Exception $e){
    echo 'Message: ' .$e->getMessage();
}