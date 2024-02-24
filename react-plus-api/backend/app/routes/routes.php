<?php

namespace App\Routes;

use App\Controllers\ProductController;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(realpath("."));
$dotenv->load();

$request = $_SERVER['REQUEST_URI'];
$isXampp = $_ENV["xampp"] == "true";

if ($isXampp) {
    $request = str_replace($_ENV["xamppDirectory"], '', $request);

    if ($request != "/" && $request[-1] == "/") {
        $request = rtrim($request, "/");
    }
}

$controller = new ProductController();

$method = $_SERVER['REQUEST_METHOD'];

switch ([$request, $method]) {
    case ['/', 'GET']:
        $controller->index();
        break;
    case ['/', 'POST']:
        $controller->create();
        break;
    case ['/deleteAll', 'POST']:
        $controller->destroyMany();
        break;
    case ['/delete', 'POST']:
        $controller->destroy();;
        break;
    default:
        $controller->notFound();
        break;
}