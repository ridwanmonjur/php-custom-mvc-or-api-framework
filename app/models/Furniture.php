<?php

require_once realpath(".") . '/app/models/' . 'Product.php';


class Furniture extends Product
{
    public string $type;

    public function __construct(
    )
    {
        $this->type = "furniture";
        parent::__construct($this->type);
    }

    public function setAttributeFromChild($attributeLst)
    {
        return "{$attributeLst['height']}x{$attributeLst['width']}x{$attributeLst['length']}";

    }
}