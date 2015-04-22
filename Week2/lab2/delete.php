<?php namespace week2\nwityak;?>
<?php include './bootstrap.php'; ?>

<!DOCTYPE html>
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
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
                              
            // get values from URL
            
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailid = filter_input(INPUT_GET, 'emailid');
            
            
            if ( NULL !== $emailtypeid ) {
               $emailTypeDAO = new EmailTypeDAO($db);
               
               if ( $emailTypeDAO->delete($emailtypeid) ) {
                   echo 'Email Type was deleted';                  
               }   
               
              else{
                  
                  echo ' could not delete';
                  
              }
        
            }
            
             if ( NULL !== $emailid ) {
               $emailDAO = new EmailDAO($db);
               
               if ( $emailDAO->delete($emailid) ) {
                   echo 'Email Type was deleted';                  
               }   
               
              else{
                  
                  echo ' could not delete';
                  
              }
        
            }
            
            
            
             echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';
        
        ?>
        
        
        
        
        
        
    </body>
</html>
 