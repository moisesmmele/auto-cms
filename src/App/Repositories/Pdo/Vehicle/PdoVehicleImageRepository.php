<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Vehicle\VehicleImage;
use Moises\AutoCms\Core\Repositories\Vehicle\VehicleImageRepository;
use PDO;

class PdoVehicleImageRepository extends PdoRepository implements VehicleImageRepository
{

    public function create(array $data): VehicleImage
    {
        $sql = "insert into images (label, uri) values (:label, :uri)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->bindParam(':uri', $data['uri']);
        $stmt->execute();
        return $this->find($data['id']);
    }

    public function update(int $id, array $data): VehicleImage
    {
        $sql = "update images set label = :label, uri = :uri where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->bindParam(':uri', $data['uri']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->find($id);
    }
    public function delete(int $id): bool
    {
        $sql = "delete from images where id = :id";
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
        $sql = "select * from images";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newImages = [];
        foreach ($images as $image) {
            $newImages[] = new VehicleImage(id: $image['id'], label: $image['label'], uri: $image['uri']);
        }
        return $newImages;
    }

    public function find(int $id): VehicleImage
    {
        $sql = "select * from images where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$image) {
            throw new \Exception("Image not found");
        }
        return new VehicleImage(id: $image['id'], label: $image['label'], uri: $image['uri']);
    }
}