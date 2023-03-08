<?php

use Core\Orm;
require_once 'development.php';
require_once 'vendor/autoload.php';
require_once 'app/models/Product.php';
Orm::init();
Product::setValues();

require_once 'app/routes/routes.php';


