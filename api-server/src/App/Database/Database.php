<?php

namespace Moises\AutoCms\App\Database;

use PDO;

class Database
{
    private $connection;
    public function __construct()
    {
        $this->connection = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}