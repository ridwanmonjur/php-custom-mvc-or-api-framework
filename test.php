<?php
require_once 'core/Controller.php';

$productController = new Controller();
$demo = ['hello', 'world'];
$productController->view("demo.php", $demo);

echo "<br>";
Controller::index();

?>