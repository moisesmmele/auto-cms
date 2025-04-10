<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

use Moises\AutoCms\Core\Entities\Vehicle\Make;

interface MakeRepository
{
    public function all(): array;
    public function find(int $id): Make;
    public function create(array $data): Make;
    public function update(int $id, array $data): Make;
    public function delete(int $id): bool;
}