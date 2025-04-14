<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\Vehicle\GearboxTypeService;

class GearboxTypeController extends Controller
{
    private GearboxTypeService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = App::container()->get(GearboxTypeService::class);
    }

    public function index()
    {
        $gearboxes = $this->service->getAllGearboxTypes();
        echo json_encode($gearboxes);
    }

    public function show($id)
    {
        $gearbox = $this->service->getGearboxType($id);
        echo json_encode($gearbox);
    }

    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->createNewGearboxType($data);
        echo json_encode($result);
    }

    public function update($id)
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->updateGearboxType(data: $data, gearboxTypeId: $id);
        echo json_encode($result);
    }

    public function destroy($id)
    {
        $result = $this->service->deleteGearboxType($id);
        echo json_encode($result);
    }
}
