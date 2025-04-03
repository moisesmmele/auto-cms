<?php

namespace Moises\AutoCms\Core\Entities\Vehicle;

class Vehicle
{
    public int $id;
    public string $vin;
    public string $licensePlate;
    public Make $make;
    public ChassisType $chassisType;
    public FuelType $fuelType;
    public GearboxType $gearboxType;
    public Color $color;
    public string $model;
    public string $modelYear;
    public string $mileage;
    public string $description;
    public array $accessories; // array of Accessory obj
    public array $images; // array of Image obj
}