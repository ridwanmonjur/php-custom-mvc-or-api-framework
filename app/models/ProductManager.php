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
        print_pre_formatted($arrProduct, $pre) ;

        $arrProduct["attribute"] =  $model->getAttribute();
        print_pre_formatted($arrProduct, $pre, $arrProduct["attribute"]) ;
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


    function getProductChild($modelName, ...$modelArgs)
    {
        $ucModel = "App\Models" . "\\" . ucfirst($modelName);

        return new $ucModel(...$modelArgs);
    }


}