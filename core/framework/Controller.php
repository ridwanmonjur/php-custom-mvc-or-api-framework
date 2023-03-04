<?php

namespace Core\Framework;

class Controller
{
    public function view($view, $data = "")
    {
        require("app/views/$view");
    }
    public function model($model)
    {
        require("app/models/$model.php");
        return new $model;
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
