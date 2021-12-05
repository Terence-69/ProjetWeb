<?php

$username = $_POST["username"];
$password = $_POST["password"];
$city = $_POST["city"];

$url = 'http://localhost/src/Login/register.php?username=' . $username . '&password=' . $password . '&city=' . $city . '';

$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);

echo $response;
