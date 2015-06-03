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
        $validator = new Validator();
        
        $user = filter_input(INPUT_POST, 'user');
        $body = filter_input(INPUT_POST, 'body');
        
        $errors = array();
        
        
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $PostDAO = new PostDAO($db);
               
        
         if ( $util->isPostRequest() ) 
        {
             
           $threadid = filter_input(INPUT_GET, 'threadid');
              
            
            
            if ( !$validator->commentIsValid($body) ) {
            $errors[] = 'Comment is not valid';
            }
        
        
            if ( !$validator->usernameIsValid($user) ) {
                $errors[] = 'Username is not valid';
            }  
     
             // if there are errors display them
            if ( count($errors) > 0 ){
                    foreach ($errors as $value) 
                {
                    echo '<span class="label5">',$value,'</span>';
                }
            }
            
            else {
                
            $PostModel = new PostModel();
            $PostModel->map(filter_input_array(INPUT_POST));
               
                   
            if ( $PostDAO->save($PostModel) ) 
            {
           
              echo '<span class="label5"> Post Created </span>';
              header('Location: forum.php');
            } 
            else 
            {
               echo '<span class="label5"> Post Failed </span>';
            }
                
            }
            
        } 
        
        
        else {
            $threadid = filter_input(INPUT_GET, 'threadid');
                     
        }
        
        
               
        
        ?>
    </head>
    <body id="bodyElem" class="bgStyle">
        <div id="header">
            <a href="signup.php" span class="label"> Sign Up </a> &nbsp;&nbsp;
            <a href="signin.php" span class="label"> Sign In </a> &nbsp;&nbsp;
            <a href="forum.php" span class="label"> View Forums </a> &nbsp;&nbsp;
            <a href="index.php" span class="label"> Home </a> &nbsp;&nbsp;
            <?php if($util->isLoggedin())  echo '<a href="Logout.php" span class="label5">Logout</a>'; ?>
            
            
        </div>
        <div id="container3">
             
            
            
            <center>
                
                <h3 span class="label"> Add a post </h3>
                <form action="#" method="post">
                
                <input type="hidden" name="threadid" value="<?php echo $threadid; ?>" />
                
                <label span class="label"> User </label> 
                <input type="text" name="user" value="<?php if($_SESSION != null) { echo $_SESSION['email']; } ?>" placeholder="" /> <Br />
                
                <label span class="label"> Comment </label> <br />
                <TEXTAREA NAME="body" maxlength="250" ROWS=5 COLS=60 ><?php echo $body;?>
                </TEXTAREA><br />
                
                <input type="submit" value="Submit" />
                
                
                
            </form>
                
                
                
                 <br />
                 
                
                
            </center>
        </div>
        
        <div id="footer">
            
        </div>
        
      
        
    </body>
</html>