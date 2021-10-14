<?php

namespace App\Models;

use App\Utils\Database;

class Brand extends CoreModel{

    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $footer_order;
    

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