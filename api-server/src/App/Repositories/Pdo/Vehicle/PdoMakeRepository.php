<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Vehicle\Make;
use Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository;
use PDO;

class PdoMakeRepository extends PdoRepository implements MakeRepository
{
    public function find(int $id): Make
    {
        $sql = "SELECT * FROM makes where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $make = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Make($make['id'], $make['label']);
    }
    public function all(): array
    {
        $sql = "SELECT * FROM makes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $makes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newMakes = [];
        foreach ($makes as $make) {
            $newMakes[] = new Make($make['id'], $make['label']);
        }
        return $newMakes;
    }
    public function create(array $data): Make
    {
        $sql = "INSERT INTO makes (label) VALUES (:label)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":label", $data["label"]);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }
    public function update(int $id, array $data): Make
    {
        $sql = "UPDATE makes SET label = :label WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":label", $data["label"]);
        $stmt->execute();
        return $this->find($id);
    }
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM makes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
}