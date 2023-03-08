<?php

require_once realpath(".") . '/app/models/' . 'Product.php';

class Book extends Product
{
    private string $type;
    private string $weight;

    public function __construct(
    )
    {
        $this->type = "book";
        parent::__construct($this->type);
    }

    public function setAttributeFromChild($attributeLst)
    {
        return "{$this->weight} KG";
    }

}