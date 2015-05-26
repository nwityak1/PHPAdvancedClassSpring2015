<?php namespace week2\nwityak; ?>
<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $util = new Util();
        $validator = new Validator();
        
              
        $emailtype = filter_input(INPUT_POST, 'emailtype');
        $active = filter_input(INPUT_POST, 'active');
        
        $errors = array();
        
        $dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $emailDAO = new EmailDAO($db);
        $emailtypeDAO = new EmailTypeDAO($db);
        
        $emailtypes = $emailtypeDAO->getAllRows();
        
        
        if ( $util->isPostRequest() ) 
        {
         // we validate only if a post has been made
        
        if ( empty($emailtype) ) {
            $errors[] = 'Email type is invalid';
        }
        
        if ( !$validator->activeIsValid($active) ) {
            $errors[] = 'Active is not valid';
        }  
     
         // if there are errors display them
        if ( count($errors) > 0 ){
            foreach ($errors as $value) 
            {
                echo '<p>',$value,'</p>';
            }
        } 
        else {
        
            $emailtypeModel = new EmailTypeModel();
                    
            $emailtypeModel->map(filter_input_array(INPUT_POST));
                    
                   
            if ( $emailtypeDAO->save($emailtypeModel) ) 
            {
               echo 'Email Type Added';
               
            } 
            else 
            {
               echo 'Email Type not added';
            }
                   
        }
    
    
        }
        
        
        
        ?>
        <br />
        <a href="email-test.php"> Add Email </a> &nbsp &nbsp
        
        
        <h3> Add Email Type </h3>
        
        <form action="#" method="post">
            
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailtype; ?>" />
            
            <br />
            
            <label> Active: </label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" /> <br />
          
       
            <input type="submit" value="add" />
        </form>
        
        <br />
        <br />
        
        <table border="1" cellpadding="5">
                <tr>
                    
                    <th>Email Type</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
         <?php 
            $emailtypes = $emailtypeDAO->getAllRows(); 
            foreach ($emailtypes as $value) {
                echo '<tr><td>',$value->getEmailtype(),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>' ;
                echo '<td> <a href=UpdateEmailType.php?emailtypeid=',$value->getEmailtypeid(),'>Update</a></td>';
                echo '<td> <a href=DeleteEmailType.php?emailtypeid=',$value->getEmailtypeid(),'>Delete</a></td></tr>';
            }

         ?>
            </table>
       
        
    </body>
</html>