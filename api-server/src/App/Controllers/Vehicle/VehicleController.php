<?php

namespace Moises\AutoCms\App\Controllers\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Dtos\VehicleResponseDto;
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
            $response['vehicles'][] = VehicleResponseDto::fromEntity($vehicle);
        }
        echo json_encode($response);
    }

    public function show($id)
    {
        $vehicle = $this->service->getVehicle($id);
        echo json_encode(VehicleResponseDto::fromEntity($vehicle));
    }

    public function store()
    {
        $data = json_decode(App::request()->getContent(), true);
        $vehicle = ($this->service->createNewVehicle($data));
        echo json_encode(VehicleResponseDto::fromEntity($vehicle));
    }

    public function update($id)
    {
        $data = json_decode(App::request()->getContent(), true);
        $vehicle = $this->service->updateVehicle(id: $id, data: $data);
        echo json_encode(VehicleResponseDto::fromEntity($vehicle));
    }

    public function destroy($id)
    {
        $result = $this->service->deleteVehicle($id);
        echo json_encode($result);
    }
}
