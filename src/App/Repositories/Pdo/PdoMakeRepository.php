<?php

namespace Moises\AutoCms\App\Repositories\Pdo;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository;
use PDO;

class PdoMakeRepository implements MakeRepository
{

    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = App::pdo();
    }
    public function find(string $id)
    {
        $sql = "SELECT * FROM makes where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all()
    {
        $sql = "SELECT * FROM makes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }
}