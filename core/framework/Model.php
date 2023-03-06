<?php

namespace Core;

use PDO;
use PDOException;
use Core\Orm;

// use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable(realpath("."));
// $dotenv->load();

class Model extends Orm
{
    // must be static or multiple pdo classes.


    //Calling Database file each time when Product model is called 

    public function __construct($table, $class)
    {
        parent::__construct($table, $class);

    }

}