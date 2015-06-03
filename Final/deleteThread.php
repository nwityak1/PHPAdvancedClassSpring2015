<?php namespace finalproject; ?>
<?php include './bootstrap.php'; ?>
<?php
   
    
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
       
    
    
        
