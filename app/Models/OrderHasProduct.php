<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class OrderHasProduct extends CoreModel{
    /**
     * @var int
     */
    private $order_id;
    /**
     * @var int
     */
    private $product_id;


    /**
     * Find all method
     *
     * @return void
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT *
                FROM `order_has_product`
                ';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }

   /**
    * Method wil delete a row from pivot table
    *
    * @param [type] $array
    * @return void
    */
    public function deleteOrder($array)
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM `order_has_product`
                WHERE `order_id` = :order_id
                AND `product_id` = :product_id
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':order_id', $this->order_id, PDO::PARAM_INT);

        foreach ($array as $key => $value){
            $pdoStatement->bindValue(':product_id', $value, PDO::PARAM_INT);
            $pdoStatement->execute();
        }

        return;
    }

    public function findFromOrder($orderId){
        
        $pdo = Database::getPDO();

        $sql = '
        SELECT *
        FROM `order_has_product`
        WHERE `order_id` = ' . $orderId
        ;

        $pdoStatement = $pdo->query($sql);
        $order = $pdoStatement->fetchObject(self::class);

        return $order;
    }

    public function findFromProduct($productId){
        
        $pdo = Database::getPDO();

        $sql = '
        SELECT *
        FROM `order_has_product`
        WHERE `product_id` = ' . $productId
        ;

        $pdoStatement = $pdo->query($sql);
        $product = $pdoStatement->fetchObject(self::class);

        return $product;
    }

    public function addOrderProduct(){

        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `order_has_product` (order_id, product_id)
            VALUES ( :order_id, :product_id)
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':order_id' => $this->order_id,
            ':product_id' => $this->product_id,
            ]
        );

        return ($pdoStatement->rowCount() > 0);
    }

    public static function find($id)
    {
        
    }

    public function insert()
    {
        
    }

    public function update()
    {

    }

    public static function delete($id)
    {
        
    }

    /**
     * Get the value of order_id
     */ 
    public function getOrder_id()
    {
        return $this->order_id;
    }

    /**
     * Set the value of order_id
     *
     * @return  self
     */ 
    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;

        return $this;
    }

    /**
     * Get the value of product_id
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */ 
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }
}