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

    public function setAttribute($arrayOrString)
    {
        // convert from post form to presentation form 
        if (is_array($arrayOrString)) {
            $this->weight = "{$arrayOrString['weight']} KG";
        }
        else{
        // convert from db form to presentation form (same)
            $this->weight = $arrayOrString;
        }
    }
    public function getAttribute()
    {
        // presentation form
        // same as db form
        return $this->weight;
    }

}