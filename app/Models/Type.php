<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Type extends CoreModel{

    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $footer_order;

    /**
     * Find type by ID
     *
     * @param int $typeId
     * @return Type
     */
    public static function find($typeId)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `type` WHERE `id` =' . $typeId;

        $pdoStatement = $pdo->query($sql);
        $type = $pdoStatement->fetchObject('App\Models\Type');

        return $type;
    }


    /**
     * Find all types
     *
     * @return Type[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `type`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Type');
        
        return $results;
    }

    /**
     * Find the 5 types configures for the footer
     *
     * @return Type[]
     */
    public static function findAllFooter()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM type
            WHERE footer_order > 0
            ORDER BY footer_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $types = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Type');
        
        return $types;
    }

    /**
     * create a new type
     *
     * @return bool
     */
    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `type` (name, footer_order)
            VALUES ('{$this->name}', '{$this->footer_order}')
        ";

        $insertedRow = $pdo->exec($sql);

        if($insertedRow > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    /**
     * Update a type
     *
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `type`
            SET
                name = '{$this->name}',
                footer_order = '{$this->footer_order}',
                updated_at = NOW()
            WHERE id = {$this->id}
        ";

        $updatedRows = $pdo->exec($sql);

        return ($updatedRows > 0);
    }

    /**
     * Delete an existing type
     *
     * @param int $typeId
     * @return void
     */
    public static function delete($typeId)
    {
        $pdo = Database::getPDO();

        $sql = 'DELETE FROM `type` WHERE id = ' . $typeId;

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
}