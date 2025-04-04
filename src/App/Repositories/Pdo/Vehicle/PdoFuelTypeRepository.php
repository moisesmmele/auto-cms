<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\FuelTypeRepository;
use PDO;

class PdoFuelTypeRepository extends PdoRepository implements FuelTypeRepository
{

    public function create(array $data): array
    {
        $sql = "INSERT INTO fuel_types (label) VALUES(:label)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function update(int $id, array $data): array
    {
        $sql = "UPDATE fuel_types SET label = :label WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function delete(int $id): array
    {
        $sql = "DELETE FROM fuel_types WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function all(): array
    {
        $sql = "SELECT * FROM fuel_types";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array
    {
        $sql = "SELECT * FROM fuel_types WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}