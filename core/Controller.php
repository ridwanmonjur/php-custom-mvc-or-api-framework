<?php

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
        self::view("demo.php");
        echo 'This is the the index routre'; 
    }
    static public function create(){
        self::view("demo.php");
        echo 'This is the the create routre'; 
    }
    static public function destroy(){
        echo 'This is the the delete routre'; 
    }
}
