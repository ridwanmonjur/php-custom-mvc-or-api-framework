<?php

namespace App\Controllers;

use Illuminate\Controller;
use Illuminate\QueryBuilder;
use App\Models\ProductManager;

class ProductController extends Controller
{
    private $productManager;
    private $qb;
    public function __construct()
    {
        $this->qb = new QueryBuilder();
        $this->productManager = new ProductManager($this->qb);
    }

    public function index()
    {
        try {
            $data = $this->productManager->find();
            $message = "Found the products";
            $statusCode = 200;
            $this->json(compact('data', 'message', 'statusCode'));
        } catch (\Throwable $error) {
            $this->json(["error" => $error->getMessage(), "statusCode" => $error->getCode()]);
        }
    }
    public function create()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        try {
            $data = [
                "sku" => $post["sku"],
                "name" => $post["name"],
                "price" => $post["price"],
                "type" => $post["switcher"],
                "attribute" => $post["attribute"]
            ];
            $statusCode = 201;
            $message = "Created the product";
            $this->productManager->create($data);
            $this->json(compact('data', 'message', 'statusCode'));
        } catch (\Throwable $error) {
            $this->json(["error" => $error->getMessage(), "statusCode" => $error->getCode()]);
        }
    }
    public function destroy()
    {
        try {
            $post = json_decode(file_get_contents('php://input'), true);
            $sku = $post['sku'];
            $this->productManager->destroy($sku);
            $this->json(['statusCode'=> 204]);
        } catch (\Exception $error) {
            $this->json(["error" => $error->getMessage(), "statusCode" => $error->getCode()]);
        }
    }

    public function destroyMany()
    {
        try {
            $this->productManager->destroyMany();
            $this->json(['statusCode'=> 204]);

        } catch (\Exception $error) {
            $this->json(["error" => $error->getMessage(), "statusCode" => $error->getCode()]);
        }
    }
}