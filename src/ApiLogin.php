<?php

$username = $_POST["username"];
$password = $_POST["password"];

$url = 'http://localhost/src/Login/login.php?username=' . $username . '&password=' . $password . '';

$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);

echo $response;
