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
        
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        $errors = array();
        
       
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        // If there is a post request
        if ( $util->isPostRequest() ) 
        {
         // we validate only if a post has been made
        if ( !$validator->emailIsValid($email) ) {
            $errors[] = 'Email is not valid';
        }
        
        // validates password
        if ( !$validator->passwordIsValid($password) ) {
            $errors[] = 'Password is not valid';
        }  
     
         // if there are errors display them
        if ( count($errors) > 0 ){
            foreach ($errors as $value) 
            {
                echo '<span class="label5">',$value,'</span>';
            }
        } 
        else {
        
            $SignupModel = new SignupModel();
            $SignupDAO = new SignupDAO($db, $SignupModel);   
            
            $SignupModel->map(filter_input_array(INPUT_POST));
                    
              // This is where the login is checked      
            if ( $SignupDAO->login($SignupModel) ) 
            {
              // If the login is successful then login is set to true and the user info is pulled
              echo '<span class="label5"> Login Success</span>';
              $util->setLoggedin(true);
              $SignupDAO->GetUserInfo($db, $email, $SignupModel);
              //var_dump($SignupModel);
       
            } 
            else 
            {
                // Login failed
               echo '<span class="label5"> Login Failed </span>';
            }
                   
        }
      
        }
        
        ?>
    </head>
    <body id="bodyElem" class="bgStyle">
        <div id="header">
            <a href="signup.php" span class="label"> Sign Up </a> &nbsp;&nbsp;
            <a href="signin.php" span class="label"> Sign In </a> &nbsp;&nbsp;
            <a href="forum.php" span class="label"> View Forums</a> &nbsp;&nbsp;
            <a href="index.php"span class="label" >Home </a>&nbsp;&nbsp;
            <!-- If the user is logged in then the logout button is displayed -->
           <?php if($util->isLoggedin())  echo '<a href="Logout.php" span class="label5">Logout</a>'; ?>
            
        </div>
        <div id="container">
            <!-- This is the sign in form --> 
            <center>
            <h3 span class="label5"> Sign In </h3>
            <form action="#" method="post">
                <label span class="label5"> Email </label>
                <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
                
                <label span class="label5"> Password </label> 
                <input type="text" name="password" value="<?php echo $password; ?>" placeholder="" />
                
                <input type="submit" value="Submit"  />
                
                
                
            </form>
            </center>
            
        </div>
        
        <div id="footer">
            
        </div>
        
      
        
    </body>
</html>