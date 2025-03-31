<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

interface ColorsRepository
{
    public function all();
    public function find(int $id);
    public function create(array $data);
}