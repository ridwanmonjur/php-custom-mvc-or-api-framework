<?php

require_once 'development.php';
require_once realpath(".") . '/vendor/autoload.php';
require_once  realpath(".") . '/app/models/' . 'Product.php';

use Core\Controller;
use Core\Orm;

Orm::init();
$model = new Orm("product");
print_apple ( $model->findAssoc() );

$productController = new Controller();
$demo = ['hello', 'world'];
$productController->view("demo.php", $demo);

echo "<br>";
Controller::index();

echo "<br>";

$routeList = [
    "/",
    "/api",
    "/api/v1",
    "/api/v1/123456",
    "/api/v1/123456/profile",

];
$routeTemplateList = [
    "/",
    "/api",
    "/api/v1",
    "/api/v1/:id",
    "/api/v1/profile"
];



foreach ($routeList as $index => $route) {
    $compare = compareTwoUrls($route, $routeTemplateList[$index]);
    print_apple($compare);
}

?>