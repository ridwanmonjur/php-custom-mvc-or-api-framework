<?php

use Core\Controller;
use Core\Model;
require_once  realpath(".") . '/app/models/' . 'Book.php';


class ProductController extends Controller
{
    static public function index(){
        $data =  Book::findAssoc();
        (new self)->view("demo.php", $data);
        echo 'This is the new index route'; 
    }
    static public function create(){
       
        $arr = ["sku" => "BOOK0008", "name" => "Harry Potter and the Cursed Child 2", "price" => 500, "type" => "book", "attribute"=> "20 KG"];
        Book::create($arr);
        (new self)->view("demo.php");


        echo 'This is the new create route'; 
    }
    static public function destroy(){
        (new self)->view("demo.php");
        echo 'This is the new delete route'; 
    }
    
}
