<?php

namespace Moises\AutoCms\App\Services\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Entities\Vehicle\ChassisType;
use Moises\AutoCms\Core\Repositories\Vehicle\ChassisTypeRepository;

class ChassisTypeService
{
    private ChassisTypeRepository $repository;

    public function __construct()
    {
        $this->repository = App::container()->get(ChassisTypeRepository::class);
    }

    public function getAllChassisTypes(): array
    {
        return $this->repository->all();
    }

    public function getChassisType(int $chassisTypeId): ChassisType
    {
        return $this->repository->find($chassisTypeId);
    }

    public function updateChassisType(array $data, int $chassisTypeId): ChassisType
    {
        return $this->repository->update(id: $chassisTypeId, data: $data);
    }

    public function deleteChassisType(int $chassisTypeId): bool
    {
        return $this->repository->delete($chassisTypeId);
    }

    public function createNewChassisType(array $data): ChassisType
    {
        return $this->repository->create(data: $data);
    }
}
