<?php
function load_lib($base) {
    
    $baseName = explode( '\\', $base );
    $class = end( $baseName ); 
     
    include 'lib/'.$class . '.php';
    
     
};
spl_autoload_register('load_lib');
session_start();
session_regenerate_id(TRUE);