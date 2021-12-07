<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Request extends CoreModel{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $telephone;

    /**
     * @var string
     */
    private $adress;

    /**
     * @var int
     */
    private $accepted;

    /**
     * @var int
     */
    private $app_user_id;
    

    /**
     * Find a vendor request by its ID
     *
     * @param int $request
     * @return Request
     */
    public static function find($requestId)
    {
        $pdo = Database::getPDO();

        $sql ='
            SELECT *
            FROM `request`
            WHERE id = ' . $requestId;

        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }

    /**
     * Find all vendor's request
     *
     * @return Request[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = '
                SELECT *
                FROM `request`      
        ';
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $result;
    }

    /**
     * Find a vendor request by the demandor's ID
     *
     * @param [int] $app_user_id
     * @return Request
     */
    public static function findFromUser($app_user_id){

        $pdo = Database::getPDO();
        $sql = "
                SELECT *
                FROM `request`
                WHERE `app_user_id` = ". $app_user_id ." 
        ";
        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }

    /**
     * Create a new request
     *
     * @return bool
     */
    public function insert()
    {
        $pdo = Database::getPDO();

        $sql="
            INSERT INTO `request` (name, email, telephone, adress, app_user_id)
            VALUES (:name, :email, :telephone, :adress, :app_user_id)
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':telephone' => $this->telephone,
            ':adress' => $this->adress,
            ':app_user_id' => $this->app_user_id
        ]
    );

        if ($pdoStatement->rowCount() > 0){
            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;

    }

    /**
     * Update a request
     *
     * @return Request
     */
    public function update()
    {
        $pdo = Database::getPDO();

 
        $sql = "
                UPDATE `request`
                SET
                name = :name,
                email = :email,
                telephone = :telephone,
                adress = :adress,
                accepted = :accepted,
                app_user_id = :app_user_id,
                updated_at = NOW()
                WHERE id = :id
                ";

        $pdoStatement = $pdo->prepare($sql);


        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $pdoStatement->bindValue(':telephone', $this->telephone, PDO::PARAM_STR);
        $pdoStatement->bindValue(':adress', $this->adress, PDO::PARAM_STR);
        $pdoStatement->bindValue(':accepted', $this->accepted, PDO::PARAM_INT);
        $pdoStatement->bindValue(':app_user_id', $this->app_user_id, PDO::PARAM_INT);

        $updatedRows = $pdoStatement->execute();


        return ($updatedRows > 0);

    }

    
    /**
     * Delete a request
     *
     * @param int $requestId
     * @return void
     */
    public static function delete($requestId){

        $pdo = Database::getPDO();

        $sql = 'DELETE FROM `request` WHERE id = ' . $requestId;

        $pdo->exec($sql);

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
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telephone
     *
     * @return  string
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @param  string  $telephone
     *
     * @return  self
     */ 
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of adress
     *
     * @return  string
     */ 
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set the value of adress
     *
     * @param  string  $adress
     *
     * @return  self
     */ 
    public function setAdress(string $adress)
    {
        $this->adress = $adress;

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

    /**
     * Get the value of accepted
     *
     * @return  int
     */ 
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set the value of accepted
     *
     * @param  int  $accepted
     *
     * @return  self
     */ 
    public function setAccepted(int $accepted)
    {
        $this->accepted = $accepted;

        return $this;
    }
}