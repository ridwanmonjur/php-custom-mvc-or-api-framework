<?php

require_once realpath(".") . '/app/models/' . 'Product.php';


class Disc extends Product
{
    protected $type;
    private $size;

    public function __construct(
    )
    {
        $this->type = "disc";
        parent::__construct($this->type);
    }

    public function setAttributeFromChild($attributeLst)
    {
        $this->size = $attributeLst["size"];
        $this->setAttribute("{$this->size} MB");
    }

}