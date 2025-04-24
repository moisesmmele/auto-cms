<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Image;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Image\Image;
use Moises\AutoCms\Core\Repositories\ImageRepository;

class PdoImageRepository extends PdoRepository implements ImageRepository
{
    public function create($data): Image
    {
        $sql = "INSERT INTO images (name, extension, width, height, category) VALUES (:name, :extension, :width, :height, :category)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':extension', $data['extension']);
        $stmt->bindParam(':width', $data['width']);
        $stmt->bindParam(':height', $data['height']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->execute();
        return $this->findById($this->pdo->lastInsertId());
    }

    public function findById(int $id): Image
    {
        $sql = "SELECT * FROM images where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $imageData = $stmt->fetch(\PDO::FETCH_ASSOC);
        $image = new Image();
        $image->setId($imageData['id']);
        $image->setName($imageData['name']);
        $image->setExtension($imageData['extension']);
        $image->setWidth($imageData['width']);
        $image->setHeight($imageData['height']);
        $image->setCategory($imageData['category']);
        return $image;
    }

    public function findByCategory(string $category): array
    {
        $sql = "SELECT * FROM images WHERE category = :category";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        $images = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $newImages = [];
        foreach ($images as $image) {
            $newImages[] = $this->findById($image['id']);
        }
        return $newImages;
    }
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM images where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            return true;
        }
        return false;
    }
}