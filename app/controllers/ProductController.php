<?php

use Core\Controller;

require_once realpath(".") . '/app/models/' . 'Book.php';

class ProductController extends Controller
{
    static public function index()
    {
        // need to initialize because cannot dependency injection.
        $data = Product::find();
        (new self)->view("home/index.php", $data);
    }
    static public function show()
    {
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
            $sku = $_POST['sku'];
            Product::destroy($sku);
            header("Location: " . $_SERVER['REQUEST_URI']);
        else:
            echo "stupid url";
        endif;
    }
    static public function reset()
    {
        $sql = "INSERT INTO `product` (`sku`, `name`, `price`, `type`, `attribute`) VALUES
        ('BOOK000', 'Harry Potter and the Cursed Child', 50, 'book', '2 KG'),
        ('DISC000', 'Movie: Titanic', 10, 'disc', '120 MB'),
        ('DISC001', 'Movie: The Gladiator', 10, 'disc', '120 MB'),
        ('DISC002', 'Movie: The Dark Knight', 10, 'disc', '120 MB'),
        ('FURNITURE000', 'Blue chair', 20, 'furniture', '30x10x10'),
        ('FURNITURE001', 'Read Chair chair', 20, 'furniture', '30x10x10');";
        Product::destroyMany();
        Product::exec($sql);
        var_dump(getBaseUrl());
        // header("Location: " . geturl());
    }
}