<?php

namespace Meteo\ApiConsumer\Service;

class GetWeatherByCity
{
    public function execute($city)
    {
        $json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=f24d5ed1277307022647a9af93f2b35a&units=metric');
        return json_decode($json);
    }
}
