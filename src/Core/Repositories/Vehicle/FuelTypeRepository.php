<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

use Moises\AutoCms\Core\Entities\Vehicle\FuelType;

interface FuelTypeRepository
{
    public function all(): array;
    public function find(int $id): FuelType;
    public function create(array $data): FuelType;
    public function update(int $id, array $data): FuelType;
    public function delete(int $id): bool;
}