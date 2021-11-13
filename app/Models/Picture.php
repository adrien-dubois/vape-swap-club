<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Picture extends CoreModel
{

    /**
     * @var string
     */
    private $name;

    public static function find($pictureId)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `picture` WHERE `id` = ' . $pictureId;

        $pdoStatement = $pdo->query($sql);
        $picture = $pdoStatement->fetchObject('App\Models\Picture');

        return $picture;
    }

    /**
     * Find all types
     *
     * @return Type[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `picture`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Picture');

        return $results;
    }

    /**
     * create a new picture
     *
     * @return bool
     */
    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `picture` (name)
            VALUES ('{$this->name}')
        ";

        $insertedRow = $pdo->exec($sql);

        if ($insertedRow > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    /**
     * Update a picture
     *
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `picture`
            SET
                name = '{$this->name}',
                updated_at = NOW()
            WHERE id = {$this->id}
        ";

        $updatedRows = $pdo->exec($sql);

        return ($updatedRows > 0);
    }

    /**
     * Delete an existing picture
     *
     * @param int $pictureId
     * @return void
     */
    public static function delete($pictureId)
    {
        $pdo = Database::getPDO();

        $sql = 'DELETE FROM `picture` WHERE id = ' . $pictureId;

        $pdo->exec($sql);
    }

    public static function findListForProduct($productId)
    {
        $pdo = Database::getPDO();

        $sql = "
            SELECT *
            FROM `picture`
            WHERE id IN (
                SELECT picture_id FROM `product_has_picture`
                WHERE product_id = {$productId}
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
}
