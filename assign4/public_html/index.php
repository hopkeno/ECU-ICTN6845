<?php
require('database.php');

// Get comments and store in results
$query = 'SELECT * FROM comments;';
$statement = $db->prepare($query);
$statement->execute();
$results = $statement->fetchAll();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>ICTN6845</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <main>
            <h1>ICTN6845 - Assignment 4</h1>
            <h2>Add New Comment</h2>
            <form action="add_comment.php" method="post" id="add_comment_form">
                <label>Comment:</label>
                <input type="text" name="comment"><br>
                <input type="submit" value="Add Comment"><br>
            </form>
            <section>
                <?php if ($results == null) { ?>
                    <h2>No previous comments.</h2>
                    <p>Post a new comment using the form above!</p>
                <?php } else { ?>
                    <h2>Comments:</h1>
                    <table>
                        <tr>
                            <th>Date Added</th>
                            <th>Comment</th>
                        </tr>
                        <?php foreach ($results as $result) : ?>
                            <tr>
                                <td><?php echo $result['created_at']; ?></td>
                                <td><?php echo $result['comment']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php } ?>
            </section>
        </main>
    </body>
</html>
