<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

use Moises\AutoCms\Core\Entities\Vehicle\GearboxType;

interface GearboxTypeRepository
{
    public function all(): array;
    public function find(int $id): GearboxType;
    public function create(array $data): GearboxType;
    public function update(int $id, array $data): GearboxType;
    public function delete(int $id): bool;
}