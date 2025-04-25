<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\Vehicle\MakeService;

class MakeController extends Controller
{
    private MakeService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = App::container()->get(MakeService::class);
    }

    public function index()
    {
        $makes = $this->service->getAllMakes();
        echo json_encode($makes);
    }

    public function show($id)
    {
        $make = $this->service->getMake($id);
        echo json_encode($make);
    }
    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->createNewMake($data);
        echo json_encode($result);
    }

    public function update($id)
    {
        error_log('hit MakeController::update()');
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->updateMake(data: $data, makeId: $id);
        echo json_encode($result);
    }
    public function destroy($id)
    {
        $result = $this->service->deleteMake($id);
        echo json_encode($result);
    }
}