<?php

function add_user($username,$password) {
    global $db;
    $hash = password_hash($password,PASSWORD_DEFAULT);
    $query = 'INSERT INTO users (username, password) VALUES (:username, :password);';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);    
    $statement->bindValue(':password', $hash);
    $statement->execute();
    $statement->closeCursor();
}

function user_exists($username) {
    global $db;
    $query = 'SELECT * FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    if ($results == null)
        return false;
    else
        return true;
}

function is_valid_login($username,$password) {
    global $db;
    $query = 'SELECT password FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    return password_verify($password, $hash);
}

?>