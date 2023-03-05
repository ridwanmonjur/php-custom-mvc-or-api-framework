<?php

// require_once  realpath(".") . '/core/' . 'framework/Router.php';
// require_once  realpath(".") . '/app/' . 'controllers/ProductController.php';

use Core\Router;
use Core\Controller;




$productController = new Controller();
$demo = ['hello', 'world'];
$productController->view("demo.php", $demo);

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