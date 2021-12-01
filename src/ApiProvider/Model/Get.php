<?php

namespace Meteo\ApiProvider\Model;

final class Get
{
    private $mysql;

    public function __construct($mysql)
    {
        $this->mysql = $mysql;
    }

    public function execute($name)
    {
        $query = 'SELECT * FROM city WHERE nom like "%'.$name. '%" ORDER BY id DESC LIMIT 1;';

        $bool = $this->mysql->query($query);

        if (!$bool) {
            return "erreur lors de la récupération dans la table";
        }
        while ($row = $bool->fetch_assoc()) {
            $response = $row;
        }

        return $response;
    }
}
