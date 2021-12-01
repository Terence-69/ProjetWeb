<?php

namespace Meteo\ApiConsumer\Controller;

use Meteo\ApiConsumer\Service\GetWeatherByCity;
use Meteo\ApiConsumer\Model\MysqlFactory;

class GetInsert
{
    public function insert($city)
    {
        $data = new GetWeatherByCity();
        $json = $data->execute($city);

        MysqlFactory::insert($json);
    }
}
