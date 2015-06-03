<?php
namespace finalproject;
use pdo;
//authors nwityak and mehall

class ThreadDAO {
    
    //declare variables and initilize to null
     private $DB = null;
    private $model = null;
    
    //create constructor
    public function __construct( PDO $db) {        
        $this->setDB($db);
       
    }
    //do gets and sets
    private function setDB( PDO $DB) {        
        $this->DB = $DB;
    }
    
    private function getDB() {
        return $this->DB;
    }
    
    private function getModel() {
        return $this->model;
    }
    private function setModel($model) {
        $this->model = $model;
    }
    
    //get thread by a certain ID that will be used for other sections
    public function GetByID($id) {
        
        $model = new ThreadModel();
        
        $db = $this->getDB();
        $stmt = $db->prepare("Select * from thread where threadid = :threadid");
        if($stmt->execute(array(':threadid' => $id)) && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            
            foreach($results as $value) {
            $model->map($value);
            }
            
            return $model;
        }
        
        return false;
    }
    
    
    public function delete($id) {
        $db = $this->getDB();
        $stmt = $db->prepare("Delete from thread where threadid = :threadid");
        
        if ($stmt->execute(array(':threadid' => $id)) && $stmt->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    //function to get all threads to post it
    
    public function GetAllThreads()
    {
        $db = $this->getDB();
        $stmt = $db->prepare("Select * from thread");
        if($stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $value) {
                $model = new ThreadModel();
                $model->reset()->map($value);
                $values[] = $model;
        }
        
        }
        $stmt->closeCursor();
        return $values;
        
    }    
    //save the thread
    //make sure to save each part of the thread
    public function save($thread) {
                 
        $db = $this->getDB();
        $binds = array( ":title" => $thread->getTitle(),
                        ":user" => $thread->getUser(),
                        ":body" => $thread->getBody()
                    );
                     
        $stmt = $db->prepare("INSERT INTO thread SET body = :body, title = :title, user = :user, created = now()");
         
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
            
            
            return true;
        }
         
         return false;
    }
    
    /*
    public function update($model) {
          
        $db = $this->getDB();
        $binds = array( ":id" => $model->getId(),
                        ":email" => $model->getEmail(),
                        ":password" => password_hash($model->getPassword(), PASSWORD_DEFAULT),
                        ":active" => $model->getActive()
                    );
        $stmt = $db->prepare("UPDATE signup SET email = :email, password = :password, active = :active WHERE id = :id");
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }*/
    
    
    
}

