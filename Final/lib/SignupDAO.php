<?php
namespace finalproject;
use pdo;

//Authors mhall and nwityak
class SignupDAO {
    
    //initialize variables
    private $DB = null;
    private $model = null;
    //create constructor
    public function __construct( PDO $db, $model ) {        
        $this->setDB($db);
        $this->setModel($model);
    }
    //gets and sets for variables
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
    //function to get user info from the email
    public function GetUserInfo($db ,$email, $model) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("Select * from signup where email = :email");
        if($stmt->execute(array(':email' => $email)) && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
         //  var_dump($results);
            $_SESSION['id'] = $results["id"];
            $_SESSION['email'] = $results["email"];
            $model->setEmail($results["email"]);
            $model->setId($results["id"]);
           // var_dump($_SESSION['id']);
            //var_dump($_SESSION['email']);
            return $model;
        }
        
        return false;
        
    }
    
    
    //login function
    public function login($model) {
         
        $email = $model->getEmail();
        $password = $model->getPassword();
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM signup WHERE email = :email");
        if ( $stmt->execute(array(':email' => $email)) && $stmt->rowCount() > 0 ) {            
            $results = $stmt->fetch(PDO::FETCH_ASSOC);            
            return password_verify($password, $results['password']);            
        }
         
        return false;
    }
    
    //save the email and password
    public function save($model) {
                 
        $db = $this->getDB();
        $binds = array( ":email" => $model->getEmail(),
                        ":password" => password_hash($model->getPassword(), PASSWORD_DEFAULT)
                    );
                     
        $stmt = $db->prepare("INSERT INTO signup SET email = :email, password = :password, created = now()");
         
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
            return true;
        }
         
         return false;
    }
    
    //update function 
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
    }
          
}