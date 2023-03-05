<?php

namespace Core;

use PDO;
use PDOException;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(realpath("."));
$dotenv->load();

class Model
{
    static protected $db;

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
            $pdo = new PDO($dsn, $user, $password, $options);
            return $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->db = null;
    }
    public static function find(string $tableName)
    {
        $sql = "SELECT * FROM $tableName";

        try {
            $query = self::$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $query;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public static function create(string $tablename, array $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $error = '';
        try {
            $query = self::$db->prepare("INSERT INTO $tablename ($keys) VALUES ($values)");
            if ($query):
                $query->execute($data);
                $query = $query->fetchColumn();
                echo json_encode(compact('query'));
                return $query;
            else:
                $error = 'Preparation statement failed';
                return $error;
            endif;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            return $error;

        }
    }

    public static function destroy(string $tablename, array $ids)
    {
        try {
            self::$db->beginTransaction();
            foreach ($ids as $id) {
                $sql = "DELETE FROM product WHERE id= :id";
                $stmt = self::$db->prepare($sql);
                $stmt->bind(':id', $id);
                $stmt->exec();
            }
            self::$db->commit();
        } catch (PDOException $e) {
            self::$db->rollback();
        }
    }
}