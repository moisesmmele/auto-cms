<?php

namespace Moises\AutoCms\Core\Repositories\Lead;

use Moises\AutoCms\Core\Entities\Lead\Lead;

interface LeadRepository
{
    public function all(): array;
    public function find(int $id): Lead;
    public function create(array $data): Lead;
    public function update(int $id, array $data): Lead;
    public function delete(int $id): bool;

}