<?php
function load_lib($base) {
    
    $baseName = explode( '\\', $base );
    $class = end( $baseName ); 
     
    include 'lib/'.$class . '.php';
    
     
};
spl_autoload_register('load_lib');
session_start();
session_regenerate_id(TRUE);

// This is included so the database can be pulled 
$dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=Forums',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );