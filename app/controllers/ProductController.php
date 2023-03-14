<?php

use Core\Controller;
use Rakit\Validation\Validator;

require_once realpath(".") . '/app/models/' . 'Book.php';

class ProductController extends Controller
{
    static public function index()
    {
        try {
            // need to initialize because cannot dependency injection.
            $data = Product::find(["orderBy" => "sku"]);
            (new self)->view("home/index.php", $data);
        } catch (\Exception $error) {
            die($error);
        }
    }
    static public function show()
    {
        (new self)->view("product/addProduct.php");
    }
    static public function create()
    {
        session_start();
        try {
            if (isset($_POST['switcher'])):
                $validator = new Validator;
                $validation = $validator->validate($_POST, [
                    'sku' => 'required|alpha_num',
                    'name' => 'required',
                    'price' => 'required|numeric|min:0|max:99999',
                    'switcher' => [
                        'required',
                        function ($value) {
                            return in_array($value, ["Furniture", "Book", "Disc"]) ?? ":value is not valid.";
                        }
                    ],
                    'attribute' => [
                        'required',
                        function ($value) {
                            $validity1 = false;
                            $validity2 = false;
                            $attributeys = array_keys($_POST["attribute"]);
                            if ($_POST["switcher"] == "Furniture") {
                                $validity1 = $attributeys == ["length", "width", "height"] ?? false;
                                $validity2 = is_numeric($_POST["attribute"]["length"])
                                    && is_numeric($_POST["attribute"]["width"])
                                    && is_numeric($_POST["attribute"]["height"]);
                            } else if ($_POST["switcher"] == "Book") {
                                $validity1 = key_exists("weight", $_POST["attribute"]) ?? false;
                                $validity2 = is_numeric($_POST["attribute"]["weight"]);
                            } else if ($_POST["switcher"] == "Disc") {
                                $validity1 = key_exists("size", $_POST["attribute"]) ?? false;
                                $validity2 = is_numeric($_POST["attribute"]["size"]);
                            }
                            return ($validity1 && $validity2) ? true : "Wrong choice :value inputted";
                        }
                    ]
                ]);
                if ($validation->fails()) {
                    $errors = $validation->errors()->all();
                    $_SESSION["formErrors"] = $errors;
                    header("Location: " . getBaseUrl() . "/addProduct");
                } else {
                    if (isset($_SESSION['formErrors'])) {
                        unset($_SESSION["formErrors"]);
                    }
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
                }
            else:
               throw new Exception("Product type is not set!");
            endif;
        } catch (\Exception $error) {
            $_SESSION["formErrors"] = [$error->getMessage()];
            header("Location: " . getBaseUrl() . "/addProduct");
        }
    }
    static public function destroy()
    {
        session_start();
        try{
        if (isset($_POST['sku'])):
            $sku = $_POST['sku'];
            Product::destroy($sku);
        else:
            throw new Exception("Product sku is not selected!");
        endif;
        }
        catch (\Exception $error) {
            $_SESSION["errors"] = [$error->getMessage()];
            header("Location: " . getBaseUrl() );
        }
      
        header("Location: " . getBaseUrl());
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
        try {
            Product::destroyMany();
            Product::exec($sql);
            header("Location: " . getBaseUrl());
        } catch (\Exception $error) {
            die($error);
        }
    }
    static public function serve()
    {
        try {
            if (file_exists($_SERVER['REQUEST_URI'])) {
                require($_SERVER['REQUEST_URI']);
            } else {
                throw new Exception('File doesn\'t exist');
            }
        } catch (\Exception $error) {
            die($error);
        }
    }
}