<?php namespace week2\nwityak; ?>
<?php include './bootstrap.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );

        $errors = array();
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
       
        $util = new Util();
        $validator = new Validator();
        
        $emailtypeDAO = new EmailTypeDAO($db);
        
        
       
        $emailtypeModel = new EmailtypeModel();
        
        $emailtypeid = filter_input(INPUT_POST, 'emailtypeid');
        $emailtype = filter_input(INPUT_POST, 'emailtype');
        $active = filter_input(INPUT_POST, 'active');
         
        if ( $util->isPostRequest() ) {
            
            
            if ( !$validator->emailTypeIsValid($emailtype) ) {
            $errors[] = 'Email is not valid';
            }
            
            if ( !$validator->emailTypeIsValid($emailtype) ) {
            $errors[] = 'Email is not valid';
            }
            
            if( count($errors) > 0 ) {
                foreach ($errors as $value) 
                {
                    echo '<p>',$value,'</p>';
                }
            }
            
            else {
            
            $emailtypeModel->map(filter_input_array(INPUT_POST));
            
            if( $emailtypeDAO->save($emailtypeModel) ) {
                echo '<p> Email Type Updated </p>';
            }
            else 
            {
                echo '<p> Email Type not Updated </p>';
            }
            
            }
            
                     
        } 
        else 
        {
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailtypeModel = $emailtypeDAO->getByID($emailtypeid);
            
            $emailtypeid = $emailtypeModel->getEmailtypeid();
            $emailtype = $emailtypeModel->getEmailtype();
            $active = $emailtypeModel->getActive(); 
        }
        
        
        ?>
        <a href="email-test.php"> Add Email </a> &nbsp &nbsp
        <a href="emailtype-test.php"> Add Email Type </a>
        
        
         <h3>Update Email Type</h3>
        <form action="#" method="post">
             <input type="hidden" name="emailtypeid" value="<?php echo $emailtypeid; ?>" />
            
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailtype; ?>" />
            <br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Update" />
        </form>
         
       
                  
    </body>
</html>