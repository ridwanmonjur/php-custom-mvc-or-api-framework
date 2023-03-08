<?php

use Core\Controller;

require_once realpath(".") . '/app/models/' . 'Book.php';

class ProductController extends Controller
{
    static public function index()
    {
        echo 'index';
        // need to initialize because cannot dependency injection.
        $data = Product::find();
        var_dump($data);
        (new self)->view("home/index.php", $data);
    }
    static public function show()
    {
        echo 'show';
        $data = Product::find();
        (new self)->view("product/addProduct.php", $data);
    }
    static public function create()
    {
        if ($_POST['switcher'] ?? false):
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
        elseif ($_POST['sku'] ?? false):
        
        else:
        
        endif;
    }
    static public function destroy()
    {
        echo 'destroy';
        parse_str(file_get_contents('php://input'), $delete);
        var_dump($delete);
        var_dump($_SERVER['QUERY_STRING']);
        Product::destroy($delete["sku"]);
        (new self)->view("demo.php");
    }
    static public function massDestroy()
    {
        echo 'massDestroy';
        (new self)->view("demo.php");
    }
}