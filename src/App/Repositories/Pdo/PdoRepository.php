<?php

namespace Moises\AutoCms\App\Repositories\Pdo;

use Moises\AutoCms\App\App;

class PdoRepository
{
    protected \PDO $pdo;
    public function __construct()
    {
        $this->pdo = App::database()->getConnection();
    }
}