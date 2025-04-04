<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository;

class MakeController extends Controller
{
    private MakeRepository $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = App::container()->get(MakeRepository::class);
    }

    public function index()
    {
        $vehicles = $this->repository->all();
        echo json_encode($vehicles);
    }

    public function show($id)
    {
        $vehicle = $this->repository->find($id);
        echo json_encode($vehicle);
    }
    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->repository->create($data);
        echo json_encode($result);
    }

    public function update($id)
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->repository->update($id, $data);
        echo json_encode($result);
    }
    public function destroy($id)
    {
        $result = $this->repository->delete($id);
        echo json_encode($result);
    }
}