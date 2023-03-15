<?php


namespace App\Models;

use App\Models\Product;

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;


    public function __construct(
    )
    {
        $this->type = "furniture";
    }

    public function setAttribute($arrayOrString)
    {
        if (is_array($arrayOrString)) {
            var_dump($arrayOrString);
            $this->length = "{$arrayOrString['length']} CM";
            $this->width = "{$arrayOrString['width']} CM";
            $this->height = "{$arrayOrString['height']} CM";
        } else {
            $arrValues = explode('x', substr($arrayOrString, 0, -3));
            $this->length = "{$arrValues[0]} CM";
            $this->width = "{$arrValues[1]} CM";
            $this->height = "{$arrValues[2]} CM";
        }
    }

    public function getAttribute()
    {
        return substr($this->length, 0, -3) . "x" . substr($this->width, 0, -3) . "x" . $this->height;
    }


}