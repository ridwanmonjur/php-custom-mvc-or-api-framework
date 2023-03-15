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
        $this->setAttribute($array["attribute"]);
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