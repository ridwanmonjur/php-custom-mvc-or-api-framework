<?php
namespace App;

require_once  realpath(".") . '/app/' . 'controllers/ProductController.php';

use Core\Router;

$router = new Router();

try{
    $router->get('/', 'ProductController@index');
    $router->post('/', 'ProductController@create');
    $router->get('/addProduct', 'ProductController@show');
    $router->get('/reset', 'ProductController@reset');
    $router->redirectTo404();
}
catch (\Exception $e){
    die ('Message: ' .$e->getMessage());
}