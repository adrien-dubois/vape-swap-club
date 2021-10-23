<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var int
     */
    private $home_order;

     /**
     * Method which allows to get a category by its ID
     *
     * @param int $categoryId
     * @return Category
     */
    public static function find($categoryId)
    {
        // retrieve a PDO object = connect to the DB
        $pdo = Database::getPDO();

        // we write the SQL query to retrieve the product
        $sql = '
        SELECT *
        FROM `category`
        WHERE id = ' . $categoryId;

        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject('App\Models\Category');

        return $result;

    }

    /**
     * Method to find all categories that are in DB
     *
     * @return Category
     */
    public static function findAll(){

        $pdo = Database::getPDO();
        $sql = '
        SELECT *
        FROM `category`';
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');

        return $result;
    }

    /**
     * Methode to create a new category
     *
     * @return bool
     */
    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = '
        INSERT INTO `category` (name, subtitle, home_order)
        VALUES (:name, :subtitle, :home_order)
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':name' => $this->name,
            ':subtitle' =>$this->subtitle,
            ':home_order' => $this->home_order
        ]);

        if ($pdoStatement->rowCount() > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

     /**
     * Method which update an existing category
     *
     * @return void
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
                UPDATE `category`
                SET
                UPDATE `category`
                SET
                name = :name,
                subtitle = :subtitle,
                home_order = :home_order,
                updated_at = NOW()
                WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':subtitle', $this->subtitle, PDO::PARAM_STR);
        $pdoStatement->bindValue(':home_order', $this->home_order, PDO::PARAM_INT);

        $updatedRows = $pdoStatement->execute();

        return ($updatedRows > 0);
    }

    public static function delete($categoryId)
    {
        $pdo = Database::getPDO();
        $sql = '
        DELETE
        FROM `category`
        WHERE id' . $categoryId;
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
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     * @return  self
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHome_order()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     * @return  self
     */ 
    public function setHome_order($home_order)
    {
        $this->home_order = $home_order;

        return $this;
    }
}