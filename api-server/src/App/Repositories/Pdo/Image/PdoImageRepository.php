<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Image;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;

class PdoImageRepository extends PdoRepository
{
    public function insert(string $name, string $extension, int $width, int $height)
    {
        $sql = "INSERT INTO images (name, extension, width, height) VALUES (:name, :extension, :width, :height)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':extension', $extension);
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':height', $height);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function all()
    {
        $sql = "SELECT * FROM images";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $images;
    }
}