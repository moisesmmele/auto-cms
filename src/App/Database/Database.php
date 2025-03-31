<?php

namespace Moises\AutoCms\App\Database;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;

class Database
{
    private $connection;
    public function __construct()
    {
        $conn_params = [
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD']
        ];

        $this->connection = DriverManager::getConnection($conn_params);
    }

    public function getConnection(): Connection
    {
        return $this->connection;
    }
}