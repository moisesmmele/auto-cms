<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Vehicle\Color;
use Moises\AutoCms\Core\Repositories\Vehicle\ColorRepository;
use PDO;

class PdoColorRepository extends PdoRepository implements ColorRepository
{

    public function create(array $data): Color
    {
        $sql = "INSERT INTO colors (label) VALUES (:label)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function update(int $id, array $data): Color
    {
        $sql = "UPDATE colors SET label = :label WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':label', $data['label']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM colors WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            return true;
        };
        return false;
    }

    public function all(): array
    {
        $sql = "SELECT * FROM colors";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $colors =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newColors = [];
        foreach ($colors as $color) {
            $newColors[] = new Color(id: $color['id'], label: $color['label']);
        }
        return $newColors;
    }

    public function find(int $id): Color
    {
        $sql = "SELECT * FROM colors WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $color = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Color(id: $color['id'], label: $color['label']);
    }
}