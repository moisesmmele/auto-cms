<?php

namespace Moises\AutoCms\Core\Repositories\Vehicle;

interface VehicleRepository
{
    public function all();
    public function find($id);
    public function create(array $data);
}