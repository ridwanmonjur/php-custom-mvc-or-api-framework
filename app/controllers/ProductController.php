<?php

use Core\Controller;

require_once realpath(".") . '/app/models/' . 'Book.php';

class ProductController extends Controller
{
    static public function index()
    {
        // need to initialize because cannot dependency injection.
        $data = Product::find();
        (new self)->view("demo.php", $data);
        echo 'This is the new index route';
    }
    static public function create()
    {
        $model = (new self)->model($_POST['switcher']);
        $arr = [
            "sku" => $_POST["sku"],
            "name" => $_POST["name"],
            "price" => $_POST["price"],
            "type" => $_POST["switcher"],
            "attribute" => $_POST["attribute"]
        ];
        $model->create($arr);
        (new self)->view("demo.php");
    }
    static public function destroy()
    {
        parse_str(file_get_contents('php://input'),  $delete);
        var_dump($delete);
        Product::destroy($delete["sku"]);
        (new self)->view("demo.php");
    }
    static public function massDestroy()
    {
        (new self)->view("demo.php");
    }
}