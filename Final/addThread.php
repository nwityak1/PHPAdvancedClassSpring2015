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
       // var_dump($_SESSION);
        $util = new Util();
        $validator = new Validator();
        
        $title = filter_input(INPUT_POST, 'title');
        $body = filter_input(INPUT_POST, 'body');
        $user = filter_input(INPUT_POST, 'user');
        
        
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $ThreadDAO = new ThreadDAO($db);
        
        
         if ( $util->isPostRequest() ) 
        {
         // we validate only if a post has been made
        if ( !$validator->ThreadIsValid($title) ) {
            $errors[] = 'Title is not valid';
        }
        
        if ( !$validator->usernameIsValid($user) ) {
            $errors[] = 'Author is not valid';
        }
               
        if ( !$validator->BodyIsValid($body) ) {
            $errors[] = 'Body is not valid';
        }  
     
         // if there are errors display them
        if ( count($errors) > 0 ){
            foreach ($errors as $value) 
            {
                echo '<span class="label5">',$value,'</span>';
            }
        } 
        else {
        
            $ThreadModel = new ThreadModel();
             
            $ThreadDAO = new ThreadDAO($db);   
            
            $ThreadModel->map(filter_input_array(INPUT_POST));
               
                   
            if ( $ThreadDAO->save($ThreadModel) ) 
            {
           
              echo '<span class="label5"> Thread Created </span>';
       
            } 
            else 
            {
               echo '<span class="label5">Thread Failed</span>';
            }
                   
        }
      
        }
        
        ?>
    </head>
    <body id="bodyElem" class="bgStyle">
        <div id="header">
            <a href="signup.php" span class="label"> Sign Up </a> &nbsp;&nbsp;
            <a href="signin.php" span class="label"> Sign In </a> &nbsp;&nbsp;
            <a href="forum.php" span class="label"> View Forums </a> &nbsp;&nbsp;
            <a href="index.php" span class="label"> Home</a> &nbsp;&nbsp;
            <?php if($util->isLoggedin())  echo '<a href="Logout.php" span class="label5">Logout</a>'; ?>
            
            
        </div>
        <div id="container2">
            <h2 span class="label5"> World Forums </h2> 
            
            <center>
             
            <form action="#" method="post">
                <label span class="label5"> Thread Title </label> &nbsp;&nbsp;
                <input type="text" name="title" value="<?php echo $title; ?>" placeholder="" /> <br />
                
                <label span class="label5"> Author </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="user" value="<?php echo $_SESSION['email']; ?>" placeholder="" /> <br />
                
                <label span class="label5"> First Post </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="body" value="<?php echo $body; ?>" placeholder="" /> <br /> <br />
                
                
                
                <input type="submit" value="Submit" />
                
                
                
            </form>
                
            </center>
        </div>
        
        <div id="footer">
            
        </div>
        
      
        
    </body>
</html>