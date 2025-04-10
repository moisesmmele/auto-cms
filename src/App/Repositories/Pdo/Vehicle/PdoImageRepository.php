<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Vehicle\Image;
use Moises\AutoCms\Core\Repositories\Vehicle\ImageRepository;
use PDO;

class PdoImageRepository extends PdoRepository implements ImageRepository
{

    public function create(array $data): Image
    {
        $sql = "insert into images (label, uri) values (:label, :uri)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->bindParam(':uri', $data['uri']);
        $stmt->execute();
        return $this->find($data['id']);
    }

    public function update(int $id, array $data): Image
    {
        $sql = "update images set label = :label, uri = :uri where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':label', $data['label']);
        $stmt->bindParam(':uri', $data['uri']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->find($data['id']);
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
            $newImages[] = new Image(id: $image['id'], label: $image['label'], uri: $image['uri']);
        }
        return $newImages;
    }

    public function find(int $id): Image
    {
        $sql = "select * from images where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Image(id: $image['id'], label: $image['label'], uri: $image['uri']);
    }
}