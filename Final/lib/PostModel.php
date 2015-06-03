<?php
namespace finalproject;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostModel
 *
 * @author mhall and nwityak
 */
class PostModel {
    
    //initilizare variables
    private $postid;
    private $threadid;
    private $user;
    private $created;
    
    private $body;
    //do gets and sets for variables
    function getPostid() {
        return $this->postid;
    }

    function getThreadid() {
        return $this->threadid;
    }

    function getUser() {
        return $this->user;
    }

    function getCreated() {
        return $this->created;
    }

    function getBody() {
        return $this->body;
    }

    function setPostid($postid) {
        $this->postid = $postid;
    }

    function setThreadid($threadid) {
        $this->threadid = $threadid;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setBody($body) {
        $this->body = $body;
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
