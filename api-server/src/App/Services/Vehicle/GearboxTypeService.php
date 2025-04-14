<?php

namespace Moises\AutoCms\App\Services\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Entities\Vehicle\GearboxType;
use Moises\AutoCms\Core\Repositories\Vehicle\GearboxTypeRepository;

class GearboxTypeService
{
    private GearboxTypeRepository $repository;

    public function __construct()
    {
        $this->repository = App::container()->get(GearboxTypeRepository::class);
    }

    public function getAllGearboxTypes(): array
    {
        return $this->repository->all();
    }

    public function getGearboxType(int $gearboxTypeId): GearboxType
    {
        return $this->repository->find($gearboxTypeId);
    }

    public function updateGearboxType(array $data, int $gearboxTypeId): GearboxType
    {
        return $this->repository->update(id: $gearboxTypeId, data: $data);
    }

    public function deleteGearboxType(int $gearboxTypeId): bool
    {
        return $this->repository->delete($gearboxTypeId);
    }

    public function createNewGearboxType(array $data): GearboxType
    {
        return $this->repository->create(data: $data);
    }
}
