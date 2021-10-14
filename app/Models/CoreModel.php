<?php

namespace App\Models;


abstract class CoreModel {

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $createdAt;

    /**
     *
     * @var string
     */
    protected $updatedAt;


    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Get the value of createdAt
     *
     * @return  string
     */
    public function getCreatedAt() : string
    {
        return $this->createdAt;
    }

    /**
     * Get the value of updatedAt
     *
     * @return  string
     */
    public function getUpdatedAt() : string
    {
        return $this->updatedAt;
    }

    public function save()
    {
        //If the current object already has an ID, it means modifying an entry in the DB, or it will be created. We can call update or insert methods as appropriate

        if($this->getId() > 0){
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    // To harmonize our code, we indicate abstract methods. These methods must be implemented by the child classes of CoreModel
    abstract static public function findAll();
    abstract static public function find($id);
    abstract public function insert();
    abstract public function update();
    abstract static public function delete($id);
}