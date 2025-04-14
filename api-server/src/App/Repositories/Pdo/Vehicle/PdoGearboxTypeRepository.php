<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Vehicle\GearboxType;
use Moises\AutoCms\Core\Repositories\Vehicle\GearboxTypeRepository;
use PDO;

class PdoGearboxTypeRepository extends PdoRepository implements GearboxTypeRepository
{

    public function create(array $data): GearboxType
    {
        $sql = "insert into gearbox_types (label) values (:label)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function update(int $id, array $data): GearboxType
    {
        $sql = "update gearbox_types set label = :label where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':label', $data['label']);
        $stmt->execute();
        return $this->find($id);
    }

    public function delete(int $id): bool
    {
        $sql = "delete from gearbox_types where id = :id";
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
        $sql = "select * from gearbox_types";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $gearboxTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newGearboxTypes = [];
        foreach ($gearboxTypes as $gearboxType) {
            $newGearboxTypes[] = new GearboxType(id: $gearboxType['id'], label: $gearboxType['label']);
        }
        return $newGearboxTypes;
    }

    public function find(int $id): GearboxType
    {
        $sql = "select * from gearbox_types where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $gearboxType = $stmt->fetch(PDO::FETCH_ASSOC);
        return new GearboxType(id: $gearboxType['id'], label: $gearboxType['label']);
    }
}