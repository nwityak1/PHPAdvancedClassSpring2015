<?php
namespace finalproject;
use pdo;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostDAO
 *
 * @author Mike
 */
class PostDAO {
   //initilizare variables
    private $DB = null;
    private $model = null;
    
    //constructor
    public function __construct( PDO $db) {        
        $this->setDB($db);
       
    }
    //gets and sets for DB and Model
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
    
    //function for get the posts by a specific ID
    //select and a where clause needed...
    public function GetPostsByThreadID($id) {
        
        $model = new PostModel();
        
        $db = $this->getDB();
        $stmt = $db->prepare("Select * from posts where threadid = :threadid");
        if($stmt->execute(array(':threadid' => $id)) && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $value) 
            {
                $model = new ThreadModel();
                $model->reset()->map($value);
                $values[] = $model;
            }
            
            return $values;
        }
        
        return false;
    }
   
    //get all threads
    //select statement
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
    //save function..
    //INSERT? statement needed
    public function save($post) {
                 
        $db = $this->getDB();
        $binds = array( ":user" => $post->getUser(),
                        ":threadid" => $post->getThreadid(),
                        ":body" => $post->getBody()
                    );
                     
        $stmt = $db->prepare("INSERT INTO posts SET body = :body, user = :user, threadid = :threadid, created = now()");
         
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {       
            return true;
        }
         
         return false;
    }
    
}
