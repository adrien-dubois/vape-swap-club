<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Message extends CoreModel{

    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $message;
    /**
     * @var int
     */
    private $sender_id;
    /**
     * @var int
     */
    private $recipient_id;
    /**
     * @var bool
     */
    private $is_read;

    /**
     * Method which allows to get a message by its ID
     *
     * @param [type] $messageId
     * @return void
     */
    public static function find($messageId)
    {
        $pdo = Database::getPDO();

        $sql = '
        SELECT *
        FROM `message`
        WHERE id = ' . $messageId;

        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject('App\Models\Message');

        return $result;

    }

    /**
     * Method to find all messages that are in DB
     *
     * @return Product
     */
    public static function findAll(){

        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM `message`
            ';
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Message');

        return $result;
    }

        /**
     * Method to create a new message in DB
     *
     * @return bool
     */
    public function insert(){

        $pdo = Database::getPDO();

        $sql = '
        INSERT INTO `message` (title, message, sender_id, recipient_id, is_read)
        VALUES (:title, :message, :sender_id, :recipient_id, :is_read)
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            ':title' => $this->title,
            ':message' => $this->message,
            ':sender_id' =>$this->sender_id,
            ':recipient_id' => $this->recipient_id,
            ':is_read' => $this->is_read
        ]);

        if ($pdoStatement->rowCount() > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    /**
     * Method which edit an existing message
     *
     * @return void
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
                UPDATE `message`
                SET
                title = :title,
                message = :message ,
                sender_id = :sender_id,
                recipient_id = :recipient_id,
                is_read = :is_read,
                updated_at = NOW()
                WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $pdoStatement->bindValue(':message', $this->message, PDO::PARAM_STR);
        $pdoStatement->bindValue(':sender_id', $this->sender_id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':recipient_id', $this->recipient_id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':is_read', $this->is_read, PDO::PARAM_INT);

        $updatedRows = $pdoStatement->execute();

        return ($updatedRows > 0);
    }

    public static function delete($messageId)
    {
        $pdo = Database::getPDO();
        $sql = '
        DELETE
        FROM `message`
        WHERE id = ' . $messageId;
        $pdo->exec($sql);
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of message
     *
     * @return  string
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param  string  $message
     *
     * @return  self
     */ 
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of sender_id
     *
     * @return  int
     */ 
    public function getSender_id()
    {
        return $this->sender_id;
    }

    /**
     * Set the value of sender_id
     *
     * @param  int  $sender_id
     *
     * @return  self
     */ 
    public function setSender_id(int $sender_id)
    {
        $this->sender_id = $sender_id;

        return $this;
    }

    /**
     * Get the value of recipient_id
     *
     * @return  int
     */ 
    public function getRecipient_id()
    {
        return $this->recipient_id;
    }

    /**
     * Set the value of recipient_id
     *
     * @param  int  $recipient_id
     *
     * @return  self
     */ 
    public function setRecipient_id(int $recipient_id)
    {
        $this->recipient_id = $recipient_id;

        return $this;
    }

    /**
     * Get the value of is_read
     *
     * @return  bool
     */ 
    public function getIs_read()
    {
        return $this->is_read;
    }

    /**
     * Set the value of is_read
     *
     * @param  bool $is_read
     *
     * @return  self
     */ 
    public function setIs_read(bool $is_read)
    {
        $this->is_read = $is_read;

        return $this;
    }
}