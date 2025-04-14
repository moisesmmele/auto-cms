<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\Vehicle\FuelTypeService;

class FuelTypeController extends Controller
{
    private FuelTypeService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = App::container()->get(FuelTypeService::class);
    }

    public function index()
    {
        $fuels = $this->service->getAllFuelTypes();
        echo json_encode($fuels);
    }

    public function show($id)
    {
        $fuel = $this->service->getFuelType($id);
        echo json_encode($fuel);
    }

    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->createNewFuelType($data);
        echo json_encode($result);
    }

    public function update($id)
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->updateFuelType(data: $data, fuelTypeId: $id);
        echo json_encode($result);
    }

    public function destroy($id)
    {
        $result = $this->service->deleteFuelType($id);
        echo json_encode($result);
    }
}
