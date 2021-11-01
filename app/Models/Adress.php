<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Adress extends CoreModel{
    /**
     * @var str
     */
    private $name;
    /**
     * @var int
     */
    private $number;
    /**
     * @var str
     */
    private $adress;
    /**
     * @var str
     */
    private $message;
    /**
     * @var int
     */
    private $zip;
    /**
     * @var str
     */
    private $city;
    /**
     * @var int
     */
    private $phone;
    /**
     * @var str
     */
    private $app_user_id;


    /**
     * find a specific adress by its ID
     *
     * @param int $adressId
     * @return Adress
     */
    public static function find($adressId)
    {
        // retrieve a PDO object = connect to the DB
        $pdo = Database::getPDO();

        // we write the SQL query to retrieve the adress
        $sql = '
        SELECT *
        FROM adress
        WHERE id = ' . $adressId;

        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject('App\Models\Adress');

        return $result;

    }

    /**
     * Find all adresses
     *
     * @return Adress[]
     */
    public static function findAll(){

        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM `adress`
            ';
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Adress');

        return $result;
    }

    /**
     * Create a new adress
     *
     * @return bool
     */
    public function insert(){

        $pdo = Database::getPDO();

        $sql = '
        INSERT INTO `adress` (name, number, adress, message, zip, city, phone, app_user_id)
        VALUES (:name :number, :adress, :message, :zip, :city, :phone, :app_user_id)
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':name' => $this->name,
            ':number' => $this->number,
            ':adress' =>$this->adress,
            ':message' => $this->message,
            ':zip' => $this->zip,
            ':city' => $this->city,
            ':phone' => $this->phone,
            ':app_user_id' => $this->app_user_id,
        ]);

        if ($pdoStatement->rowCount() > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

        /**
     * Method which update an existing adress
     *
     * @return void
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
                UPDATE `adress`
                SET
                name = :name,
                number = :number ,
                adress = :adress,
                message = :message,
                zip = :zip,
                city = :city,
                phone = :phone,
                app_user_id = :app_user_id,
                updated_at = NOW()
                WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':number', $this->number, PDO::PARAM_INT);
        $pdoStatement->bindValue(':adress', $this->adress, PDO::PARAM_STR);
        $pdoStatement->bindValue(':message', $this->message, PDO::PARAM_STR);
        $pdoStatement->bindValue(':zip', $this->zip, PDO::PARAM_INT);
        $pdoStatement->bindValue(':city', $this->city, PDO::PARAM_STR);
        $pdoStatement->bindValue(':phone', $this->phone, PDO::PARAM_INT);
        $pdoStatement->bindValue(':app_user_id', $this->app_user_id, PDO::PARAM_INT);

        $updatedRows = $pdoStatement->execute();

        return ($updatedRows > 0);
    }

    /**
     * Delete an adress by its id
     *
     * @param int $adressId
     * @return void
     */
    public static function delete($adressId)
    {
        $pdo = Database::getPDO();
        $sql = '
        DELETE
        FROM `adress`
        WHERE id' . $adressId;
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
     * Get the value of number
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of adress
     */ 
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set the value of adress
     *
     * @return  self
     */ 
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of zip
     */ 
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set the value of zip
     *
     * @return  self
     */ 
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of app_user_id
     */ 
    public function getApp_user_id()
    {
        return $this->app_user_id;
    }

    /**
     * Set the value of app_user_id
     *
     * @return  self
     */ 
    public function setApp_user_id($app_user_id)
    {
        $this->app_user_id = $app_user_id;

        return $this;
    }
}