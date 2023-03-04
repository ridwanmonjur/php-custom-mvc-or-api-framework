<?php
function print_apple($apple){
    echo "<pre>"; echo var_dump($apple); echo "</pre>";
}
// require_once 'core/Controller.php';

use Core\Framework\Controller;

// $productController = new Controller();
// $demo = ['hello', 'world'];
// $productController->view("demo.php", $demo);

// echo "<br>";
// Controller::index();

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

$routeTemplateListV2= $routeTemplateList;
foreach ($routeList as $index => $route) {
    $_SAMPLE_ROUTE = "http://google.org";
    $route = $_SAMPLE_ROUTE . $route;
    $routeTemplateListV2[$index] = $_SAMPLE_ROUTE . $routeTemplateListV2[$index];

    $routeParsed = parse_url($route);
    $routeTemplateParsed = parse_url($routeTemplateListV2[$index]);

    $routeUrlParams = explode("/", $routeParsed["path"]);
    $routeTemplateParams = explode("/", $routeTemplateParsed["path"]);

    $isSameNumberOfParams = sizeof($routeUrlParams) === sizeof($routeTemplateParams);
    print_apple($isSameNumberOfParams);

    // foreach ($routeParsed["path"] as $index => $path) {

    // }
    // $routeUrlParams = explode("/", $routeParsed["path"]);
    // $routeTemplateParamas = explode("/", $routeTemplateListV2[$index]["path"]);

    echo "<br>" . $index . "<br>". $route . " <br> " . $routeTemplateListV2[$index] ;
    print_apple($routeParsed);
    print_apple($routeTemplateParsed);

    print_apple($routeUrlParams);
    print_apple($routeTemplateParams);

}


?>