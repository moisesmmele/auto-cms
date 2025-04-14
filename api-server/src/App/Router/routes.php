<?php

use Moises\AutoCms\App\App;

use Moises\AutoCms\App\Controllers\Vehicle\AccessoryController;
use Moises\AutoCms\App\Controllers\Vehicle\ChassisTypeController;
use Moises\AutoCms\App\Controllers\Vehicle\ColorController;
use Moises\AutoCms\App\Controllers\Vehicle\FuelTypeController;
use Moises\AutoCms\App\Controllers\Vehicle\GearboxTypeController;
use Moises\AutoCms\App\Controllers\Vehicle\MakeController;
use Moises\AutoCms\App\Controllers\Vehicle\VehicleController;
use Moises\AutoCms\App\Controllers\Vehicle\VehicleImageController;

App::router()->register('GET', '/vehicles', [VehicleController::class, 'index']);
App::router()->register('POST', '/vehicles', [VehicleController::class, 'store']);
App::router()->register('GET', '/vehicles/{id}', [VehicleController::class, 'show']);
App::router()->register('PUT', '/vehicles/{id}', [VehicleController::class, 'update']);
App::router()->register('DELETE', '/vehicles/{id}', [VehicleController::class, 'destroy']);

//Makes Resource
App::router()->register('GET', '/makes', [MakeController::class, 'index']);
App::router()->register('POST', '/makes', [MakeController::class, 'store']);
App::router()->register('GET', '/makes/{id}', [MakeController::class, 'show']);
App::router()->register('PUT', '/makes/{id}', [MakeController::class, 'update']);
App::router()->register('DELETE', '/makes/{id}', [MakeController::class, 'destroy']);

// Fuel Types
App::router()->register('GET', '/fuels', [FuelTypeController::class, 'index']);
App::router()->register('POST', '/fuels', [FuelTypeController::class, 'store']);
App::router()->register('GET', '/fuels/{id}', [FuelTypeController::class, 'show']);
App::router()->register('PUT', '/fuels/{id}', [FuelTypeController::class, 'update']);
App::router()->register('DELETE', '/fuels/{id}', [FuelTypeController::class, 'destroy']);

// Gearbox Types
App::router()->register('GET', '/gearboxes', [GearboxTypeController::class, 'index']);
App::router()->register('POST', '/gearboxes', [GearboxTypeController::class, 'store']);
App::router()->register('GET', '/gearboxes/{id}', [GearboxTypeController::class, 'show']);
App::router()->register('PUT', '/gearboxes/{id}', [GearboxTypeController::class, 'update']);
App::router()->register('DELETE', '/gearboxes/{id}', [GearboxTypeController::class, 'destroy']);

// Chassis Types
App::router()->register('GET', '/chassis', [ChassisTypeController::class, 'index']);
App::router()->register('POST', '/chassis', [ChassisTypeController::class, 'store']);
App::router()->register('GET', '/chassis/{id}', [ChassisTypeController::class, 'show']);
App::router()->register('PUT', '/chassis/{id}', [ChassisTypeController::class, 'update']);
App::router()->register('DELETE', '/chassis/{id}', [ChassisTypeController::class, 'destroy']);

// Colors
App::router()->register('GET', '/colors', [ColorController::class, 'index']);
App::router()->register('POST', '/colors', [ColorController::class, 'store']);
App::router()->register('GET', '/colors/{id}', [ColorController::class, 'show']);
App::router()->register('PUT', '/colors/{id}', [ColorController::class, 'update']);
App::router()->register('DELETE', '/colors/{id}', [ColorController::class, 'destroy']);

// Accessories
App::router()->register('GET', '/accessories', [AccessoryController::class, 'index']);
App::router()->register('POST', '/accessories', [AccessoryController::class, 'store']);
App::router()->register('GET', '/accessories/{id}', [AccessoryController::class, 'show']);
App::router()->register('PUT', '/accessories/{id}', [AccessoryController::class, 'update']);
App::router()->register('DELETE', '/accessories/{id}', [AccessoryController::class, 'destroy']);

// Vehicle Images
App::router()->register('GET', '/vehicle-images', [VehicleImageController::class, 'index']);
App::router()->register('POST', '/vehicle-images', [VehicleImageController::class, 'store']);
App::router()->register('GET', '/vehicle-images/{id}', [VehicleImageController::class, 'show']);
App::router()->register('DELETE', '/vehicle-images/{id}', [VehicleImageController::class, 'destroy']);
App::router()->register('GET', '/vehicles/{vehicleId}/images', [VehicleImageController::class, 'getByVehicle']);
