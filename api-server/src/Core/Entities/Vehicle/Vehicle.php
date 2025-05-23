<?php

namespace Moises\AutoCms\Core\Entities\Vehicle;

use Moises\AutoCms\Core\Entities\Image\Image;

class Vehicle
{
    readonly int $id;
    private string $vin;
    private string $licensePlate;
    readonly int $makeId;
    private Make $make;
    readonly int $chassisTypeId;
    private ChassisType $chassisType;
    readonly int $fuelTypeId;
    private FuelType $fuelType;
    readonly int $gearboxTypeId;
    private GearboxType $gearboxType;
    readonly int $colorId;
    private Color $color;
    private string $model;
    private string $modelYear;
    private string $mileage;
    private string $description;
    readonly array $accessoriesIds;
    private array $accessories = []; // array of Accessory obj
    readonly array $imagesIds;
    private array $images = []; // array of VehicleImage obj
    public function __construct(
        string $id,
        string $vin,
        string $licensePlate,
        int $makeId,
        int $chassisTypeId,
        int $fuelTypeId,
        int $gearboxTypeId,
        int $colorId,
        string $model,
        string $modelYear,
        int $mileage,
        string $description,
        array $accessoriesIds,
        array $imagesIds
    )
    {
        $this->id = $id;
        $this->vin = $vin;
        $this->licensePlate = $licensePlate;
        $this->makeId = $makeId;
        $this->chassisTypeId = $chassisTypeId;
        $this->fuelTypeId = $fuelTypeId;
        $this->gearboxTypeId = $gearboxTypeId;
        $this->colorId = $colorId;
        $this->model = $model;
        $this->modelYear = $modelYear;
        $this->mileage = $mileage;
        $this->description = $description;
        $this->accessoriesIds = $accessoriesIds;
        $this->imagesIds = $imagesIds;
    }
    public function assignMake(Make $make): self
    {
        $this->make = $make;
        return $this;
    }
    public function assignChassisType(ChassisType $chassisType): self
    {
        $this->chassisType = $chassisType;
        return $this;
    }
    public function assignFuelType(FuelType $fuelType): self
    {
        $this->fuelType = $fuelType;
        return $this;
    }
    public function assignGearboxType(GearboxType $gearboxType): self
    {
        $this->gearboxType = $gearboxType;
        return $this;
    }
    public function assignColor(Color $color): self
    {
        $this->color = $color;
        return $this;
    }
    public function assignAccessory(Accessory $accessory): self
    {
        $this->accessories[] = $accessory;
        return $this;
    }
    public function assignVehicleImage(Image $image): self
    {
        $this->images[] = $image;
        return $this;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getVin(): string
    {
        return $this->vin;
    }
    public function getMake(): Make
    {
        return $this->make;
    }
    public function getMakeId(): int
    {
        return $this->makeId;
    }
    public function getChassisType(): ChassisType
    {
        return $this->chassisType;
    }
    public function getFuelType(): FuelType
    {
        return $this->fuelType;
    }
    public function getGearboxType(): GearboxType
    {
        return $this->gearboxType;
    }
    public function getColor(): Color
    {
        return $this->color;
    }
    public function getModel(): string
    {
        return $this->model;
    }
    public function getModelYear(): string
    {
        return $this->modelYear;
    }
    public function getMileage(): int
    {
        return $this->mileage;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getAccessoriesIds(): array
    {
        return $this->accessoriesIds;
    }
    public function getAccessories(): array
    {
        return $this->accessories;
    }
    public function getImages(): array
    {
        return $this->images;
    }
    public function getChassisTypeId(): int
    {
        return $this->chassisTypeId;
    }
    public function getColorId(): int
    {
        return $this->colorId;
    }
    public function getFuelTypeId(): int
    {
        return $this->fuelTypeId;
    }
    public function getGearboxTypeId(): int
    {
        return $this->gearboxTypeId;
    }

    public function getLicensePlate(): string
    {
        return $this->licensePlate;
    }

    /**
     * @return array
     */
    public function getImagesIds(): array
    {
        return $this->imagesIds;
    }
}