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
    protected $created_at;

    /**
     *
     * @var string
     */
    protected $updated_at;


    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId() : ?int
    {
        return $this->id;
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
    
    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }
    // To harmonize our code, we indicate abstract methods. These methods must be implemented by the child classes of CoreModel
    abstract static public function findAll();
    abstract static public function find($id);
    abstract public function insert();
    abstract public function update();
    abstract static public function delete($id);

}