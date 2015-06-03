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
        <title>PHP Final Project</title>
        <?php
       // var_dump($_SESSION);
        $util = new Util();
        
        $dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=Forums',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $ThreadDAO = new ThreadDAO($db);
        $threads = $ThreadDAO->GetAllThreads();
        
        ?>
    </head>
    <body id="bodyElem" class="bgStyle">
        <div id="header">
            <a href="signup.php" span class="label"> Sign Up  </a> &nbsp;&nbsp;
            <a href="signin.php" span class="label"> Sign In  </a> &nbsp;&nbsp;
            <a href="forum.php" span class="label"> View Forums  </a> &nbsp;&nbsp;
            <a href="index.php" span class="label"> Home </a> &nbsp;&nbsp;
            <?php if($util->isLoggedin())  echo '<a href="Logout.php" span class="label5">Logout</a>'; ?>
            
            
        </div>
        <div id="container6">
            <h2 span class="label5"> World Forums </h2>
            
            <center>
             <a href="addThread.php" span class="label"> Make a new thread here! </a>
            
            
            <table border="1" cellpadding="5">
                <th span class="table"> Title </th>
                <th class="table"> Date Created </th>
                <th class="table"> Author </th>
                <th class="table"> View </th>
                <th class="table"> Delete </th>
                
            <?php
            
            
            foreach($threads as $value) {
              //  var_dump($value->getId());
                echo '<tr><td span class="table">', $value->getTitle(),'</td><td span class="table">', $value->getCreated(),'</td> <td span class="table">' ,$value->getUser(),'</td> <td span class="table"> <a href=viewThread.php?threadid=',$value->getId(),'>Join Here!</a></td><td span class="table"><a href=deleteThread.php?threadid=',$value->getId(),'>Delete</a></td></tr>';
            
            }
            ?>
            </table>
                
            </center>
        </div>
        
        <div id="footer">
            
        </div>
        
      
        
    </body>
</html>
