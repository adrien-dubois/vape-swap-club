<?php

namespace App\Models;

use App\Utils\Database;
use PDO;
use Symfony\Component\VarDumper\Cloner\Data;

class Product extends CoreModel {

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var float
     */
    private $price;
    /**
     * @var int
     */
    private $rate;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $brand_id;
    /**
     * @var int
     */
    private $type_id;


    /**
     * Method which allows to get a product by its ID
     *
     * @param int $productId
     * @return Product
     */
    public static function find($productId)
    {
        // retrieve a PDO object = connect to the DB
        $pdo = Database::getPDO();

        // we write the SQL query to retrieve the product
        $sql = '
        SELECT *
        FROM product
        WHERE id = ' . $productId;

        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject('App\Models\Product');

        return $result;

    }

    public static function findAll(){

        $pdo = Database::getPDO();
        $sql = '
        SELECT *
        FROM `product`';
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $result;
    }

    
    /**
     * Method to create a new product in DB
     *
     * @return bool
     */
    public function insert(){

        $pdo = Database::getPDO();

        $sql = '
        INSERT INTO `product` (name, description, picture, price, rate, status, brand_id, type_id)
        VALUES (:name :description, :picture, :price, :rate, :status, :brand_id, :type_id)
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':picture' => $this->picture,
            ':price' => $this->price,
            ':rate' => $this->rate,
            ':status' => $this->status,
            ':brand_id' => $this->brand_id,
            ':type_id' => $this->type_id,
        ]);

        if ($pdoStatement->rowCount() > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    /**
     * Method which update an existing product
     *
     * @return void
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
                UPDATE `product`
                SET
                UPDATE `product`
                SET
                name = :name,
                description = :description ,
                picture = :picture,
                price = :price,
                rate = :rate,
                status = :status,
                brand_id = :brand_id,
                type_id = :type_id,
                updated_at = NOW()
                WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':description', $this->description, PDO::PARAM_STR);
        $pdoStatement->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $pdoStatement->bindValue(':price', $this->price, PDO::PARAM_INT);
        $pdoStatement->bindValue(':rate', $this->rate, PDO::PARAM_INT);
        $pdoStatement->bindValue(':status', $this->status, PDO::PARAM_INT);
        $pdoStatement->bindValue(':brand_id', $this->brand_id, PDO::PARAM_STR);
        $pdoStatement->bindValue(':type_id', $this->type_id, PDO::PARAM_STR);

        $updatedRows = $pdoStatement->execute();

        return ($updatedRows > 0);
    }

    public static function delete($productId)
    {
        $pdo = Database::getPDO();
        $sql = '
        DELETE
        FROM `product`
        WHERE id' . $productId;
        $pdo->exec($sql);
    }



    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     *
     * @return  self
     */
    public function setPicture(string $picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     *
     * @return  self
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of rate
     *
     * @return  int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @param  int  $rate
     *
     * @return  self
     */
    public function setRate(int $rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     *
     * @return  self
     */
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of brand_id
     *
     * @return  int
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @param  int  $brand_id
     *
     * @return  self
     */
    public function setBrandId(int $brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Get the value of type_id
     *
     * @return  int
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     * @param  int  $type_id
     *
     * @return  self
     */
    public function setTypeId(int $type_id)
    {
        $this->type_id = $type_id;

        return $this;
    }
}