<?php

declare(strict_types=1);

use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoAccessoryRepository;
use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoChassisTypeRepository;
use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoColorRepository;
use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoFuelTypeRepository;
use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoGearboxTypeRepository;
use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoVehicleImageRepository;
use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoMakeRepository;
use Moises\AutoCms\App\Repositories\Pdo\Vehicle\PdoVehicleRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\AccessoryRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\ChassisTypeRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\ColorRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\FuelTypeRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\GearboxTypeRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\VehicleImageRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\VehicleRepository;

return [
    AccessoryRepository::class => PdoAccessoryRepository::class,
    ChassisTypeRepository::class => PdoChassisTypeRepository::class,
    ColorRepository::class => PdoColorRepository::class,
    FuelTypeRepository::class => PdoFuelTypeRepository::class,
    GearboxTypeRepository::class => PdoGearboxTypeRepository::class,
    VehicleImageRepository::class => PdoVehicleImageRepository::class,
    MakeRepository::class => PdoMakeRepository::class,
    VehicleRepository::class => PdoVehicleRepository::class,
    ];