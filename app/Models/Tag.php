<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Tag extends CoreModel {

    /**
     * @var string
     */
    private $name;

    /**
     * Find a tag by its ID
     *
     * @param int $tagId
     * @return void
     */
    public static function find($tagId)
    {
        $pdo = Database::getPDO();

        $sql = '
            SELECT *
            FROM tag
            WHERE id = ' . $tagId;

        $pdoStatement = $pdo->query($sql);

        $tag = $pdoStatement->fetchObject(self::class);

        return $tag;
    }

    /**
     * Delete a tag by itd ID
     *
     * @param int $tagId
     * @return void
     */
    public static function delete($tagId)
    {
        $pdo = Database::getPDO();

        $sql = 'DELETE FROM `product` WHERE id = ' . $tagId;

        $pdo->exec($sql);
    }

    /**
     * Find all tags from DB
     * 
     * @return Tag[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `tag`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }


    /**
     * Make list of tag for products
     *
     * @param int $productId
     * @return void
     */
    public static function findListForProduct($productId) 
    {
        $pdo = Database::getPDO();
        $sql = "
            SELECT * FROM `tag`
            WHERE id IN (
                SELECT tag_id from `product_has_tag`
                where product_id = {$productId}
            );";
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;

    }

    /**
     * Create a new tag
     *
     * @return bool
     */
    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = "
            INSERT INTO `tag` (name)
            VALUES (:name)
        ";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':name' => $this->name]);

        if ($pdoStatement->rowCount() > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        
        return false;
    }

    /**
     * Update a tag
     * 
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $sql = "
            UPDATE `tag`
            SET
                name = :name,
                updated_at = NOW()
            WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':name' => $this->name,
            ':id' => $this->id,
        ]);

        return ($pdoStatement->rowCount() > 0);
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}