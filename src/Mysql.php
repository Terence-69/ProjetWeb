<?php

namespace Meteo;

use mysqli;

final class Mysql
{
    private static $instance;

    /** @return Mysqli */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = self::getRealInstance();
        }
        return self::$instance;
    }

    /** @return Mysqli */
    private static function getRealInstance()
    {
        $hostname = "127.0.0.1";
        $user = "meteo";
        $password = "meteo";
        $database = "Meteo";
        
        $mysql = new mysqli($hostname, $user, $password, $database);
        
        // Check connection
        if ($mysql->connect_error) {
            die("Connection failed: " . $mysql->connect_error);
        }
        
        return $mysql;
    }
}
