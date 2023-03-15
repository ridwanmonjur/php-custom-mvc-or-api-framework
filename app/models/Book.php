<?php

namespace App\Models;

use App\Models\Product;

class Book extends Product
{
    private $weight;

    public function __construct(
    )
    {

    }

    public function setAttribute($array){
        var_dump($array);
        $this->weight = $array["weight"] ;
    }
    public function getAttribute(){
        return [
            "weight"=> $this->weight,
        ];
    }

}