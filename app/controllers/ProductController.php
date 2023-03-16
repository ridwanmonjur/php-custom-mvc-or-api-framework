<?php

namespace App\Controllers;

use Illuminate\Controller;
use Rakit\Validation\Validator;

class ProductController extends Controller
{
    private $productManager;

    public function __construct($productManager)
    {
        $this->productManager = $productManager;
    }
    public function index()
    {
        try {
            // need to initialize because cannot dependency injection.
            $data = $this->productManager->find();
            $this->view("home/index.php", $data);
        } catch (\Exception $error) {
            die($error);
        }
    }
    public function show()
    {
        $this->view("product/addProduct.php");
    }
    public function error()
    {
        $this->view("error.php");
    }
    public function create()
    {
        // session_start();
        try {
            if (!isset($_POST['switcher'])):
                throw new \Exception("Product type is not set!");
            endif;
            $validator = new Validator;
            $validation = $validator->validate($_POST, [
                'sku' => 'required',
                'name' => 'required',
                'price' => 'required|numeric|min:0|max:99999',
                'switcher' => [
                    'required',
                    function ($value) {
                        return in_array($value, ["Furniture", "Book", "Disc"]) ?? ":value is not valid.";
                    }
                ],
                'attribute' => ['required']
            ]);
            if ($validation->fails()) {
                // $errors = $validation->errors()->all();
                // $_SESSION["formErrors"] = $errors;
                // header("Location: " . getBaseUrl() . "/addProduct");
                header("Location: " . getBaseUrl() . "/error");

            } else {
                // if (isset($_SESSION["formErrors"])) {
                //     unset($_SESSION["formErrors"]);
                // }
                $arrProduct = [
                    "sku" => $_POST["sku"],
                    "name" => $_POST["name"],
                    "price" => $_POST["price"],
                    "type" => $_POST["switcher"],
                    "attribute" => $_POST["attribute"]
                ];

                $this->productManager->create($arrProduct);
                header("Location: " . getBaseUrl());
            }
        } catch (\Exception $error) {
            // $_SESSION["formErrors"] = [$error->getMessage()];
            // header("Location: " . getBaseUrl() . "/addProduct");
            header("Location: " . getBaseUrl() . "/error");

        }
    }
    public function destroy()
    {
        // session_start();
        try {
            if (isset($_POST['sku'])):
                $sku = $_POST['sku'];
                $this->productManager->destroy($sku);
            else:
                throw new \Exception("Product sku is not selected!");
            endif;
        } catch (\Exception $error) {
            // $_SESSION["errors"] = [$error->getMessage()];
            // header("Location: " . getBaseUrl());
            header("Location: " . getBaseUrl() . "/error");
            return;
        }

        header("Location: " . getBaseUrl());
    }

    public function reset()
    {
        try {
            $this->productManager->destroyMany();
            $this->productManager->createMany();
            header("Location: " . getBaseUrl());
        } catch (\Exception $error) {
            die($error);
        }
    }
    public function serve()
    {
        try {
            if (file_exists($_SERVER['REQUEST_URI'])) {
                require($_SERVER['REQUEST_URI']);
            } else {
                throw new \Exception('File doesn\'t exist');
            }
        } catch (\Exception $error) {
            die($error);
        }
    }
}