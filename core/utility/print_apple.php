<?php

if (!function_exists('print_apple')):
    function print_apple(...$args)
    {
        echo "<pre>";
        echo var_dump($args);
        echo "</pre>";
    }
endif;