<?php


namespace App\Models;

use Rakit\Validation\Validator;

abstract class Product implements \JsonSerializable
{
    protected $name;
    protected $price;
    protected $sku;
    protected $attribute;
    protected $type;

    public function __get(string $key)
    {
        return $this->attributes[$key];
    }
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function __construct()
    {
    }
    abstract public function setAttributeFromPost($array);
    abstract public function getAttributeToDBAndView();

    public function validateFromPost($array)
    {
        try {
            $validator = new Validator;
            $validation = $validator->validate($array, [
                'sku' => 'required|alpha_num',
                'name' => 'required|regex:/^[a-zA-Z0-9 .@]+$/',
                'price' => 'required|numeric|min:0|max:99999',
                'type' => [
                    'required',
                    function ($value) {
                        return in_array($value, ["Furniture", "Book", "Disc"]) ?? ":value is not valid.";
                    }
                ],
                'attribute' => 'required|array',
                'attribute.*' => 'numeric|min:0',
            ]);
            if ($validation->fails()) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $errors = $validation->errors()->all();
                $_SESSION["formErrors"] = $errors;
                throw new \Exception("Validation failed: " . $validation->errors()->all()[0], 422);
            }
            $this->name = $array["name"];
            $this->price = $array["price"];
            $this->sku = $array["sku"];
            $this->setAttributeFromPost($array["attribute"]);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    public function setFromDB($array)
    {
        $this->name = $array["name"];
        $this->price = $array["price"];
        $this->sku = $array["sku"];
        $this->type = $array["type"];
        $this->attribute = $array["attribute"];
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}