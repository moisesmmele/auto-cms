<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository;
use PDO;

class PdoMakeRepository extends PdoRepository implements MakeRepository
{
    public function find(int $id): array
    {
        $sql = "SELECT * FROM makes where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function all(): array
    {
        $sql = "SELECT * FROM makes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(array $data): array
    {
        $sql = "INSERT INTO makes (label) VALUES (:label)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":label", $data["label"]);
        $result = $stmt->execute();
        return ["result" => $result];
    }
    public function update(int $id, array $data): array
    {
        $sql = "UPDATE makes SET label = :label WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":label", $data["label"]);
        $result = $stmt->execute();
        return ["result" => $result];
    }
    public function delete(int $id): array
    {
        $sql = "DELETE FROM makes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $result = $stmt->execute();
        return ["result" => $result];
    }
}