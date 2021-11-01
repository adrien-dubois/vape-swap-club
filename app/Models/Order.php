<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Order extends CoreModel{
    /**
     * @var int
     */
    private $app_user_id;
     /**
     * @var int
     */
    private $adress_id;
     /**
     * @var int
     */
    private $price;

    public static function find($orderId)
    {
        $pdo = Database::getPDO();
        $sql = '
        SELECT *
        FROM `order`
        WHERE id = ' . $orderId;

        $pdoStatement = $pdo->query($sql);
        $order = $pdoStatement->fetchObject('App\Models\Order');

        return $order;
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM `order`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Order');

        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `order` (app_user_id, adress_id, price)
            VALUES ('{$this->app_user_id}', '{$this->adress_id}', '{$this->price}')
        ";

        $insertedRow = $pdo->exec($sql);

        if($insertedRow > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `order`
            SET
                app_user_id = '{$this->app_user_id}',
                adress_id = '{$this->adress_id}',
                price = '{$this->price}',
                updated_at = NOW()
            WHERE id = {$this->id}
        ";

        $updatedRows = $pdo->exec($sql);

        return ($updatedRows > 0);
    }

    public static function delete($orderId)
    {
        $pdo = Database::getPDO();

        $sql = 'DELETE FROM `order` WHERE id = ' . $orderId;

        $pdo->exec($sql);
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of adress_id
     */ 
    public function getAdress_id()
    {
        return $this->adress_id;
    }

    /**
     * Set the value of adress_id
     *
     * @return  self
     */ 
    public function setAdress_id($adress_id)
    {
        $this->adress_id = $adress_id;

        return $this;
    }

    /**
     * Get the value of app_user_id
     */ 
    public function getApp_user_id()
    {
        return $this->app_user_id;
    }

    /**
     * Set the value of app_user_id
     *
     * @return  self
     */ 
    public function setApp_user_id($app_user_id)
    {
        $this->app_user_id = $app_user_id;

        return $this;
    }
}