<?php

namespace Core;

use PDO;
use PDOException;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(realpath("."));
$dotenv->load();

class Orm
{
    // must be static or multiple pdo classes.
    static protected $db;
    static protected $table;
    static protected $class;

    public static function init()
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
            die($error->getMessage());
        }
    }

    public function __construct($table, $class = "")
    {
        self::$table = $table;
        $ucClass = ucfirst($class);
        self::$class = ucfirst($class);
        if (!empty($class)):
            require_once(realpath(".") . "/app/models/$ucClass.php");
        endif;
    }

    public function __destruct()
    {
        self::$db = null;
    }
    public static function find($params = [])
    {
        $table = self::$table;
        if (empty($params) && array_key_exists("orderBy", $params)) {
            $sql = "SELECT * FROM  $table;";
        } else  {
            $orderBy = $params['orderBy'];
            $sql = "SELECT * FROM  $table ORDER BY $orderBy ASC;";
        }
        try {
            $stmt = self::$db->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::$class);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }



    public static function create($data)
    {
        $keys = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $table = self::$table;
        try {
            $query = self::$db->prepare("INSERT INTO $table ($keys) VALUES ($values)");
            $query->execute($data);
            return $query;

        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public static function destroy($ids)
    {
        $table = self::$table;

        try {
            self::$db->beginTransaction();
            foreach ($ids as $id) {
                $sql = "DELETE FROM $table WHERE sku= :id";
                $stmt = self::$db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            }
            self::$db->commit();
        } catch (PDOException $error) {
            self::$db->rollback();
            die($error->getMessage());
        }
    }

    public static function destroyMany()
    {
        $table = self::$table;

        try {
            $sql = "DELETE FROM $table";
            self::$db->exec($sql);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public static function exec($sql)
    {
        try {
            return self::$db->exec($sql);
        } catch (PDOException $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function __toString()
    {
        $output = self::class . PHP_EOL;
        return $output;
    }
}