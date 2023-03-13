<?php

use Core\Controller;

require_once realpath(".") . '/app/models/' . 'Book.php';

class ProductController extends Controller
{
    static public function index()
    {
        // need to initialize because cannot dependency injection.
        $data = Product::find(["orderBy" => "sku"]);
        (new self)->view("home/index.php", $data);
    }
    static public function show()
    {
        (new self)->view("product/addProduct.php");
    }
    static public function createOrDestroy()
    {
        if (isset($_POST['switcher'])):
          
            $model = (new self)->model($_POST['switcher']);
            $model->setAttributeFromChild($_POST["attribute"]);
            $arr = [
                "sku" => $_POST["sku"],
                "name" => $_POST["name"],
                "price" => $_POST["price"],
                "type" => $_POST["switcher"],
                "attribute" => $model->getAttribute()
            ];
            $model->create($arr);
            header("Location: " . getBaseUrl());
        elseif (isset($_POST['sku'])):
            $sku = $_POST['sku'];
            Product::destroy($sku);
            header("Refresh:0");
        else:
            try {
                throw new Exception('Post inputs incorrect ');
            } catch (\Exception $error) {
                die($error);
            }
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
        header("Location: " . getBaseUrl());
    }
    static public function serve()
    {
        try {
            if (file_exists($_SERVER['REQUEST_URI'])) {
                require($_SERVER['REQUEST_URI']);
            } else
                throw new Exception('File doesn\'t exist');
        } catch (\Exception $error) {
            die($error);
        }
    }
}