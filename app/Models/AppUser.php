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
     * @var string
     */
    private $picture;

    /**
     * @var int
     */
    private $adress_id;

    /**
     * @var string
     */
    private $activation_code;

    /**
     * @var string
     */
    private $status;

    /**
     * @var int
     */
    private $otp;


    
    /**
     * Find a user by its ID
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
     * Count all users
     *
     * @return int
     */
    public static function findNbUsers(){
        $pdo = Database::getPDO();
        $sql = '
            SELECT COUNT(*)
            AS nb_users
            FROM `app_user`
            ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $result = $pdoStatement->fetch();

        $nbUsers = (int) $result['nb_users'];

        return $nbUsers;
    }

    /**
     * Count all vendors
     *
     * @return int
     */
    public static function findNbVendors(){
        $pdo = Database::getPDO();
        $sql = '
            SELECT COUNT(*) AS nb_vendors
            FROM `app_user`
            WHERE `role` = "Vendor"
            ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $result = $pdoStatement->fetch();

        $nbVsers = (int) $result['nb_vendors'];

        return $nbVsers;
    }

    

    /**
     * Find all users that are Vendors for the messenger
     *
     * @return void
     */
    public static function findAllForMessages(){

        $pdo = Database::getPDO();
        $sql = "
                SELECT *
                FROM `app_user`
                WHERE `role` = 'Vendor' 
        ";
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
            INSERT INTO `app_user` (email, password, firstname, lastname, role, picture, adress_id, activation_code, status, otp)
            VALUES (:email, :password, :firstname, :lastname, :role, :picture, :adress_id, :activation_code, :status, :otp)
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':email' => $this->email,
            ':password' => $this->password ,
            ':firstname' => $this->firstname ,
            ':lastname' => $this-> lastname,
            ':role' => $this-> role,
            ':picture' => $this-> picture,
            ':adress_id' => $this->adress_id,
            ':activation_code' => $this->activation_code,
            ':status' => $this->status,
            ':otp' => $this->otp,
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
                picture = :picture,
                adress_id = :adress_id,
                activation_code = :activation_code,
                status = :status,
                otp = :otp,
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
        $pdoStatement->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $pdoStatement->bindValue(':adress_id', $this->adress_id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':activation_code', $this->activation_code, PDO::PARAM_STR);
        $pdoStatement->bindValue(':status', $this->status, PDO::PARAM_STR);
        $pdoStatement->bindValue(':otp', $this->otp, PDO::PARAM_STR);

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
     * Method which verify if the activation code for the current user is good
     *
     * @param string $activationCode
     * @param int $otp
     * @return bool
     */
    public function findUserActivationCode($activationCode, $otp)
    {
        $pdo = Database::getPDO();

        $sql = '
            SELECT *
            FROM `app_user`
            WHERE `activation_code` = :activationCode
            AND `otp` = :otp
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindParam(':activationCode', $activationCode, PDO::PARAM_STR);
        $pdoStatement->bindParam(':otp', $otp, PDO::PARAM_INT);

        $pdoStatement->execute();

        if($pdoStatement->rowCount() > 0){
            return true;
        }
            return false;
    }

    /**
     * Method which activate user that provides the good activation number
     *
     * @param string $activationCode
     * @return void
     */
    public function activateUser($activationCode)
    {
        $pdo = Database::getPDO();

        $sql = "
        UPDATE `app_user`
        SET 
        `status` = :status,
        `updated_at` = NOW()
        WHERE `activation_code` =  '" .$activationCode . "'  " ;

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':status', 'verified', PDO::PARAM_STR);

        $updatedRows = $pdoStatement->execute();

        return ($updatedRows > 0);
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

    /**
     * Get the value of otp
     */ 
    public function getOtp()
    {
        return $this->otp;
    }

    /**
     * Set the value of otp
     *
     * @return  self
     */ 
    public function setOtp($otp)
    {
        $this->otp = $otp;

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


    /**
     * Get the value of activation_code
     *
     * @return  string
     */ 
    public function getActivation_code()
    {
        return $this->activation_code;
    }

    /**
     * Set the value of activation_code
     *
     * @param  string  $activation_code
     *
     * @return  self
     */ 
    public function setActivation_code(string $activation_code)
    {
        $this->activation_code = $activation_code;

        return $this;
    }

    /**
     * Get the value of adress_id
     *
     * @return  string
     */ 
    public function getAdress_id()
    {
        return $this->adress_id;
    }

    /**
     * Set the value of adress_id
     *
     * @param  string  $adress_id
     *
     * @return  self
     */ 
    public function setAdress_id(string $adress_id)
    {
        $this->adress_id = $adress_id;

        return $this;
    }
}