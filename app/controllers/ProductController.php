<?php

use Core\Controller;
use Core\Model;


class ProductController extends Controller
{
    static public function index(){
        $data = 
        (new self)->view("demo.php");
        echo 'This is the new index route'; 
    }
    static public function create(){
        (new self)->view("demo.php");
        echo 'This is the new create route'; 
    }
    static public function destroy(){
        (new self)->view("demo.php");
        echo 'This is the new delete route'; 
    }
    
}
