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
     * @var int
     */
    private $footer_order;

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
     * Get the five brands configure for the footer
     *
     * @return void
     */
    public static function findAllFooter()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM brand
            WHERE footer_order > 0
            ORDER BY footer_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $brands = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Brand');
        
        return $brands;
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
            INSERT INTO `brand` (name, footer_order, picture)
            VALUES ('{$this->name}', '{$this->footer_order}', '{$this->picture}')
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
                footer_order = '{$this->footer_order}',
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
     * Get the value of footer_order
     */ 
    public function getFooter_order()
    {
        return $this->footer_order;
    }

    /**
     * Set the value of footer_order
     *
     * @return  self
     */ 
    public function setFooter_order($footer_order)
    {
        $this->footer_order = $footer_order;

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