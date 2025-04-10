<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Vehicle\ChassisType;
use Moises\AutoCms\Core\Repositories\Vehicle\ChassisTypeRepository;
use PDO;

class PdoChassisTypeRepository extends PdoRepository implements ChassisTypeRepository
{

    public function create(array $data): ChassisType
    {
        $sql = "INSERT INTO chassis_types (label) VALUES (:label)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function update(int $id, array $data): ChassisType
    {
        $sql = "UPDATE chassis_type SET label = :label WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':label', $data['label']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM chassis_type WHERE id = :id";
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
        $sql = "SELECT * FROM chassis_type";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $chassisTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newChassisTypes = [];
        foreach ($chassisTypes as $chassisType) {
            $newChassisTypes[] = new ChassisType(id: $chassisType['id'], label: $chassisType['label']);
        }
        return $newChassisTypes;
    }

    public function find(int $id): ChassisType
    {
        $sql = "SELECT * FROM chassis_types WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $chassisType = $stmt->fetch(PDO::FETCH_ASSOC);
        return new ChassisType(id: $chassisType['id'], label: $chassisType['label']);
    }
}