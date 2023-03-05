<?php

namespace Core;

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
        if ($_SERVER['REQUEST_METHOD'] == 'GET'):
            $this->callController($routeName, $controllerName);
        endif;
    }

    public function post($routeName, $controllerName)
    {
        // check1: has route matched already?
        if ($this->found)
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST'):
            $this->callController($routeName, $controllerName);
        endif;
    }

    public function delete($routeName, $controllerName)
    {
        // check1: has route matched already?
        if ($this->found)
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE'):
            $this->callController($routeName, $controllerName);
        endif;
    }

    function router($routes)
    {

    }
    public function callController($routeName, $controllerName)
    {

        // check1: match requestURI with routePattern
        $request = $_SERVER['REQUEST_URI'];
        $request = str_replace('/scandiweb-test', '', $request);
        print_apple($request);
        print_apple($routeName);

        $hostname = realpath(".");
        print_apple($hostname);

       
        $comparison = compareTwoUrls($request, $routeName);
        $matches = $comparison["matches"];
        print_apple($matches);
        // check3: update route has been found
        if ($matches) {
            $this->found = true;
            // set route header name
            header("Access-Control-Allow-Methods: " . $_SERVER['REQUEST_METHOD']);
            // call controller
            $arr = explode('@', $controllerName);
            print_r($arr);
            // $arr[0] = 'Src\\Core\\' . $arr[0];
            call_user_func($arr, $controllerName);
        }
    }
}