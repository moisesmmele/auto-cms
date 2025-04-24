<?php

namespace Moises\AutoCms\Core\Repositories;

use Moises\AutoCms\Core\Entities\Image\Image;

interface ImageRepository
{
    public function findByCategory(string $category): array;

    public function findById(int $id): Image;
    public function create(array $data): Image;
    public function delete(int $id): bool;
}