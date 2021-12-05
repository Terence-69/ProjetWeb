<?php

namespace Meteo\ApiConsumer\Service;

use Twig\TokenParser\FlushTokenParser;

class GetWeatherByCity
{
    public function execute($city)
    {
        $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=f24d5ed1277307022647a9af93f2b35a&units=metric';

        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);

        // $json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=f24d5ed1277307022647a9af93f2b35a&units=metric');
        return $response;
    }
}
