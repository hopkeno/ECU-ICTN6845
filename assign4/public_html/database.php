<?php
    $dsn = 'mysql:host=127.0.0.1;dbname=ictn6845';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password); //creates PDO object
    } catch (PDOException $e) {
        $err_msg = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
