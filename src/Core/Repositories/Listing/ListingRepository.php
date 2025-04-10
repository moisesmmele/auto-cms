<?php

namespace Moises\AutoCms\Core\Repositories\Listing;
use Moises\AutoCms\Core\Entities\Listing\Listing;

interface ListingRepository
{
    public function all(): array;
    public function find(int $id): Listing;
    public function create(array $data): Listing;
    public function update(int $id, array $data): Listing;
    public function delete(int $id): bool;
}