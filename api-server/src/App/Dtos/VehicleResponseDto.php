<?php

namespace Moises\AutoCms\App\Dtos;

use Moises\AutoCms\Core\Entities\Vehicle\Vehicle;

class VehicleResponseDto
{
    public static function fromEntity(Vehicle $vehicle): array
    {
        $response = [
            'id' => $vehicle->getId(),
            'vin' => $vehicle->getVin(),
            'license_plate' => $vehicle->getLicensePlate(),
            'make' => $vehicle->getMake()->getLabel(),
            'model' => $vehicle->getModel(),
            'model_year' => $vehicle->getModelYear(),
            'color' => $vehicle->getColor()->getLabel(),
            'transmission' => $vehicle->getGearboxType()->getLabel(),
            'chassis' => $vehicle->getChassisType()->getLabel(),
            'fuel' => $vehicle->getFuelType()->getLabel(),
            'mileage' => $vehicle->getMileage(),
            'description' => $vehicle->getDescription(),
            'accessories' => [],
            'images' => [],
        ];
        foreach ($vehicle->getAccessories() as $accessory) {
            $response['accessories'][] = [
                'label' => $accessory->getLabel(),
            ];
        }
        foreach ($vehicle->getImages() as $image) {
            $response['images'][] = ImageResponseDto::fromEntity($image);

        }
        return $response;
    }
}