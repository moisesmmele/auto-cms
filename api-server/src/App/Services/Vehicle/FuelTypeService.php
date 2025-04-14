<?php

namespace Moises\AutoCms\App\Services\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Entities\Vehicle\FuelType;
use Moises\AutoCms\Core\Repositories\Vehicle\FuelTypeRepository;

class FuelTypeService
{
    private FuelTypeRepository $repository;

    public function __construct()
    {
        $this->repository = App::container()->get(FuelTypeRepository::class);
    }

    public function getAllFuelTypes(): array
    {
        return $this->repository->all();
    }

    public function getFuelType(int $fuelTypeId): FuelType
    {
        return $this->repository->find($fuelTypeId);
    }

    public function updateFuelType(array $data, int $fuelTypeId): FuelType
    {
        return $this->repository->update(id: $fuelTypeId, data: $data);
    }

    public function deleteFuelType(int $fuelTypeId): bool
    {
        return $this->repository->delete($fuelTypeId);
    }

    public function createNewFuelType(array $data): FuelType
    {
        return $this->repository->create(data: $data);
    }
}
