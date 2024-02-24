<?php

namespace Illuminate;

class Controller
{
    public function json($array)
    {
        http_response_code($array["statusCode"]);
        unset($array["statusCode"]) ;
        echo json_encode($array);
    }
   
    public function index(){
        echo 'This is the default index route'; 
    }
    public function create(){
        echo 'This is the default create route'; 
    }
    public function destroy(){
        echo 'This is the default delete route'; 
    }
    public function notFound(){
        $this->json(["message"=> "Not found", "statusCode"=> 404]);
    }
}
