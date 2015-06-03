<?php
/**
 * Validator Class
 * 
 * A collection of functions used to validate data
 *
 * @author nwityak and mhall 
 */
namespace finalproject;
class Validator {
    /**
     * A method to check if an email is valid.
     *
     * @param {String} [$email] - must be a valid email
     *
     * @return boolean
     */
    public function emailIsValid($email) {
        return ( is_string($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false );
    }
    /**
     * A method to check if the email type is valid.
     *
     * @param {String} [$email] - must be a valid email type
     *
     * @return boolean
     */
    
      //create "IsValid" functions accordingly
    //Check to see if emailtype is vlad
    public function emailTypeIsValid($email) {
        return ( is_string($email) && !empty($email) );
    }
    //check to see if username is valid
    public function usernameIsValid($username) {
        return ( is_string($username) && !empty($username));
    }
    //check to see if the comment is valid or not
    public function commentIsValid($comment) {
        return ( is_string($comment) && !empty($comment));
    }   
    //check to see if the thread is valid
    public function ThreadIsValid($thread) {
        return ( is_string($thread) && !empty($thread));
    }
    //check to see if the body is valid
    public function BodyIsValid($body) {
        return ( is_string($body) && !empty($body));
    }
    //check to see if passwor is valid
    public function passwordIsValid($password) {
        return ( is_string($password) && !empty($password));
    }
     public function activeIsValid($type) {
        return ( is_string($type) && preg_match("/^[0-1]$/", $type) );
    }
}