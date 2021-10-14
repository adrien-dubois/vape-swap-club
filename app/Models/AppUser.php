<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel{

    /**
     * @var string
     */
    private $email;

    /**
    * @var string
    */
    private $password;

    /**
    * @var string
    */
    private $firstname;

    /**
    * @var string
    */
    private $lastname;

    /**
    * @var string
    */
    private $role;

    /**
    * @var int
    */
    private $status;


    
    /**
     * Find auser by its ID
     *
     * @param int $userId
     * @return AppUser
     */
    public static function find($userId)
    {
        $pdo = Database::getPDO();

        $sql ='
            SELECT *
            FROM `app_user`
            WHERE id = ' . $userId;

        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }

    /**
     * Find all users in DB
     *
     * @return AppUser[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM `app_user`';
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $result;
    }

    /**
     * Add a new user
     *
     * @return bool
     */
    public function insert()
    {
        $pdo = Database::getPDO();

        $sql="
            INSERT INTO `app_user` (email, password, firstname, lastname, role, status)
            VALUES (:email, :password, :firstname, :lastname, :role, :status)
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':email' => $this->email,
            ':password' => $this->password ,
            ':firstname' => $this->firstname ,
            ':lastname' => $this-> lastname,
            ':role' => $this-> role,
            ':status' => $this-> status,
        ]
    );

        if ($pdoStatement->rowCount() > 0){
            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;

    }

    /**
     * Update a user
     *
     * @return AppUser
     */
    public function update()
    {
        $pdo = Database::getPDO();

 
        $sql = "
                UPDATE `app_user`
                SET
                email = :email,
                password = :password,
                firstname = :firstname,
                lastname = :lastname,
                role = :role,
                status = :status,
                updated_at = NOW()
                WHERE id = :id
                ";

        $pdoStatement = $pdo->prepare($sql);


        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':role', $this->role, PDO::PARAM_STR);
        $pdoStatement->bindValue(':status', $this->status, PDO::PARAM_INT);

        $updatedRows = $pdoStatement->execute();


        return ($updatedRows > 0);

    }

    /**
     * Delete an existing user by its ID
     *
     * @param int $userId
     * @return void
     */
    public static function delete($userId){

        $pdo = Database::getPDO();

        $sql = 'DELETE FROM `app_user` WHERE id = ' . $userId;

        $pdo->exec($sql);

    }

    /**
     * Find a user in DB by its Email
     *
     * @param string $email
     * @return bool
     */
    public static function findByEmail($email){

        $pdo = Database::getPDO();

        $sql = ' 
            SELECT * 
            FROM `app_user` 
            WHERE `email` = :email';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindParam(':email', $email, PDO::PARAM_STR);

        $pdoStatement->execute();

        $user=$pdoStatement ->fetchObject(self::class);


        if($user){
            return $user;
        }

        return false ;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}