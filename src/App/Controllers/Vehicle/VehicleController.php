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
        $this->service = new VehicleService();
    }
    public function index()
    {
        $vehicles = $this->service->getAllVehicles();
        dump($vehicles);
    }
}