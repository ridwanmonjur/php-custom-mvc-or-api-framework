<?php

use Core\Model;

abstract class Product extends Model
{
    private string $name;
        private float $price;
        private string $sku;
        private string $attribute;
        private string $type;
    
   
    public function __construct(
     
    ) {
        $class = get_called_class();
        print_apple($class);
        
        parent::__construct("product", get_called_class());
    }


    public function getAllProducts()
    {
        return $this->db->find();
    }
    
    // public function insertProduct()
    // {
    //     $query = "INSERT INTO product 
    //                 VALUES (:sku, :product_name, :price, :type_id)";

    //     $this->db->query($query);
    //     $this->db->bind(':sku', $this->getSKU());
    //     $this->db->bind(':product_name', $this->getName());
    //     $this->db->bind(':price', $this->getPrice());
    //     $this->db->bind(':type_id', $this->getType());
    //     $this->db->execute();

    //     return $this->db->countRows();
    // }

    // public function insertProductValue()
    // {
    //     $query = "INSERT INTO product_value 
    //                 VALUES (:sku, :attribute_type_id, :value)";

    //     $this->db->query($query);
    //     $this->db->bind(':sku', $this->getSKU());
    //     $this->db->bind(':attribute_type_id', $this->getType());
    //     $this->db->bind(':value', $this->getAttribute());
    //     $this->db->execute();

    //     return $this->db->countRows();
    // }

    // public function deleteProducts($sku)
    // {
    //     $implodedSku = "('" . implode("', '", $sku) . "')";
    //     $query = "DELETE FROM product WHERE sku IN $implodedSku";

    //     $this->db->query($query);
    //     $this->db->execute();

    //     return $this->db->countRows();
    // }

    // abstract function getAttribute();

    public function getSKU()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

}

