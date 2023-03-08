<?php
namespace App;

require_once  realpath(".") . '/app/' . 'controllers/ProductController.php';

use Core\Router;

$router = new Router();

try{
    $router->get('/', 'ProductController@index');
    $router->get('/addProduct', 'ProductController@create');
    $router->post('/', 'ProductController@create');
    $router->delete('/', 'ProductController@destroy');
    $router->delete('/mass', 'ProductController@massDestroy');
}
catch (\Exception $e){
    echo 'Message: ' .$e->getMessage();
}