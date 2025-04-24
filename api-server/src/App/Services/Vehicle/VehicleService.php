<?php

namespace Moises\AutoCms\App\Services\Vehicle;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Entities\Vehicle\Vehicle;
use Moises\AutoCms\Core\Repositories\ImageRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\AccessoryRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\ChassisTypeRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\ColorRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\FuelTypeRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\GearboxTypeRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\VehicleImageRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\VehicleRepository;


class VehicleService
{
    readonly VehicleRepository $vehicleRepository;
    readonly MakeRepository $makeRepository;
    readonly GearboxTypeRepository $gearboxTypeRepository;
    readonly FuelTypeRepository $fuelTypeRepository;
    readonly ChassisTypeRepository $chassisTypeRepository;
    readonly ColorRepository $colorRepository;
    readonly ImageRepository $imageRepository;
    readonly AccessoryRepository $accessoryRepository;

    public function __construct()
    {
        $this->vehicleRepository = App::container()->get(VehicleRepository::class);
        $this->makeRepository = App::container()->get(MakeRepository::class);
        $this->gearboxTypeRepository = App::container()->get(GearboxTypeRepository::class);
        $this->fuelTypeRepository = App::container()->get(FuelTypeRepository::class);
        $this->chassisTypeRepository = App::container()->get(ChassisTypeRepository::class);
        $this->colorRepository = App::container()->get(ColorRepository::class);
        $this->imageRepository = App::container()->get(ImageRepository::class);
        $this->accessoryRepository = App::container()->get(AccessoryRepository::class);
    }

    public function getAllVehicles(): array
    {
        $vehicles = $this->vehicleRepository->all();
        $newVehicles = [];

        foreach ($vehicles as $vehicle) {
            $vehicle->assignMake($this->makeRepository->find($vehicle->getMakeId()))
                ->assignColor($this->colorRepository->find($vehicle->getColorId()))
                ->assignFuelType($this->fuelTypeRepository->find($vehicle->getFuelTypeId()))
                ->assignGearboxType($this->gearboxTypeRepository->find($vehicle->getGearboxTypeId()))
                ->assignChassisType($this->chassisTypeRepository->find($vehicle->getChassisTypeId()));

            foreach ($vehicle->getAccessoriesIds() as $accessoryId) {
                $accessory = $this->accessoryRepository->find($accessoryId);
                $vehicle->assignAccessory($accessory);
            }

            foreach ($vehicle->getImagesIds() as $imageId) {
                $image = $this->imageRepository->findById($imageId);
                $vehicle->assignVehicleImage($image);
            }
            $newVehicles[] = $vehicle;
        }
        return $newVehicles;
    }

    public function getVehicle(int $id): Vehicle
    {
        $vehicle = $this->vehicleRepository->find($id);

        $vehicle->assignMake($this->makeRepository->find($vehicle->getMakeId()))
            ->assignColor($this->colorRepository->find($vehicle->getColorId()))
            ->assignFuelType($this->fuelTypeRepository->find($vehicle->getFuelTypeId()))
            ->assignGearboxType($this->gearboxTypeRepository->find($vehicle->getGearboxTypeId()))
            ->assignChassisType($this->chassisTypeRepository->find($vehicle->getChassisTypeId()));

        foreach ($vehicle->getAccessoriesIds() as $accessoryId) {
            $accessory = $this->accessoryRepository->find($accessoryId);
            $vehicle->assignAccessory($accessory);
        }

        foreach ($vehicle->getImagesIds() as $imageId) {
            $image = $this->imageRepository->findById($imageId);
            $vehicle->assignVehicleImage($image);
        }
        return $vehicle;
    }

    public function updateVehicle(int $id, array $data): Vehicle
    {
        $vehicle = $this->vehicleRepository->update(id: $id, data: $data);

        $vehicle->assignMake($this->makeRepository->find($vehicle->getMakeId()))
            ->assignColor($this->colorRepository->find($vehicle->getColorId()))
            ->assignFuelType($this->fuelTypeRepository->find($vehicle->getFuelTypeId()))
            ->assignGearboxType($this->gearboxTypeRepository->find($vehicle->getGearboxTypeId()))
            ->assignChassisType($this->chassisTypeRepository->find($vehicle->getChassisTypeId()));

        foreach ($vehicle->getAccessoriesIds() as $accessoryId) {
            $accessory = $this->accessoryRepository->find($accessoryId);
            $vehicle->assignAccessory($accessory);
        }

        foreach ($vehicle->getImagesIds() as $imageId) {
            $image = $this->imageRepository->findById($imageId);
            $vehicle->assignVehicleImage($image);
        }

        return $vehicle;
    }

    public function deleteVehicle(int $id): bool
    {
        return $this->vehicleRepository->delete($id);
    }

    public function createNewVehicle(array $data)
    {
        $vehicle = $this->vehicleRepository->create(data: $data);
        $vehicle->assignMake($this->makeRepository->find($vehicle->getMakeId()))
            ->assignColor($this->colorRepository->find($vehicle->getColorId()))
            ->assignFuelType($this->fuelTypeRepository->find($vehicle->getFuelTypeId()))
            ->assignGearboxType($this->gearboxTypeRepository->find($vehicle->getGearboxTypeId()))
            ->assignChassisType($this->chassisTypeRepository->find($vehicle->getChassisTypeId()));

        foreach ($vehicle->getAccessoriesIds() as $accessoryId) {
            $accessory = $this->accessoryRepository->find($accessoryId);
            $vehicle->assignAccessory($accessory);
        }

        foreach ($vehicle->getImagesIds() as $imageId) {
            $image = $this->imageRepository->findById($imageId);
            $vehicle->assignVehicleImage($image);
        }
        return $vehicle;
    }
}