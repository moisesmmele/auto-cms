<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Vehicle\FuelType;
use Moises\AutoCms\Core\Repositories\Vehicle\FuelTypeRepository;
use PDO;

class PdoFuelTypeRepository extends PdoRepository implements FuelTypeRepository
{

    public function create(array $data): FuelType
    {
        $sql = "INSERT INTO fuel_types (label) VALUES(:label)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function update(int $id, array $data): FuelType
    {
        $sql = "UPDATE fuel_types SET label = :label WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->find($id);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM fuel_types WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            return true;
        }
        return false;
    }

    public function all(): array
    {
        $sql = "SELECT * FROM fuel_types";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $fuelTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newFuelTypes = [];
        foreach ($fuelTypes as $fuelType) {
            $newFuelTypes[] = new FuelType(id: $fuelType['id'], label: $fuelType['label']);
        }
        return $newFuelTypes;
    }

    public function find(int $id): FuelType
    {
        $sql = "SELECT * FROM fuel_types WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $fuelType = $stmt->fetch(PDO::FETCH_ASSOC);
        return new FuelType(id: $id, label: $fuelType['label']);
    }
}