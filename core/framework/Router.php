<?php

namespace Illuminate;

use Illuminate\QueryBuilder;
use Illuminate\Container;
use DI\ContainerBuilder;

class Router
{
    private $found;

    public function __construct()
    {
        $this->found = false;
    }

    public function get($routeName, $controllerName)
    {
        // check1: has route matched already?
        if ($this->found)
            return;
        if ($_SERVER['REQUEST_METHOD'] === 'GET'):
            $this->callController($routeName, $controllerName);
        endif;
    }

    public function post($routeName, $controllerName)
    {
        if ($this->found)
            return;
        if ($_SERVER['REQUEST_METHOD'] === 'POST'):
            $this->callController($routeName, $controllerName);
        endif;
    }

    public function delete($routeName, $controllerName)
    {
        if ($this->found)
            return;
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE'):
            $this->callController($routeName, $controllerName);
        endif;
    }

    public function callController($routeName, $controllerName)
    {

        $request = $_SERVER['REQUEST_URI'];
        // remove xamp file name
        $request = str_replace('/scandiweb-test', '', $request);
        $comparison = compareTwoUrls($request, $routeName);
        $matches = $comparison["matches"];
        if ($matches) {
            $this->found = true;
            header("Access-Control-Allow-Methods: " . $_SERVER['REQUEST_METHOD']);
            // call controller
            $arr = explode('@', $controllerName);
            // print_pre_formatted($arr);
            // print_pre_formatted("App\Controllers\\" . $arr[0] . "::" . $arr[1]);
            $class = "App\Controllers\\" . $arr[0];
            $container = new Container();
            $object = $container->getContainer()->get($class);
            call_user_func(array($object, $arr[1]));
        }

    }

    public function redirectTo404()
    {
        if (!$this->found) {
            echo "<h1> 404 URL Not Found</h1>";
        }
    }
}