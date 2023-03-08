<?php

require_once 'development.php';
require_once  realpath(".") . '/app/models/' . 'Product.php';
require_once  realpath(".") . '/app/models/' . 'Book.php';

use Core\Controller;
use Core\Orm;

Orm::init();
$model = new Orm("product");

// $book = new Book();
Book::create(
    ["sku" => "BOOK0008", "name" => "Harry Potter and the Cursed Child 2", "price" => 500, "type" => "book", "attribute"=> "20 KG"]

);

print_apple ( Book::findAssoc() );

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