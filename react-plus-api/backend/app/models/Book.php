<?php

namespace App\Models;

use App\Models\Product;

class Book extends Product
{
    
    private $weight;

    public function setAttributeFromPost($arrayOrString)
    {
        // convert from post form to presentation form 
        if (isset($arrayOrString['weight'])){
            $this->weight = $arrayOrString['weight'];
        }else{ 
            throw new \Exception("Undefined attribute key sent" , 422);
        }
    }
    public function getAttributeToDBAndView()
    {
        // presentation form same as db form
        return "{$this->weight} KG";
    }
   
}