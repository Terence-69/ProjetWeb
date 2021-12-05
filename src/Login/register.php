<?php

require_once '../../bootstrap.php';

use Meteo\Mysql;

if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username.";
} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
    $username_err = "Username can only contain letters and numbers, and underscores.";
} else {
    $username = trim($_POST["username"]);

    $mysqli = Mysql::getInstance();
    $query = 'SELECT id FROM users WHERE username = "' . $username . '";';
    $result = $mysqli->query($query);

    if (!$result) {
        $message = "Oops! Something went wrong. Please try again later.";
    }
    if ($result->num_rows >= 1) {
        $username_err = "This username is already taken.";
    }
}

if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
} elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
} else {
    $password = trim($_POST["password"]);
}

if (empty(trim($_POST["city"]))) {
    $city_err = "Please enter a city";
} else {
    $city = trim($_POST["city"]);
}

if (empty($message)) {
    if (empty($username_err) && empty($password_err) && empty($city_err)) {
        $passwordh = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

        $query = 'INSERT INTO users (username, pwd, city) VALUES ("' . $username . '", "' . $passwordh . '",  "' . $city . '");';
        $result = $mysqli->query($query);

        if (!$result) {
            header('Content-Type: application/json');
            echo json_encode(
                array("status" => "401",
                    "message" => "Oops! Something went wrong. Please try again later.")
            );
        } else {

            $json = new stdClass();
            $json->status = "200";
            $json->username = $username;
            $json->city = $city;

            header('Content-Type: application/json');
            echo json_encode($json, JSON_PRETTY_PRINT);
        }
    } else {
        $json = new stdClass();

        $json->status = "401";
        $json->message = "";
        if(isset($username_err)) {
            $json->message = $json->message .' '. $username_err;
        }
        if(isset($password_err)) {
            $json->message = $json->message .' '. $password_err;
        }
        if(isset($city_err)) {
            $json->message = $json->message .' '. $city_err;
        }

        header('Content-Type: application/json');
        echo json_encode($json, JSON_PRETTY_PRINT);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(
        array("status" => "401",
            "message" => "Oops! Something went wrong. Please try again later.")
    );
}
