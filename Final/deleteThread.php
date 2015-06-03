<?php namespace finalproject; ?>
<?php include './bootstrap.php'; ?>
<?php
    $dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=Forums',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
    
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    
    $threadid = filter_input(INPUT_GET, 'threadid');
    
    if( null !== $threadid) {
        $ThreadDAO = new ThreadDAO($db);
        
        if($ThreadDAO->delete($threadid)) {
            echo '<span class="label5">Thread was Deleted </span>';
            header('Location: forum.php');
        }
        
        else {
            echo '<span class="label5">Thread was not deleted</span>';
        }
    }
       
    
    
        
