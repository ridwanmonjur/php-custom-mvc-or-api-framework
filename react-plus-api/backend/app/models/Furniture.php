<?php


namespace App\Models;

use App\Models\Product;

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    public function setAttributeFromPost($arrayOrString)
    {
        if (isset($arrayOrString['length'] ) && isset($arrayOrString['width'] ) && isset($arrayOrString['height'] )){
            $this->length = $arrayOrString['length'];
            $this->width = $arrayOrString['width'];
            $this->height = $arrayOrString['height'];
        }else{ 
            throw new \Exception("Undefined attribute key sent" , 422);
        }
    }

    public function getAttributeToDBAndView()
    {
        return $this->length . "x" . $this->width . "x" . $this->height. " CM";
    }
}