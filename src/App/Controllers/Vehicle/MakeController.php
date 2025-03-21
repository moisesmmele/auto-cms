<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository;

class MakeController
{
    private MakeRepository $repository;

    public function __construct()
    {
        $this->repository = App::container()->get(MakeRepository::class);
    }

    public function index()
    {
        $vehicles = $this->repository->all();
        echo json_encode($vehicles);
    }

    public function store()
    {

    }
}