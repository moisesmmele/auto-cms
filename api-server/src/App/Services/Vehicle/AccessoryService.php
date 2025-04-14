<?php

namespace Moises\AutoCms\App\Services\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Entities\Vehicle\Accessory;
use Moises\AutoCms\Core\Repositories\Vehicle\AccessoryRepository;

class AccessoryService
{
    private AccessoryRepository $repository;

    public function __construct()
    {
        $this->repository = App::container()->get(AccessoryRepository::class);
    }

    public function getAllAccessories(): array
    {
        return $this->repository->all();
    }

    public function getAccessory(int $accessoryId): Accessory
    {
        return $this->repository->find($accessoryId);
    }

    public function updateAccessory(array $data, int $accessoryId): Accessory
    {
        return $this->repository->update(id: $accessoryId, data: $data);
    }

    public function deleteAccessory(int $accessoryId): bool
    {
        return $this->repository->delete($accessoryId);
    }

    public function createNewAccessory(array $data): Accessory
    {
        return $this->repository->create(data: $data);
    }
}
