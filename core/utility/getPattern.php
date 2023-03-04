<?php

namespace Core\Utility;

function getUrl()
{
    $CurPageURL = getProtocol() . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $CurPageURL;
}

function getProtocol()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    return $protocol;
}

function getPattern($routeName)
{
    if ($routeName[-1] == '/'):
        $routePattern = $routeName == '/' ? $routeName : substr_replace($routeName, "", -1);
    else:
        $routePattern = substr($routeName, 0);
    endif;
    $routePattern = str_replace("/", "\/", $routePattern);
    if ($routePattern[0] != '/') :
        $routePattern = '/' . $routePattern;
    endif;

    $routePattern .= '\/$/';
    $routePattern = preg_replace("/\{[^}]*\}/", "(?P<id>\d+)", $routePattern);
    return $routePattern;
}