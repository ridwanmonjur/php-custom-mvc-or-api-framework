<?php

namespace Core;

use  Dotenv\Dotenv;
use PDO;
use PDOException;

$dotenv =Dotenv::createImmutable(realpath("."));
$dotenv->load();

$host = $_ENV['HOST'];
$db = $_ENV['DB'];
$user = $_ENV['USER'];
$password = $_ENV['PASSWORD'];

class Connection
{
	public static function init()
	{
		global $host, $db, $user, $password;
		$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

		try {
			$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
			$pdo = new PDO($dsn, $user, $password, $options);
			return $pdo; 
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}

