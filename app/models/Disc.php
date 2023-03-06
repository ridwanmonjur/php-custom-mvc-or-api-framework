<?php

require_once realpath(".") . '/app/models/' . 'Product.php';


class Disc extends Product
{
    private string $type = "disc";

    public function __construct(
        string $name,
        float $price,
        string $sku,
        private int $disc
    )
    {
        parent::__construct($name, $price, $sku, $this->getAttribute(), $this->type);
    }

    public function getAttribute()
    {
        return "{$this->disc} MB";
    }

}