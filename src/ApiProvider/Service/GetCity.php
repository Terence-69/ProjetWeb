<?php

require_once '../../../bootstrap.php';

use Meteo\ApiConsumer\Controller\GetInsert;
use Meteo\ApiProvider\Model\MysqlFactory;

$name = $_GET["name"];

$apiConsumer = new GetInsert();

$var = $apiConsumer->insert($name);

if ($var == null) {
    header('Content-Type: application/json');
    echo json_encode(
        array("message" => "City not found")
    );
} else if ($apiConsumer == "error") {
    header('Content-Type: application/json');
    echo json_encode(
        array("message" => "Oops! Something went wrong. Please try again later.")
    );
} else {
    $city = MysqlFactory::get($name);

    if ($city == "error") {
        header('Content-Type: application/json');
        echo json_encode(
            array("message" => "Oops! Something went wrong. Please try again later.")
        );
    } else {
        header('Content-Type: application/json');
        echo json_encode($city, JSON_PRETTY_PRINT);
    }
}
