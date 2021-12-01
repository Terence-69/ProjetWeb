<?php

use Meteo\ApiConsumer\Controller\GetInsert;

require_once '../../../bootstrap.php';

$apiConsumer = new GetInsert();

$apiConsumer->insert("Miami");