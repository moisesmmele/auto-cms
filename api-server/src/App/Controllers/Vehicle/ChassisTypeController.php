<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\Vehicle\ChassisTypeService;

class ChassisTypeController extends Controller
{
    private ChassisTypeService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = App::container()->get(ChassisTypeService::class);
    }

    public function index()
    {
        $chassisTypes = $this->service->getAllChassisTypes();
        echo json_encode($chassisTypes);
    }

    public function show($id)
    {
        $chassisType = $this->service->getChassisType($id);
        echo json_encode($chassisType);
    }

    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->createNewChassisType($data);
        echo json_encode($result);
    }

    public function update($id)
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->updateChassisType(data: $data, chassisTypeId: $id);
        echo json_encode($result);
    }

    public function destroy($id)
    {
        $result = $this->service->deleteChassisType($id);
        echo json_encode($result);
    }
}
