<?php

namespace Core;

class Router
{
    private $found;

    public function __construct()
    {
        $this->found = false;
        var_dump($_SERVER['REQUEST_METHOD']);
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

        $request = $_SERVER['REQUEST_URI'];
        // remove xamp file name
        var_dump($request);
        $request = str_replace('/scandiweb-test', '', $request);       
        $comparison = compareTwoUrls($request, $routeName);
        $matches = $comparison["matches"];
        if ($matches) {
            $this->found = true;
            header("Access-Control-Allow-Methods: " . $_SERVER['REQUEST_METHOD']);
            // call controller
            $arr = explode('@', $controllerName);
            call_user_func($arr, $controllerName);
        }
    }
}