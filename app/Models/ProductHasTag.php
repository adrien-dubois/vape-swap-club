<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class ProductHasTag extends CoreModel{


    /**
     * @var int
     */
    private $product_id;

    /**
     * @var int
     */
    private $tag_id;

    public static function delete($id)
    {
        
    }

    public function insert()
    {
        
    }

    public function update()
    {
        
    }

    public static function find($id)
    {
        
    }

    /**
     * Find All method
     *
     * @return void
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = '
                SELECT *
                FROM `product_has_tag`
        ';
        $pdoStatement=$pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }

    /**
     * Find a relation from tag Id
     *
     * @param int $tagId
     * @return void
     */
    public static function findFromTag($tagId){
        $pdo = Database::getPDO();

        $sql = '
            SELECT *
            FROM `product_has_tag`
            WHERE `tag_id` = ' . $tagId;

        $pdoStatement = $pdo->query($sql);

        $tag = $pdoStatement->fetchObject(self::class);

        return $tag;
    }

    /**
     * Find a relation from Product Id
     *
     * @param int $productId
     * @return void
     */
    public static function findTagsFromProduct($productId){
        $pdo = Database::getPDO();

        $sql = '
            SELECT `tag_id`
            FROM `product_has_tag`
            WHERE `product_id` = ' . $productId;

        $pdoStatement = $pdo->query($sql);

        $tag = $pdoStatement->fetchObject(self::class);

        return $tag;
    }

    public function addTagProduct(){
        
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `product_has_tag` (product_id, tag_id)
            VALUES ( :product_id, :tag_id)
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':product_id' => $this->product_id,
            ':tag_id' => $this->tag_id,
            ]
        );

        return ($pdoStatement->rowCount() > 0);
    }

    /**
     * Get the value of tag_id
     */
    public function getTagId()
    {
        return $this->tag_id;
    }

    /**
     * Set the value of tag_id
     *
     * @return  self
     */
    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;

        return $this;
    }

    /**
     * Get the value of product_id
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }
}