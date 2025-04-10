<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

use Moises\AutoCms\Core\Entities\Vehicle\Accessory;

interface AccessoryRepository
{
    public function all(): array;
    public function find(int $id): Accessory;
    public function create(array $data): Accessory;
    public function update(int $id, array $data): Accessory;
    public function delete(int $id): bool;
}