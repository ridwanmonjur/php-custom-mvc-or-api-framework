<?php


namespace App\Models;

use App\Models\Product;


class Disc extends Product
{
    private $size;

    public function setAttributeFromPost($arrayOrString)
    {
        if (isset($arrayOrString['size'])){
            $this->size = $arrayOrString['size'];
        }
        else{ 
            throw new \Exception("Undefined attribute key sent" , 422);
        }
    }
    public function getAttributeToDBAndView(){
        return "{$this->size} MB";
    }


}