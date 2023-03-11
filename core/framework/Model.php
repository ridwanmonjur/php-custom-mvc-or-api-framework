<?php

namespace Core;

use Core\Orm;

class Model extends Orm
{
   
    private $tableName;
    private $className;

    public function __construct($table, $class)
    {
        $this->tableName = $table;
        $this->className = $class;
        parent::__construct($table, $class);

    }

}