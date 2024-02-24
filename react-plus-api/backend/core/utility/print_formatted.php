<?php

if (!function_exists('print_pre_formatted')):
    function print_pre_formatted(...$args)
    {
        echo "<pre>";
        echo var_dump($args);
        echo "</pre>";
    }
endif;