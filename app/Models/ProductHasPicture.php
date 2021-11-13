<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class ProductHasPicture extends CoreModel{

    /**
     * @var int
     */
    private $product_id;
    /**
     * @var int
     */
    private $picture_id;

    /**
     * Find all method
     *
     * @return void
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT *
                FROM `product_has_picture`
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
    public function deleteProduct($array)
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM `product_has_picture`
                WHERE `product_id` = :product_id
                AND `picture_id` = :picture_id
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':product_id', $this->product_id, PDO::PARAM_INT);

        foreach ($array as $key => $value){
            $pdoStatement->bindValue(':picture_id', $value, PDO::PARAM_INT);
            $pdoStatement->execute();
        }

        return;
    }

    /**
     * Find from picture id
     *
     * @param int $pictureId
     * @return void
     */
    public function findFromPicture($pictureId){
        
        $pdo = Database::getPDO();

        $sql = '
        SELECT *
        FROM `product_has_picture`
        WHERE `picture_id` = ' . $pictureId
        ;

        $pdoStatement = $pdo->query($sql);
        $picture = $pdoStatement->fetchObject(self::class);

        return $picture;
    }

    /**
     * Find from product id
     *
     * @param int $productId
     * @return void
     */
    public static function findFromProduct($productId){
        
        $pdo = Database::getPDO();

        $sql = '
        SELECT *
        FROM `product_has_picture`
        WHERE `product_id` = ' . $productId
        ;

        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }

    public function addProductPicture(){

        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `product_has_picture` (product_id, picture_id)
            VALUES ( :product_id, :picture_id)
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':product_id' => $this->product_id,
            ':picture_id' => $this->picture_id,
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
     * Get the value of product_id
     *
     * @return  int
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @param  int  $product_id
     *
     * @return  self
     */ 
    public function setProduct_id(int $product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of picture_id
     *
     * @return  int
     */ 
    public function getPicture_id()
    {
        return $this->picture_id;
    }

    /**
     * Set the value of picture_id
     *
     * @param  int  $picture_id
     *
     * @return  self
     */ 
    public function setPicture_id(int $picture_id)
    {
        $this->picture_id = $picture_id;

        return $this;
    }
}