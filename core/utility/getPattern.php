<?php

if (!function_exists('getUrl')):
    function getUrl()
    {
        $CurPageURL = getProtocol() . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $CurPageURL;
    }
endif;

function getProtocol()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    return $protocol;
}

if (!function_exists('compareTwoUrls')):
    function compareTwoUrls($route, $routeTemplate)
    {
        // remove trailing slashes
        $route = rtrim($route, "/");
        $routeTemplate = rtrim($routeTemplate, "/");
        // add google.org
        $_SAMPLE_ROUTE = "http://google.org";
        $route = $_SAMPLE_ROUTE . $route;
        $routeTemplate = $_SAMPLE_ROUTE . $routeTemplate;
        // parse routes
        $routeParsed = parse_url($route);
        $routeTemplateParsed = parse_url($routeTemplate);
        // extract route paths
        $routeUrlPathLists = array_key_exists("path", $routeParsed) ? explode("/", $routeParsed["path"]) : [];
        $routeTemplatePathLists = array_key_exists("path", $routeTemplateParsed) ? explode("/", $routeTemplateParsed["path"]) : [];
        // compare path lists
        $isSameNumberOfPathLists = sizeof($routeUrlPathLists) === sizeof($routeTemplatePathLists);
        // 1. extract urlParams
        // 2. if size of pathLists is not same then comparison is
        $urlParams = [];
        if ($isSameNumberOfPathLists):
            foreach ($routeUrlPathLists as $index => $routeUrlPath) {
                if (empty($routeTemplatePathLists[$index])):
                    if (!empty($routeUrlPath[$index]))
                        return array("urlParams" => null, "matches" => false);
                    continue;
                elseif ($routeTemplatePathLists[$index][0] == ":"):
                    $urlParams[$routeTemplatePathLists[$index]] = $routeUrlPath;
                else:
                    if ($routeTemplatePathLists[$index] != $routeUrlPath):
                        return array("urlParams" => null, "matches" => false);
                    endif;
                endif;
            }
            return array("urlParams" => $urlParams, "matches" => true);
        else:
            return array("urlParams" => null, "matches" => false);
        endif;
    }
endif;