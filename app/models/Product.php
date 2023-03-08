<?php

use Core\Model;

abstract class Product extends Model
{
    protected string $name;
    protected float $price;
    protected string $sku;
    protected string $attribute;
    protected string $tableName;
    protected string $className;

    public function __construct(
        private string $type
    )
    {
        $this->tableName = "product";
        $this->className = $this->type;
        parent::__construct($this->tableName, $this->type);
    }

    static public function setValues(
    )
    {
        self::$table = "product";
        self::$class = "book";
    }

    abstract public function setAttributeFromChild($attributeLst);

    public function validate(
        string $name,
        float $price,
        string $sku,
        string $attributeLst
    )
    {
        $this->name = $name;
        $this->price = $price;
        $this->sku = $sku;
        $this->attribute = $this->setAttributeFromChild($attributeLst);
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

    public function setAttribute($name)
    {
        $this->name = $name;
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

    public function getAttribute()
    {
        return $this->attribute;
    }

}