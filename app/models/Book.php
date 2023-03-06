<?php

require_once  realpath(".") . '/app/models/' . 'Product.php';


class Book extends Product
{
    private string $type="book";

    public function __construct(
        string $name,
        float $price,
        string $sku,
        private string $weight
    ) {      
        parent::__construct($name, $price, $sku, $this->getAttribute(), $this->type);
    }

    public function getAttribute()
    {
        $this->weight = "{$this->weight} KG";
    }

   
}
