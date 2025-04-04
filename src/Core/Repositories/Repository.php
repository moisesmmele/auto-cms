<?php

namespace Moises\AutoCms\Core\Repositories;

interface Repository
{
    public function create(array $data): array;
    public function update(int $id, array $data): array;
    public function delete(int $id): array;
    public function all(): array;
    public function find(int $id): array;
}