<?php

require_once 'development.php';

use Core\Orm;

$sql = "INSERT INTO `product` (`sku`, `name`, `price`, `type`, `attribute`) VALUES
('BOOK000', 'Harry Potter and the Cursed Child', 50, 'book', '2 KG'),
('DISC000', 'Movie: Titanic', 10, 'disc', '120 MB'),
('DISC001', 'Movie: The Gladiator', 10, 'disc', '120 MB'),
('DISC002', 'Movie: The Dark Knight', 10, 'disc', '120 MB'),
('FURNITURE000', 'Blue chair', 20, 'furniture', '30x10x10'),
('FURNITURE001', 'Read Chair chair', 20, 'furniture', '30x10x10');";

Orm::init();
$model = new Orm("product");
$model::destroyMany();
$model::exec($sql);
print_pre_formatted($model::findAssoc());
?>