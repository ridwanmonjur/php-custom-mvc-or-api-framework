<?php

require_once 'development.php';

use Illuminate\Container;
use Illuminate\QueryBuilder;
use function DI\create;
use function DI\get;

use App\Controllers\ProductController;
use App\Models\ProductManager;

$container = new Container();
$container->set([
    ProductController::class => function (ProductManager $pm) {
        return new ProductController($pm);
    },
    ProductManager::class => function (QueryBuilder $qb) {
        return new ProductManager($qb);
    }
]);


require_once 'app/routes/routes.php';