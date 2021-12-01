<?php

namespace Meteo\ApiConsumer\Model;

use Meteo\Mysql;

final class MysqlFactory
{
    public static function insert($json)
    {
        $finder = new Insert(Mysql::getInstance());
        return $finder->execute($json);
    }
    
}