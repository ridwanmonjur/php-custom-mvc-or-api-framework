<?php


namespace App\Models;

use App\Models\Product;


class Disc extends Product
{
    private $size;

    public function __construct(
    )
    {
        $this->type = "disc";
    }

    public function setAttribute($arrayOrString){
        if (is_array($arrayOrString)) {
            $this->size = "{$arrayOrString['size']} MB";
        }
        else{
            $this->size = $arrayOrString;
        }
    }
    public function getAttribute(){
        return $this->size;
    
    }


}