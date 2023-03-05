<?php

if (!function_exists('print_apple')):
    function print_apple($apple)
    {
        echo "<pre>";
        echo var_dump($apple);
        echo "</pre>";
    }
endif;