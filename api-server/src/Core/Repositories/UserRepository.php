<?php

namespace Moises\AutoCms\Core\Repositories;

use Moises\AutoCms\Core\Entities\User\User;

interface UserRepository
{
    public function all(): array;
    public function find(int $id): User;
    public function create(array $data): User;
    public function update(int $id, array $data): User;
    public function delete(int $id): bool;
}