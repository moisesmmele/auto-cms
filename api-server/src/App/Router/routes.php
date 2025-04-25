<?php

use Moises\AutoCms\App\App;

use Moises\AutoCms\App\Controllers\AuthController;
use Moises\AutoCms\App\Controllers\Images\ImageController;
use Moises\AutoCms\App\Controllers\Listings\ListingController;
use Moises\AutoCms\App\Controllers\User\UserController;
use Moises\AutoCms\App\Controllers\Vehicle\AccessoryController;
use Moises\AutoCms\App\Controllers\Vehicle\ChassisTypeController;
use Moises\AutoCms\App\Controllers\Vehicle\ColorController;
use Moises\AutoCms\App\Controllers\Vehicle\FuelTypeController;
use Moises\AutoCms\App\Controllers\Vehicle\GearboxTypeController;
use Moises\AutoCms\App\Controllers\Vehicle\MakeController;
use Moises\AutoCms\App\Controllers\Vehicle\VehicleController;
use Moises\AutoCms\App\Controllers\Vehicle\VehicleImageController;
use Moises\AutoCms\App\Middleware\AuthMiddleware;

//vehicles
App::router()->register('GET', '/vehicles', [VehicleController::class, 'index'])->middleware(AuthMiddleware::class);
App::router()->register('POST', '/vehicles', [VehicleController::class, 'store'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/vehicles/{id}', [VehicleController::class, 'show'])->middleware(AuthMiddleware::class);
App::router()->register('PUT', '/vehicles/{id}', [VehicleController::class, 'update'])->middleware(AuthMiddleware::class);
App::router()->register('DELETE', '/vehicles/{id}', [VehicleController::class, 'destroy'])->middleware(AuthMiddleware::class);

//Makes Resource
App::router()->register('GET', '/makes', [MakeController::class, 'index']);
App::router()->register('POST', '/makes', [MakeController::class, 'store'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/makes/{id}', [MakeController::class, 'show'])->middleware(AuthMiddleware::class);
App::router()->register('PUT', '/makes/{id}', [MakeController::class, 'update'])->middleware(AuthMiddleware::class);
App::router()->register('DELETE', '/makes/{id}', [MakeController::class, 'destroy'])->middleware(AuthMiddleware::class);

// Fuel Types
App::router()->register('GET', '/fuels', [FuelTypeController::class, 'index']);
App::router()->register('POST', '/fuels', [FuelTypeController::class, 'store'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/fuels/{id}', [FuelTypeController::class, 'show'])->middleware(AuthMiddleware::class);
App::router()->register('PUT', '/fuels/{id}', [FuelTypeController::class, 'update'])->middleware(AuthMiddleware::class);
App::router()->register('DELETE', '/fuels/{id}', [FuelTypeController::class, 'destroy'])->middleware(AuthMiddleware::class);

// Gearbox Types
App::router()->register('GET', '/gearboxes', [GearboxTypeController::class, 'index']);
App::router()->register('POST', '/gearboxes', [GearboxTypeController::class, 'store'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/gearboxes/{id}', [GearboxTypeController::class, 'show'])->middleware(AuthMiddleware::class);
App::router()->register('PUT', '/gearboxes/{id}', [GearboxTypeController::class, 'update'])->middleware(AuthMiddleware::class);
App::router()->register('DELETE', '/gearboxes/{id}', [GearboxTypeController::class, 'destroy'])->middleware(AuthMiddleware::class);

// Chassis Types
App::router()->register('GET', '/chassis', [ChassisTypeController::class, 'index']);
App::router()->register('POST', '/chassis', [ChassisTypeController::class, 'store'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/chassis/{id}', [ChassisTypeController::class, 'show'])->middleware(AuthMiddleware::class);
App::router()->register('PUT', '/chassis/{id}', [ChassisTypeController::class, 'update'])->middleware(AuthMiddleware::class);
App::router()->register('DELETE', '/chassis/{id}', [ChassisTypeController::class, 'destroy'])->middleware(AuthMiddleware::class);

// Colors
App::router()->register('GET', '/colors', [ColorController::class, 'index']);
App::router()->register('POST', '/colors', [ColorController::class, 'store'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/colors/{id}', [ColorController::class, 'show'])->middleware(AuthMiddleware::class);
App::router()->register('PUT', '/colors/{id}', [ColorController::class, 'update'])->middleware(AuthMiddleware::class);
App::router()->register('DELETE', '/colors/{id}', [ColorController::class, 'destroy'])->middleware(AuthMiddleware::class);

// Accessories
App::router()->register('GET', '/accessories', [AccessoryController::class, 'index']);
App::router()->register('POST', '/accessories', [AccessoryController::class, 'store'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/accessories/{id}', [AccessoryController::class, 'show'])->middleware(AuthMiddleware::class);
App::router()->register('PUT', '/accessories/{id}', [AccessoryController::class, 'update'])->middleware(AuthMiddleware::class);
App::router()->register('DELETE', '/accessories/{id}', [AccessoryController::class, 'destroy'])->middleware(AuthMiddleware::class);

// Listings
App::router()->register('GET', '/listings', [ListingController::class, 'index']);
App::router()->register('POST', '/listings', [ListingController::class, 'store'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/listings/{id}', [ListingController::class, 'show']);
App::router()->register('PUT', '/listings/{id}', [ListingController::class, 'update'])->middleware(AuthMiddleware::class);
App::router()->register('DELETE', '/listings/{id}', [ListingController::class, 'destroy'])->middleware(AuthMiddleware::class);

// Users
App::router()->register('GET', '/users', [UserController::class, 'index']);
App::router()->register('POST', '/users', [UserController::class, 'store'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/users/{id}', [UserController::class, 'show']);
App::router()->register('PUT', '/users/{id}', [UserController::class, 'update'])->middleware(AuthMiddleware::class);
App::router()->register('DELETE', '/users/{id}', [UserController::class, 'destroy'])->middleware(AuthMiddleware::class);

//images
App::router()->register('POST', '/images/upload', [ImageController::class, 'create'])->middleware(AuthMiddleware::class);
App::router()->register('GET', '/images/{category}/all', [ImageController::class, 'index']);
App::router()->register('GET', "/images/{url}", [ImageController::class, 'show']);
App::router()->register('DELETE', "/images/{id}", [ImageController::class, 'destroy'])->middleware(AuthMiddleware::class);

//login
App::router()->register('POST', "/auth/login", [AuthController::class, 'login']);
App::router()->register('POST', "/auth/logout", [AuthController::class, 'logout']);