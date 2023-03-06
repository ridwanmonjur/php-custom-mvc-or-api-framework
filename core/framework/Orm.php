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


    //Calling Database file each time when Product model is called 
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
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function __construct(string $table, "")
    {
        // $this->init();
        self::$table = $table;
    }

    public function __destruct()
    {
        $this->db = null;
    }
    public static function find()
    {
        $sql = "SELECT * FROM  " . self::$table;

        try {
            $query = self::$db->query($sql)->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE);
            return $query;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public static function create(array $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $table = self::$table;
        try {
            $query = self::$db->prepare("INSERT INTO $table ($keys) VALUES ($values)");
            $query->execute($data);
            $query = $query->fetchColumn();
            echo json_encode(compact('query'));
            return $query;

        } catch (PDOException $e) {
            $error = $e->getMessage();
            return $error;

        }
    }

    public static function destroy(array $ids)
    {
        $table = self::$table;

        try {
            self::$db->beginTransaction();
            foreach ($ids as $id) {
                $sql = "DELETE FROM $table WHERE id= :id";
                $stmt = self::$db->prepare($sql);
                // $stmt->bind(':id', $id);
                // $stmt->exec();
            }
            self::$db->commit();
        } catch (PDOException $e) {
            self::$db->rollback();
        }
    }

    public function __toString()
    {
        $output = self::class . PHP_EOL;
        return $output;
    }
}