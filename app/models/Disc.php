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

    public function setAttribute($array){
        $this->size= $array['size'];
    }
    public function getAttribute(){
        return [
            "size"=> $this->size,
        ];
    }


}