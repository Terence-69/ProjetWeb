<?php

require_once '../../../bootstrap.php';

use Meteo\ApiConsumer\Controller\GetInsert;
use Meteo\ApiProvider\Model\MysqlFactory;

$name = $_GET["name"];

$apiConsumer = new GetInsert();

$apiConsumer->insert($name);

$city = MysqlFactory::get($name);

if (!empty($city)) {
    // set response code - 200 OK
    http_response_code(200);

    header('Content-Type: application/json');
    echo json_encode($city, JSON_PRETTY_PRINT);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
