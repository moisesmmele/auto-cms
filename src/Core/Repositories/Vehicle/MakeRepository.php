<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

interface MakeRepository
{
    public function find(string $id);
    public function all();
    public function create(array $data);
}