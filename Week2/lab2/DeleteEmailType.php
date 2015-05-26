<?php namespace week2\nwityak; ?>
<?php include './bootstrap.php'; ?>


 <?php
        
        $dbConfig = array(
                "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
                );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
                              
        
        $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            
            
        if ( NULL !== $emailtypeid ) {
            $emailtypeDAO = new EmailTypeDAO($db);
               
        if ( $emailtypeDAO->delete($emailtypeid) ) {
            echo 'Email Type was deleted';                  
        }   
               
        else {
            echo 'Email Type was not deleted';
        }
        
        }
            
        echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';
        
?>