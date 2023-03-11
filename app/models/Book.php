<?php

require_once realpath(".") . '/app/models/' . 'Product.php';

class Book extends Product
{
    protected $type;
    private $weight;

    public function __construct(
    )
    {
        $this->type = "book";
        parent::__construct($this->type);
    }

    public function setAttributeFromChild($attributeLst)
    {
        $this->weight = $attributeLst["weight"];
        $this->setAttribute("{$this->weight} KG");
    }

}