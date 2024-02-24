<?php

namespace App\Models;

use Illuminate\QueryBuilder;
use App\Models\Product;
use PDO;
use PDOException;

class ProductManager
{
    private $qb;

    public function __construct(QueryBuilder $qb)
    {
        $this->qb = $qb;
    }

    public function find($params = [])
    {
        $sql = "SELECT *           
            FROM `product` 
            ORDER BY sku;";
        try {
            $this->qb->query($sql);
            $this->qb->setFetchMode(PDO::FETCH_ASSOC);
            $results = $this->qb->getResultSet();

            $models = [];
            foreach ($results as $result) {
                $model = $this->getProductChild($result["type"]);
                $model->validate($result);
                array_push($models, $model);
            }
            return $models;
        } catch (PDOException $error) {
            throw $error;
        }
    }

    public function create($arrProduct)
    {
        $model = $this->getProductChild($arrProduct["type"]);
        $model->setAttribute($arrProduct["attribute"]);
        $pre = $arrProduct["attribute"];

        $arrProduct["attribute"] = $model->getAttribute();
        $values = implode(',', array_map(function ($x) {
            return "'" . $x . "'";
        }, $arrProduct));
        $keys = implode(',', array_keys($arrProduct));
        $sql = "INSERT INTO product ($keys) VALUES ($values);";
        try {
            $this->qb->query($sql);
            $this->qb->execute();
        } catch (PDOException $error) {
            throw $error;
        }
    }

    public function destroy($ids)
    {
        $sql = "DELETE FROM `product` WHERE sku= :id;";
        try {
            $this->qb->beginTransaction();
            foreach ($ids as $id) {
                $this->qb->query($sql);
                $this->qb->bind(':id', $id);
                $this->qb->execute();
            }
            $this->qb->commit();
        } catch (PDOException $error) {
            $this->qb->rollback();
            throw $error;
        }
    }
    public function destroyMany()
    {
        $sql = "DELETE FROM `product`";
        try {
            $this->qb->query($sql);
            $this->qb->execute();
        } catch (PDOException $error) {
            throw $error;
        }
    }
    public function createMany()
    {
        $sql = "INSERT INTO `product` (`sku`, `name`, `price`, `type`, `attribute`) VALUES
        ('BOOK000', 'Harry Potter and the Cursed Child', 50, 'book', '2 KG'),
        ('DISC000', 'Movie: Titanic', 10, 'disc', '120 MB'),
        ('DISC001', 'Movie: The Gladiator', 10, 'disc', '120 MB'),
        ('DISC002', 'Movie: The Dark Knight', 10, 'disc', '120 MB'),
        ('FURNITURE000', 'Blue chair', 20, 'furniture', '30x10x10 CM'),
        ('FURNITURE001', 'Read Chair chair', 20, 'furniture', '30x10x10 CM');";
        try {
            $this->qb->query($sql);
            $this->qb->execute();
        } catch (PDOException $error) {
            throw $error;
        }
    }


    function getProductChild($modelName, ...$modelArgs)
    {
        $ucModel = "App\Models" . "\\" . ucfirst($modelName);

        return new $ucModel(...$modelArgs);
    }


}