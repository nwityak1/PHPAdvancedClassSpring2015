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
        $PostDAO = new PostDAO($db);
        
        
        
        
         if ( $util->isPostRequest() ) 
        {
            // no post just get
            
        } 
               
        else {
            $threadid = filter_input(INPUT_GET, 'threadid');
            $ThreadModel = new ThreadModel();
            //var_dump($threadid);
            
            
            $ThreadModel = $ThreadDAO->GetByID($threadid);
           //var_dump($ThreadModel);
            $title = $ThreadModel->getTitle();
            $body = $ThreadModel->getBody();
            $user = $ThreadModel->getUser();
            $created = $ThreadModel->getCreated();
            
            $AllComments = $PostDAO->GetPostsByThreadID($threadid);
          
        }
        
        ?>
    </head>
    <body id="bodyElem" class="bgStyle">
        <div id="header">
            <a href="signup.php" span class="label"> Sign Up </a> &nbsp;&nbsp;
            <a href="signin.php" span class="label"> Sign In </a> &nbsp;&nbsp;
            <a href="forum.php" span class="label"> View Forums </a> &nbsp;&nbsp;
            <a href="index.php" span class="label"> Home Page</a>&nbsp;&nbsp;
            <?php if($util->isLoggedin())  echo '<a href="Logout.php" span class="label">Logout</a>'; ?>
            
            
        </div>
        <div id="container3">
             
            <input type="hidden" name="threadid" value="<?php echo $threadid; ?>" />
            
            <center>
                
                <h3 span class ="table"> <?php echo $title; ?> created by <?php echo $user; ?> </h3>
                
                <table border="1" cellpadding="5">
                    <tr> <th span class ="table"> Username </th> <th span class ="table"> Post </th> <th span class ="table"> Date Posted </th>
                    <tr> <td> <?php echo $user; ?> <td> <?php echo $body; ?></td> <td> <?php echo $created; ?> </tr>
                    
                    <?php                            
                    
                    if($AllComments != null && $threadid!=null) {
                        foreach($AllComments as $comment) {
                            echo '<tr><td >',$comment->getUser(),'</td><td>',$comment->getBody(),'</td><td>',$comment->getCreated(),'</td><tr>';
                        }
                    }
                    
                    ?>
                    
                </table>
                
                
                
                 <br />
                 <a href="addPost.php?threadid=<?php echo $threadid?>" span class ="label">  Click here to add a post! </a>
                
                
            </center>
        </div>
        
        <div id="footer">
            
        </div>
        
      
        
    </body>
</html>