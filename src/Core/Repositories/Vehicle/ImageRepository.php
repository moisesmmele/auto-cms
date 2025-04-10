<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

use Moises\AutoCms\Core\Entities\Vehicle\Image;

interface ImageRepository
{
    public function all(): array;
    public function find(int $id): Image;
    public function create(array $data): Image;
    public function update(int $id, array $data): Image;
    public function delete(int $id): bool;
}