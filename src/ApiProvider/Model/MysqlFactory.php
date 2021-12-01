<?php

namespace Meteo\ApiProvider\Model;

use Meteo\Mysql;

final class MysqlFactory
{
    public static function get($name)
    {
        $finder = new Get(Mysql::getInstance());
        return $finder->execute($name);
    }
    
}