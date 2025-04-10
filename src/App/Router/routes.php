<?php

use Moises\AutoCms\App\App;

use Moises\AutoCms\App\Controllers\TestController;
use Moises\AutoCms\App\Controllers\Vehicle\ColorsController;
use Moises\AutoCms\App\Controllers\Vehicle\MakeController;
use Moises\AutoCms\App\Controllers\Vehicle\VehicleController;

App::router()->register('GET', '/test', [TestController::class, 'index']);

//Makes Resource
App::router()->register('GET', '/makes', [MakeController::class, 'index']);
App::router()->register('POST', '/makes', [MakeController::class, 'store']);
App::router()->register('GET', '/makes/{id}', [MakeController::class, 'show']);
App::router()->register('PUT', '/makes/{id}', [MakeController::class, 'update']);
App::router()->register('DELETE', '/makes/{id}', [MakeController::class, 'destroy']);


App::router()->register('GET', '/colors', [ColorsController::class, 'index']);
App::router()->register('POST', '/colors', [ColorsController::class, 'create']);
App::router()->register('GET', '/colors/{id}', [ColorsController::class, 'show']);
App::router()->register('GET', '/testing', [TestController::class, 'testing']);
App::router()->register('POST', '/testing', [TestController::class, 'testing']);

App::router()->register('GET', '/vehicles', [VehicleController::class, 'index']);