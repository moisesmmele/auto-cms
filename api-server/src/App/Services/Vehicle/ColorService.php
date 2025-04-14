<?php

namespace Moises\AutoCms\App\Services\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Entities\Vehicle\Color;
use Moises\AutoCms\Core\Repositories\Vehicle\ColorRepository;

class ColorService
{
    private ColorRepository $repository;

    public function __construct()
    {
        $this->repository = App::container()->get(ColorRepository::class);
    }

    public function getAllColors(): array
    {
        return $this->repository->all();
    }

    public function getColor(int $colorId): Color
    {
        return $this->repository->find($colorId);
    }

    public function updateColor(array $data, int $colorId): Color
    {
        return $this->repository->update(id: $colorId, data: $data);
    }

    public function deleteColor(int $colorId): bool
    {
        return $this->repository->delete($colorId);
    }

    public function createNewColor(array $data): Color
    {
        return $this->repository->create(data: $data);
    }
}
