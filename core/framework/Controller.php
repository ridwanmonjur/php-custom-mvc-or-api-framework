<?php

namespace Illuminate;

class Controller
{
    public function view($view, $data = "")
    {
        require("app/views/$view");
    }
    
    public function index(){
        $this->view("demo.php");
        echo 'This is the default index route'; 
    }
    public function create(){
        $this->view("demo.php");
        echo 'This is the default create route'; 
    }
    public function destroy(){
        $this->view("demo.php");
        echo 'This is the default delete route'; 
    }
}
