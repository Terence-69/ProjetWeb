<?php

namespace Meteo\ApiConsumer\Model;

use DateTimeZone;

final class Insert
{
    private $mysql;

    public function __construct($mysql)
    {
        $this->mysql = $mysql;
    }

    public function execute($json)
    {
        $json = json_decode($json);
        $cod = $json->cod;

        if ($cod == "404") {
            return null;
        }
        $icon = json_encode($json->weather[0]->icon);
        $temp = json_encode($json->main->temp);
        $name = json_encode($json->name);
        $windSpeed = json_encode($json->wind->speed) * 3.6; // mettre en km/h
        $windDeg = $json->wind->deg;
        $sunrise = json_encode($json->sys->sunrise);
        $sunset = json_encode($json->sys->sunset);
        $humidity = json_encode($json->main->humidity);
        $country = json_encode($json->sys->country);
        $visibility = json_encode($json->visibility) / 1000; // metttre en km
        $weather = json_encode($json->weather[0]->description);

        // on convertie les degres en direction 
        $direction = $windDeg / 22.5 + .5;
        $cardinal_array = ["N", "NNE", "NE", "ENE", "E", "ESE", "SE", "SSE", "S", "SSW", "SW", "WSW", "W", "WNW", "NW", "NNW"];

        $direction = round($direction);
        $cardinal = $cardinal_array[($direction % 16)];

        $sunrise = (new \DateTime)->setTimestamp($sunrise)->setTimezone(new DateTimeZone("Europe/Paris"));
        $sunrise = $sunrise->format('H:i:s');

        $sunset = (new \DateTime)->setTimestamp($sunset)->setTimezone(new DateTimeZone("Europe/Paris"));
        $sunset = $sunset->format('H:i:s');

        $query = 'INSERT INTO city (nom, ventVitesse, ventDirection, leveSoleil, coucheSoleil, humidite, visibilite, paysCode, temperature, conditionMeteo, icon) VALUES (' . $name . ',' . $windSpeed . ',' . json_encode($cardinal) . ',' . json_encode($sunrise) . ',' . json_encode($sunset) . ',' . $humidity . ',' . $visibility . ',' . $country . ',' . $temp . ',' . $weather . ',' . $icon . ');';

        $bool = $this->mysql->query($query);

        if (!$bool) {
            return "error";
        }
        return true;
    }
}
