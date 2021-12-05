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
    private $subtitle;
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
     * @var int
     */
    private $category_id;
    /**
     * @var int
     */
    private $app_user_id;


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
        SELECT p.*, u.firstname, u.lastname
        FROM product p
        INNER JOIN app_user u ON p.app_user_id = u.id
        WHERE p.id = ' . $productId;

        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject('App\Models\Product');

        return $result;
    }

    /**
     * Method to find all products that are in DB
     *
     * @return Product
     */
    public static function findAll(){

        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM `product`
            ';
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $result;
    }


    /**
     * Method to find all products that are in DB with options
     *
     * @return Product
     */
    public static function findAllForBackOffice(){

        $pdo = Database::getPDO();
        $sql = '
                SELECT p.*, u.firstname, u.lastname, c.name AS cat_name
                FROM product p
                INNER JOIN app_user u ON p.app_user_id = u.id
                INNER JOIN category c ON p.category_id = c.id
            ';
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $result;
    }

    /**
     * Method to count the number of products that are in DB for the pagination
     *
     * @return Product
     */
    public static function findNbProducts(){
        $pdo = Database::getPDO();
        $sql = '
            SELECT COUNT(*)
            AS nb_products
            FROM `product`
            ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $result = $pdoStatement->fetch();

        $nbProducts = (int) $result['nb_products'];

        return $nbProducts;
    }

    /**
     * Find all products for the product list, calculated for the pagination
     *
     * @param int $first
     * @param int $perPage
     * @return Product
     */
    public function findAllForList($first, $perPage){

        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM `product`
            ORDER BY `created_at` DESC
            LIMIT :first, :perPage
            ';
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':first', $first, PDO::PARAM_INT);
        $pdoStatement->bindValue(':perPage', $perPage, PDO::PARAM_INT);

        $pdoStatement->execute();
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $result;

    }

    public static function findCreatorProduct($app_user_id){

        $pdo = Database::getPDO();

        $sql = '
                SELECT *
                FROM `product`
                WHERE `app_user_id` = ' . $app_user_id
                ;
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $results;
    }


    /**
     * Method to find the 3 products to displays in the news cards on the homepage
     *
     * @return Product
     */
    public static function findCards(){

        $pdo = Database::getPDO();

        $sql = "SELECT p.*, u.firstname, u.lastname
                FROM `product` p
                INNER JOIN `app_user` u ON p.app_user_id = u.id
                ORDER BY p.created_at DESC
                LIMIT 3 
        ";

        $pdoStatement = $pdo->query($sql);
        $newsCards = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $newsCards;
    }

    /**
     * Method to find the 8 products to displays in the homepage's carousel 
     *
     * @return Product
     */
    public function findCarousel(){

        $pdo = Database::getPDO();

        $sql = "SELECT *
                FROM `product`
                ORDER BY `created_at` DESC
                LIMIT 3, 8 
        ";

        $pdoStatement = $pdo->query($sql);
        $carousel = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $carousel;
    }
    
    /**
     * Method to create a new product in DB
     *
     * @return bool
     */
    public function insert(){

        $pdo = Database::getPDO();

        $sql = '
        INSERT INTO `product` (name, description, subtitle, picture, price, rate, brand_id, type_id, category_id, app_user_id)
        VALUES (:name, :description, :subtitle, :picture, :price, :rate,  :brand_id, :type_id, :category_id, :app_user_id)
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':subtitle' =>$this->subtitle,
            ':picture' => $this->picture,
            ':price' => $this->price,
            ':rate' => $this->rate,
            ':brand_id' => $this->brand_id,
            ':type_id' => $this->type_id,
            ':category_id' => $this->category_id,
            ':app_user_id' => $this->app_user_id
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
                name = :name,
                description = :description ,
                subtitle = :subtitle,
                picture = :picture,
                price = :price,
                rate = :rate,
                status = :status,
                brand_id = :brand_id,
                type_id = :type_id,
                category_id = :category_id,
                app_user_id = :app_user_id,
                updated_at = NOW()
                WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':description', $this->description, PDO::PARAM_STR);
        $pdoStatement->bindValue(':subtitle', $this->subtitle, PDO::PARAM_STR);
        $pdoStatement->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $pdoStatement->bindValue(':price', $this->price, PDO::PARAM_INT);
        $pdoStatement->bindValue(':rate', $this->rate, PDO::PARAM_INT);
        $pdoStatement->bindValue(':status', $this->status, PDO::PARAM_INT);
        $pdoStatement->bindValue(':brand_id', $this->brand_id, PDO::PARAM_STR);
        $pdoStatement->bindValue(':type_id', $this->type_id, PDO::PARAM_STR);
        $pdoStatement->bindValue(':category_id', $this->category_id, PDO::PARAM_STR);
        $pdoStatement->bindValue(':app_user_id', $this->app_user_id, PDO::PARAM_STR);

        $updatedRows = $pdoStatement->execute();

        return ($updatedRows > 0);
    }

    public static function delete($productId)
    {
        $pdo = Database::getPDO();
        $sql = '
        DELETE
        FROM `product`
        WHERE id = ' . $productId;
        $pdo->exec($sql);
    }

    public static function findListForOrder($orderId)
    {
        $pdo = Database::getPDO();

        $sql = "
            SELECT *
            FROM `product`
            WHERE id IN (
                SELECT product_id FROM `order_has_product`
                WHERE order_id = {$orderId}
        )";
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
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

    /**
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of subtitle
     *
     * @return  string
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     * @param  string  $subtitle
     *
     * @return  self
     */ 
    public function setSubtitle(string $subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get the value of app_user_id
     *
     * @return  int
     */ 
    public function getApp_user_id()
    {
        return $this->app_user_id;
    }

    /**
     * Set the value of app_user_id
     *
     * @param  int  $app_user_id
     *
     * @return  self
     */ 
    public function setApp_user_id(int $app_user_id)
    {
        $this->app_user_id = $app_user_id;

        return $this;
    }
}