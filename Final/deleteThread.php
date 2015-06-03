<?php namespace finalproject; ?>
<?php include './bootstrap.php'; ?>
<?php
    /* This is the php page that deletes the thread */
    
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    // pulls the thread id from the get request 
    $threadid = filter_input(INPUT_GET, 'threadid');
    
    if( null !== $threadid) {
        $ThreadDAO = new ThreadDAO($db);
        // deletes the thread 
        if($ThreadDAO->delete($threadid)) {
            echo '<span class="label5">Thread was Deleted </span>';
            header('Location: forum.php');
        }
        
        else {
            echo '<span class="label5">Thread was not deleted</span>';
        }
    }
       
    
    
        
