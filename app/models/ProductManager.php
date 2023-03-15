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
        $sql = "SELECT 
            sku, GROUP_CONCAT(value SEPARATOR 'x') AS attribute,
            name, price, unit, type
            FROM 
            (SELECT 
            product.sku, product.name, product.price, product.type,
            product_attribute.value,
            attribute.name AS `attributeName`, 
            attribute.unit
            FROM `product` 
            INNER JOIN `product_attribute` 
            ON product_attribute.product_sku = product.sku 
            INNER JOIN `attribute`
            ON product_attribute.attribute_id = attribute.id 
            ORDER BY product.sku 
            LIMIT 0, 25
            ) 
            table2 
            GROUP BY sku;";
        try {
            $this->qb->query($sql);
            $this->qb->setFetchMode(PDO::FETCH_ASSOC);
            $results = $this->qb->getResultSet();
            // print_pre_formatted($results);

            $models = [];

            foreach ($results as $result) {
                $model = $this->getProductChild($result["type"]);
                $model->validate($result);
                array_push($models, $model);
            }
            print_pre_formatted($models, $results);

            return $models;
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