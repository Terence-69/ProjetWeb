<?php

require_once '../../bootstrap.php';

use Meteo\Mysql;

if (empty(trim($_GET["username"]))) {
    $username_err = "Please enter a username.";
} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_GET["username"]))) {
    $username_err = "Username can only contain letters and numbers, and underscores.";
} else {
    $username = trim($_GET["username"]);

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

if (empty(trim($_GET["password"]))) {
    $password_err = "Please enter a password.";
} elseif (strlen(trim($_GET["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
} else {
    $password = trim($_GET["password"]);
}

if (empty(trim($_GET["city"]))) {
    $city_err = "Please enter a city";
} else {
    $city = trim($_GET["city"]);
}

if (empty($message)) {
    if (empty($username_err) && empty($password_err) && empty($city_err)) {
        $passwordh = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

        $query = 'INSERT INTO users (username, pwd, city) VALUES ("' . $username . '", "' . $passwordh . '",  "' . $city . '");';
        $result = $mysqli->query($query);

        if (!$result) {
            header('Content-Type: application/json');
            echo json_encode(
                array("message" => "Oops! Something went wrong. Please try again later.")
            );
        } else {

            $json = new stdClass();

            $json->username = $username;
            $json->password = $password;
            $json->city = $city;

            header('Content-Type: application/json');
            echo json_encode($json, JSON_PRETTY_PRINT);
        }
    } else {
        $json = new stdClass();

        $json->username_err = $username_err;
        $json->password_err = $password_err;
        $json->city_err = $city_err;

        header('Content-Type: application/json');
        echo json_encode($json, JSON_PRETTY_PRINT);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(
        array("message" => "Oops! Something went wrong. Please try again later.")
    );
}
