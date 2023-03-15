<?php


namespace App\Models;

abstract class Product
{
    protected $name;
    protected $price;
    protected $sku;
    protected $attribute;
    protected $qb;
    protected $type;

    public function __construct()
    {
    }
    abstract public function setAttribute($array);
    abstract public function getAttribute();

    public function validate(
        $array
    )
    {
        $this->setName($array["name"]);
        $this->setPrice($array["price"]);
        $this->setSku($array["sku"]);
        $this->setAttribute($this->preprocessAttribute($array["attribute"]));
    }

    public function preprocessAttribute(
        $arrayOrString
    )
    {
        print_pre_formatted($arrayOrString);

        if (is_array($arrayOrString)) {
            return $arrayOrString;
        } else {
            print_pre_formatted($arrayOrString);
            $arrValues = explode('x', $arrayOrString);
            if ($this->type == "furniture") {
                return ["length" => $arrValues[0], "width" => $arrValues[1], "height" => $arrValues[2]];
            } else if ($this->type == "disc") {
                return ["size" => $arrValues[0]];

            } else {
                return ["weight" => $arrValues[0]];
            }
        }
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getSku()
    {
        return $this->sku;
    }

}