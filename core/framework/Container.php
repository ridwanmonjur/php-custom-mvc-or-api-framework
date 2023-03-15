<?php

namespace Illuminate;

use DI\ContainerBuilder;

class Container
{
    private static $container;
    public function __construct()
    {
        
    }

    public function __destruct()
    {
        self::$container = null;
    }
    static public function set($array)
    {
        $containerBuilder = new ContainerBuilder;
        $containerBuilder->addDefinitions($array);
        self::$container = $containerBuilder->build();
    }

    static public function getContainer()
    {
        return self::$container;
    }
}