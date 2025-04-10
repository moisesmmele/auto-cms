<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

use Moises\AutoCms\Core\Entities\Vehicle\ChassisType;

interface ChassisTypeRepository
{
    public function all(): array;
    public function find(int $id): ChassisType;
    public function create(array $data): ChassisType;
    public function update(int $id, array $data): ChassisType;
    public function delete(int $id): bool;
}