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

function compareTwoUrls($route, $routeTemplate){
    $_SAMPLE_ROUTE = "http://google.org";
    $route = $_SAMPLE_ROUTE . $route;
    $routeTemplate = $_SAMPLE_ROUTE . $routeTemplate;

    $routeParsed = parse_url($route);
    $routeTemplateParsed = parse_url($routeTemplate);


    $routeUrlPathLists = explode("/", $routeParsed["path"]);
    $routeTemplatePathLists = explode("/", $routeTemplateParsed["path"]);

    $isSameNumberOfPathLists = sizeof($routeUrlPathLists) === sizeof($routeTemplatePathLists);
  
    $urlParams = [];
    if ($isSameNumberOfPathLists):
        foreach ($routeUrlPathLists as $index => $routeUrlPath) {
            echo "<br>" . $index. "<br>" ;
            if (empty($routeTemplatePathLists[$index])):
                if (!empty($routeUrlPath[$index]))  return  array("urlParams" => null, "matches" => false);
                continue;
            elseif ($routeTemplatePathLists[$index][0]==":"):
                echo $routeTemplatePathLists[$index] . " : " . $routeUrlPath;
                $urlParams[$routeTemplatePathLists[$index]] =  $routeUrlPath;
            else:
                if ($routeTemplatePathLists[$index] != $routeUrlPath):
                    echo $routeTemplatePathLists[$index] . " != " . $routeUrlPath;
                    return  array("urlParams" => null, "matches" => false);
                endif;
            endif;
        }
        return array("urlParams" => $urlParams, "matches" => true);
    else: 
        return  array("urlParams" => null, "matches" => false);
    endif;

}
