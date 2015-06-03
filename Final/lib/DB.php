<?php
/**
 * DB is the general class to connection to our database
 *
 * @author mhall and nwityak
 */
namespace finalproject;
use pdo;
class DB {
    
    //initialize variables
    protected $db = null;
    private $dbConfig = array();
   
     
   //constructor
    public function __construct($dbConfig) {
        $this->setDbConfig($dbConfig);      
    }
    //get & sets for dbConfig
    private function getDbConfig() {
        return $this->dbConfig;
    }
    private function setDbConfig($dbConfig) {
        $this->dbConfig = $dbConfig;
    }
    
    /**
    * A method to get our database connection.
    *    
    * @return PDO
    */           
    
    public function getDB() { 
        if ( null != $this->db ) {
            return $this->db;
        }
        try {
            $config = $this->getDbConfig();
            $this->db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $ex) {
          
           $this->closeDB();
        }
        return $this->db;        
    }
    
    /**
    * A method to close our database connection.
    *    
    * @return void
    */  
     public function closeDB() {        
        $this->db = null;        
    }
    
    
}