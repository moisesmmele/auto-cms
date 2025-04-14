<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

use Moises\AutoCms\Core\Entities\Vehicle\VehicleImage;

interface VehicleImageRepository
{
    public function all(): array;
    public function find(int $id): VehicleImage;
    public function create(array $data): VehicleImage;
    public function update(int $id, array $data): VehicleImage;
    public function delete(int $id): bool;
}