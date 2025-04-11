<?php

namespace Moises\AutoCms\App\Services\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Entities\Vehicle\Make;
use Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository;
class MakeService
{
    private MakeRepository $repository;
    public function __construct()
    {
        $this->repository = App::container()->get(MakeRepository::class);
    }
    public function getAllMakes(): array
    {
        return $this->repository->all();
    }
    public function getMake(int $makeId): Make
    {
        return $this->repository->find($makeId);
    }
    public function updateMake(array $data, int $makeId): Make
    {
        return $this->repository->update(id: $makeId, data: $data);
    }
    public function deleteMake(int $makeId): bool
    {
        return $this->repository->delete($makeId);
    }
    public function createNewMake($data): Make
    {
        return $this->repository->create(data: $data);
    }
}