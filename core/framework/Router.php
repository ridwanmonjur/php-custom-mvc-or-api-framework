<?php

namespace Core\Framework;

require_once  realpath(".") . '/core/' . 'utility/getPattern.php';

use function Core\Utility\getPattern;

// use parseURL and parseStr

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
        if ($this->found) return;
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            $this->callController($routeName, $controllerName);
        endif;
    }

    public function post($routeName, $controllerName)
    {
        // check1: has route matched already?
        if ($this->found) return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :
            $this->callController($routeName, $controllerName);
        endif;
    }

    public function delete($routeName, $controllerName)
    {
        // check1: has route matched already?
        if ($this->found) return;
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') :
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
        if ($request[-1] != '/')  $request = $request . '/';
        $routePattern = getPattern($routeName);
        $vars = [];
        $matches = preg_match($routePattern, $request, $vars);
        // check2: dosn't match leave immediately
        if (!$matches) :
            $this->found = false;
            return;
        endif;
        // check3: update route has been found
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
