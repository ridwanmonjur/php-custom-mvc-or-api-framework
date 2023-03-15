<?php

namespace Illuminate;

use PDO;
use PDOException;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(realpath("."));
$dotenv->load();
class QueryBuilder
{
    private static $db;
    private $stmt;
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    public function __construct()
    {
        $host = $_ENV['HOST'];
        $db = $_ENV['DB'];
        $user = $_ENV['USER'];
        $password = $_ENV['PASSWORD'];
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            self::$db = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $error) {
            throw $error;
        }
    }

    public function query($query)
    {

        $this->stmt = self::$db->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $value = filter_var(trim($value), FILTER_SANITIZE_NUMBER_INT);
                    $type = PDO::PARAM_INT;
                    break;

                case is_double($value):
                    $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $value = strval($value);
                    $type = PDO::PARAM_STR;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $value = filter_var(trim($value), FILTER_SANITIZE_STRING);
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function getResultSet()
    {
        $this->stmt->execute();
        self::$db = null;
        return $this->stmt->fetchAll();
    }

    public function countRows()
    {
        return $this->stmt->rowCount();
    }
    public function setFetchMode($mode)
    {
        // $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::$class);
        return $this->stmt->setFetchMode($mode);
    }
}