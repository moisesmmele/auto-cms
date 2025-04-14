<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

use Moises\AutoCms\Core\Entities\Vehicle\Color;

interface ColorRepository
{
    public function all(): array;
    public function find(int $id): Color;
    public function create(array $data): Color;
    public function update(int $id, array $data): Color;
    public function delete(int $id): bool;
}