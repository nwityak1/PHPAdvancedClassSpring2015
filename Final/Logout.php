<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* logs the user out by destroying the session */ 
Session_start();
Session_destroy();
header('Location: signin.php');




?>
