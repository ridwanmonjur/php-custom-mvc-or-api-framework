<?php

namespace Core;

class Controller
{
    public function view($view, $data = "")
    {
        require("app/views/$view");
    }
    public function model($view, ...$modelArgs)
    {
        $ucView = ucfirst($view);
        require_once("app/models/$ucView.php");
        return new $ucView(...$modelArgs);
    }
    static public function index(){
        (new self)->view("demo.php");
        echo 'This is the default index route'; 
    }
    static public function create(){
        (new self)->view("demo.php");
        echo 'This is the default create route'; 
    }
    static public function destroy(){
        (new self)->view("demo.php");
        echo 'This is the default delete route'; 
    }
}
