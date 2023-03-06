<?php

namespace Core;

use Core\Orm;

abstract class Model extends Orm
{

    private string $tableName;
    private string $className;

    public function __construct($table, $class)
    {
        $this->table = $table;
        $this->className = $class;
        parent::__construct($table, $class);

    }

}