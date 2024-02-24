<?php

namespace App\Models;

use Illuminate\QueryBuilder;
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
                $model->setFromDB($result);
                array_push($models, $model);
            }
            return $models;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function create($arrProduct)
    {
        try {
            $model = $this->getProductChild($arrProduct["type"]);
            $model->validateFromPost($arrProduct);
            $arrProduct["attribute"] = $model->getAttributeToDBAndView();
            $values = implode(',', array_map(function ($x) {
                return "'" . $x . "'";
            }, $arrProduct));
            $keys = implode(',', array_keys($arrProduct));
            $sql = "INSERT INTO product ($keys) VALUES ($values);";
            $this->qb->query($sql);
            $this->qb->execute();
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function destroy($ids)
    {
        if (count($ids)===0){
            throw new \Exception("Must select an id to delete!" , 422);
        }
        $sql = "DELETE FROM `product` WHERE sku= :id;";
        try {
            $this->qb->beginTransaction();
            foreach ($ids as $id) {
                $this->qb->query($sql);
                $this->qb->bind(':id', $id);
                $this->qb->execute();
            }
            $this->qb->commit();
        } catch (\Throwable $error) {
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
        ('book1', 'GAT', 50, 'book', '2 KG'),
        ('disc1', 'DAT', 10, 'disc', '120 MB'),
        ('disc2', 'FBI', 10, 'disc', '120 MB'),
        ('disc3', 'CIA', 10, 'disc', '120 MB'),
        ('furniture1', 'Chair', 20, 'furniture', '30x10x10 CM'),
        ('furniture2', 'Table', 20, 'furniture', '30x10x10 CM');";
        try {
            $this->qb->query($sql);
            $this->qb->execute();
        } catch (PDOException $error) {
            throw $error;
        }
    }

    function getProductChild($modelName, ...$modelArgs)
    {
        try {
            $ucModel = "App\Models" . "\\" . ucfirst($modelName);
            if (!class_exists($ucModel)) {
                throw new \Exception("Unknown or undefined type field inputted!");
            }
            $model = new $ucModel(...$modelArgs);
            return $model;
        } catch (\Throwable $error) {
            throw $error;
        }

    }


}