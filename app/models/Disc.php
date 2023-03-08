<?php

require_once realpath(".") . '/app/models/' . 'Product.php';


class Disc extends Product
{
    private string $type;
    private int $disc;

    public function __construct(
    )
    {
        $this->type = "disc";
        parent::__construct($this->type);
    }

    public function setAttributeFromChild($attributeLst)
    {
        return "{$this->disc} MB";
    }

}