<?php

session_start();

require_once '../../bootstrap.php';

use Meteo\Mysql;

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter username.";
} else {
    $username = trim($_POST["username"]);
}

if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
} else {
    $password = trim($_POST["password"]);
}

if (empty($username_err) && empty($password_err)) {

    $mysqli = Mysql::getInstance();

    $query = 'SELECT id, username, pwd, city FROM users WHERE username = "' . $username . '";';

    $result = $mysqli->query($query);
    if (!$result) {
        header('Content-Type: application/json');
        echo json_encode(
            array("message" => "Oops! Something went wrong. Please try again later.")
        );
    } else {
        if ($result->num_rows == 1) {
            while ($obj = $result->fetch_object()) {
                if (password_verify($password, $obj->pwd)) {
                    
                    $json = new stdClass();

                    $json->username = $username;
                    $json->city = $obj->city;
        
                    header('Content-Type: application/json');
                    echo json_encode($json, JSON_PRETTY_PRINT);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(
                        array("message" => "Invalid password")
                    );
                }
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(
                array("message" => "Invalid username")
            );
        }
    }
} else {
    $json = new stdClass();

    $json->username_err = $username_err;
    $json->password_err = $password_err;

    header('Content-Type: application/json');
    echo json_encode($json, JSON_PRETTY_PRINT);
}
