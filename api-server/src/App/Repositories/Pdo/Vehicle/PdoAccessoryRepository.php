<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Vehicle\Accessory;
use Moises\AutoCms\Core\Repositories\Vehicle\AccessoryRepository;
use PDO;

class PdoAccessoryRepository extends PdoRepository implements AccessoryRepository
{

    public function create(array $data): Accessory
    {
        $sql = "insert into accessories (label) values (:label)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function update(int $id, array $data): Accessory
    {
        $sql = "update accessories set label = :label where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':label', $data['label']);
        $stmt->execute();
        return $this->find($id);
    }

    public function delete(int $id): bool
    {
        $sql = "delete from accessories where  id = :id";
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
        $sql = "select * from accessories";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $accessories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newAccessories = [];
        foreach ($accessories as $accessory) {
            $newAccessories[] = new Accessory(id: $accessory['id'], label: $accessory['label']);
        }
        return $newAccessories;
    }

    public function find(int $id): Accessory
    {
        $sql = "select * from accessories where  id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $accessory = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$accessory) {
            throw new \Exception("Accessory not found for ID: $id");
        }
        return new Accessory(id: $accessory['id'], label: $accessory['label']);
    }
}