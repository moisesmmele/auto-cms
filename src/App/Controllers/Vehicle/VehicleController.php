<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\Vehicle\VehicleService;

class VehicleController extends Controller
{
    private VehicleService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = App::container()->get(VehicleService::class);
    }

    public function index()
    {
        $vehicles = $this->service->getAllVehicles();
        $response = [
            'vehicles' => []
            ];
        foreach ($vehicles as $vehicle) {
            $response['vehicles'][] = [
                'id' => $vehicle->getId(),
                'vin' => $vehicle->getVin(),
                'license_plate' => $vehicle->getLicensePlate(),
                'make' => $vehicle->getMake()->getLabel(),
                'model' => $vehicle->getModel(),
                'modelYear' => $vehicle->getModelYear(),
                'color' => $vehicle->getColor()->getLabel(),
                'transmission' => $vehicle->getGearboxType()->getLabel(),
                'chassis' => $vehicle->getChassisType()->getLabel(),
                'fuel' => $vehicle->getFuelType()->getLabel(),
                'mileage' => $vehicle->getMileage(),
                'description' => $vehicle->getDescription(),
                'accessories' => [],
                'images' => [],
            ];
        }
        echo json_encode($response);
    }

    public function show($id)
    {
        $vehicle = $this->service->getVehicle($id);
        echo json_encode($vehicle);
    }

    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->createNewVehicle($data);
        echo json_encode($result);
    }

    public function update($id)
    {
        $data = json_decode(App::request()->getContent(), true);
        $result = $this->service->updateVehicle(id: $id, data: $data);
        echo json_encode($result);
    }

    public function destroy($id)
    {
        $result = $this->service->deleteVehicle($id);
        echo json_encode($result);
    }
}
