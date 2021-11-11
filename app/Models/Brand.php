<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Brand extends CoreModel{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $picture;
    

    /**
     * Find a brand by its ID
     *
     * @param int $brandId
     * @return Brand
     */
    public static function find($brandId)
    {
        $pdo = Database::getPDO();

        $sql = '
            SELECT *
            FROM `brand`
            WHERE id = ' . $brandId;

        $pdoStatement = $pdo->query($sql);
        $brand = $pdoStatement->fetchObject('App\Models\Brand');

        return $brand;
    }

    /**
     * Find all brands
     *
     * @return Brand[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM `brand`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Brand');

        return $results;
    }

    /**
     * create a new brand
     *
     * @return bool
     */
    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `brand` (name, picture)
            VALUES ('{$this->name}', '{$this->picture}')
        ";

        $insertedRow = $pdo->exec($sql);

        if($insertedRow > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    /**
     * Update a brand
     *
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `brand`
            SET
                name = '{$this->name}',
                picture = '{$this->picture}',
                updated_at = NOW()
            WHERE id = {$this->id}
        ";

        $updatedRows = $pdo->exec($sql);

        return ($updatedRows > 0);
    }

    /**
     * Delete an existing Brand
     *
     * @param int $brandId
     * @return void
     */
    public static function delete($brandId)
    {
        $pdo = Database::getPDO();

        $sql = 'DELETE FROM `brand` WHERE id = ' . $brandId;

        $pdo->exec($sql);
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

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }
}