<?php
// Start session management and include DB functions
session_start();
require_once('database.php');
require_once('user_db.php');

// Determin action
$action = filter_input(INPUT_POST,'action');
if ($action == NULL) {
    $action =  filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_comments';
    }
}

// If the user isn't logged in, force the login
if (!isset($_SESSION['is_authenticated'])) {
    $action = 'login';
}

// Perform the specified action
switch($action) {
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_login($username,$password)) {
            $_SESSION['is_authenticated'] = true;
            include("comments.php");
        } else {
            $login_message = 'You must login to view this page.';
            include("login.php");
        }
        break;
    case 'show_comments':
        include("comments.php");
        break;
    case 'logout':
        $_SESSION = array();
        session_destroy();
        $login_message = 'You have been logged out.';
        include("index.php");
        break;
}
?>
