<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

use Moises\AutoCms\Core\Entities\Vehicle\Vehicle;
use Moises\AutoCms\Core\Repositories\Repository;

interface VehicleRepository
{
    public function all(): array;
    public function find(int $id): Vehicle;
    public function create(array $data): Vehicle;
    public function update(int $id, array $data): Vehicle;
    public function delete(int $id): bool;
    public function findImages($vehicleId): array;
    public function findAccessories($vehicleId): array;
}