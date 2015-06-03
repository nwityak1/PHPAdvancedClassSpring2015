<?php namespace finalproject; ?>
<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link href='http://fonts.googleapis.com/css?family=Exo+2:100,400' rel='stylesheet' type='text/css' />
        <title>PHP Final Project </title>
        <?php
        
        $util = new Util();
        
        
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        ?>
    </head>
    <body id="bodyElem" class="bgStyle">
	
        <div id="header">
            <a href="signup.php" span class="label"> Sign Up </a> &nbsp;&nbsp;
            <a href="signin.php" span class="label"> Sign In </a> &nbsp;&nbsp;
            <a href="forum.php" span class="label"> View Forums </a> &nbsp;&nbsp;
            <?php if($util->isLoggedin())  echo '<a href="Logout.php" span class="label5">Logout</a>'; ?>
            
            
        </div>
        <div id="container">
		
		<div id="welcomeText" style="font-family: 'Exo 2',serif;">Welcome to the forums</div>
            
        </div>
        
        <div id="footer">
            
        </div>
        
      
        
    </body>
</html>
