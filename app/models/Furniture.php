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
        $this->type= "furniture";
    }

    public function setAttribute($array){
        $this->height= $array['height'];
        $this->width= $array['width'];
        $this->length= $array['length'];
    }
    public function getAttribute(){
        return [
            "height"=> $this->height,
            "width"=> $this->width,
            "length"=> $this->length
        ];
    }


}