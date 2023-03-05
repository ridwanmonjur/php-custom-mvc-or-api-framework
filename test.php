<?php

require_once 'development.php';

require_once  realpath(".") . '/core/' . 'framework/Controller.php';
require_once realpath(".") . '/print_apple.php';

require_once realpath(".") . 'vendor/autoload.php';


use Core\Controller;

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

function compareTwoUrls($route, $routeTemplate){
        $_SAMPLE_ROUTE = "http://google.org";
        $route = $_SAMPLE_ROUTE . $route;
        $routeTemplate = $_SAMPLE_ROUTE . $routeTemplate;

        $routeParsed = parse_url($route);
        $routeTemplateParsed = parse_url($routeTemplate);


        $routeUrlPathLists = explode("/", $routeParsed["path"]);
        $routeTemplatePathLists = explode("/", $routeTemplateParsed["path"]);

        $isSameNumberOfPathLists = sizeof($routeUrlPathLists) === sizeof($routeTemplatePathLists);
      
        $urlParams = [];
        if ($isSameNumberOfPathLists):
            foreach ($routeUrlPathLists as $index => $routeUrlPath) {
                if ($routeTemplatePathLists[$index][0]==":"):
                    $urlParams[$routeTemplatePathLists[$index]] =  $routeUrlPath;
                else:
                    if ($routeTemplatePathLists[$index] != $routeUrlPath):
                        return  array("urlParams" => null, "matches" => false);
                    endif;
                endif;
            }
            return array("urlParams" => $urlParams, "matches" => true);
        else: 
            return  array("urlParams" => null, "matches" => false);
        endif;

}

?>