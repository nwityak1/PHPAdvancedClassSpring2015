<?php
namespace finalproject;
use pdo;

//authors nwityak and mhall
class ThreadModel {
    
    //declare variables
    private $threadid;
    private $user;
    private $title;
    private $created;
    private $body;
    
    //perform gets and sets
    function getBody() {
        return $this->body;
    }

    function setBody($body) {
        $this->body = $body;
    }

        
    function getId() {
        return $this->threadid;
    }

    function getUser() {
        return $this->user;
    }

    function getTitle() {
        return $this->title;
    }

    function getCreated() {
        return $this->created;
    }

    function setThreadid($threadid) {
        $this->threadid = $threadid;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    public function map(array $values) {
        
        foreach ($values as $key => $value) {
           $method = 'set' . $key;
            if ( method_exists($this, $method) ) {
                $this->$method($value);
            }       
        } 
        return $this;
    }
    
    public function reset() {
        
        $class_methods = get_class_methods($this);
        foreach ($class_methods as $method_name) {
           if ( strrpos($method_name, 'set', -strlen($method_name)) !== FALSE ) {
               $this->$method_name('');
           }
            
        } 
         return $this;
    }

}

