<?php
// Include config file
require_once '../../bootstrap.php';

use Meteo\Mysql;

// Define variables and initialize with empty values

$username = "tetete";
$password = "tetete";
$confirm_password = "tetete";
$username_err = $password_err = $confirm_password_err = "err";

// Processing form data when form is submitted

// Validate username
if (empty(trim($username))) {
    $username_err = "Please enter a username.";
} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($username))) {
    $username_err = "Username can only contain letters and numbers, and underscores.";
} else {

    $username = trim($username);

    $mysqli = Mysql::getInstance();

    // Prepare a select statement
    $query = 'SELECT id FROM users WHERE username = "' . $username . '";';
    $re = $mysqli->query($query);
    echo "oui";

    // echo $re;
    // if (!$result) {
    //     echo "nooon";
    // } else {
        // if ($result->num_rows == 1) {
        //     $username_err = "This username is already taken.";
        // }
    // }
}

// Validate password
if (empty(trim($password))) {
    $password_err = "Please enter a password.";
} elseif (strlen(trim($password)) < 6) {
    $password_err = "Password must have atleast 6 characters.";
} else {
    $password = trim($password);
}

// Validate confirm password
if (empty(trim($confirm_password))) {
    $confirm_password_err = "Please confirm password.";
} else {
    $confirm_password = trim($confirm_password);
    if (empty($password_err) && ($password != $confirm_password)) {
        $confirm_password_err = "Password did not match.";
    }
}

// Check input errors before inserting in database

    $password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

    // Prepare an insert statement
    $query = 'INSERT INTO users (username, pwd) VALUES ("' . $username . '", "' . $password . '");';

    $result = $mysqli->query($query); 
    if (!$result) {
        echo "nooon";
    } else {
        // Redirect to login page
        header("location: register.php");
    }


// Close connection
$mysqli->close();
