<?php

namespace Moises\AutoCms\Core\Entities\Listing;

use Moises\AutoCms\Core\Entities\Vehicle\Vehicle;

class Listing
{
    readonly int $id;
    readonly int $vehicleId;
    readonly Vehicle $vehicle;
    readonly float $price;
    public function __construct(int $id, int $vehicleId, float $price)
    {
        $this->id = $id;
        $this->vehicleId = $vehicleId;
        $this->price = $price;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }
    public function getVehicleId(): int
    {
        return $this->vehicleId;
    }

    public function assignVehicle(Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;
        return $this;
    }
}