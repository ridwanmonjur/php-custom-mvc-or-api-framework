<?php

require_once realpath(".") . '/app/models/' . 'Product.php';


class Furniture extends Product
{
    public string $type;
    private float $height;
    private float $width;
    private float $length;


    public function __construct(
    )
    {
        $this->type = "furniture";
        parent::__construct($this->type);
    }

    public function setAttributeFromChild($attributeLst)
    {
        $this->height= $attributeLst['height'];
        $this->width= $attributeLst['width'];
        $this->length= $attributeLst['length'];
        $this->setAttribute("{$this->height}x{$this->width}x{$this->length}");
    }
}