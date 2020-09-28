<?php
    // Get the comment from the form
    $comment = filter_input(INPUT_POST, "comment");

    //Verify there is actually a comment to add
    if ($comment == null) {
        $err_msg = "You must enter a comment. Please try again.";
        include("error.php");
    } else {
        require_once("database.php");
        //Add the comment to the DB        
        $query = 'INSERT INTO comments (comment) VALUES (:comment)';
        $statement = $db->prepare($query);
        $statement->bindValue(':comment', $comment);
        try {
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $err_msg = $e->getMessage();
            include('database_error.php');
            exit();
        }

        //Display the index
        include("index.php");
    }
?>