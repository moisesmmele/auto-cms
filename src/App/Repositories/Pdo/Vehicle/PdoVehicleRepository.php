<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Vehicle\Vehicle;
use Moises\AutoCms\Core\Repositories\Vehicle\VehicleRepository;
use PDO;

class PdoVehicleRepository extends PdoRepository implements VehicleRepository
{

    public function create(array $data): Vehicle
    {
        $sql = "insert into vehicles (vin, license_plate, make_id, chassis_type_id, fuel_type_id,
                      gearbox_type_id, color_id, model, model_year, mileage, description) 
                values (:vin, :license_plate, :make_id, :chassis_type_id, :fuel_type_id, :gearbox_type_id, 
                        :color_id, :model, :model_year, :mileage, :description)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':vin', $data['vin']);
        $stmt->bindParam(':license_plate', $data['license_plate']);
        $stmt->bindParam(':make_id', $data['make_id']);
        $stmt->bindParam(':chassis_type_id', $data['chassis_type_id']);
        $stmt->bindParam(':fuel_type_id', $data['fuel_type_id']);
        $stmt->bindParam(':gearbox_type_id', $data['gearbox_type_id']);
        $stmt->bindParam(':color_id', $data['color_id']);
        $stmt->bindParam(':model', $data['model']);
        $stmt->bindParam(':model_year', $data['model_year']);
        $stmt->bindParam(':mileage', $data['mileage']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->execute();
        $vehicleId = $this->pdo->lastInsertId();
        $this->addAccessories($vehicleId, $data['accessories']);
        $this->addImages($vehicleId, $data['images']);

        return $this->find($vehicleId);
    }

    public function update(int $id, array $data): Vehicle
    {
        $sql = "update vehicles set vin = :vin, license_plate = :license_plate, make_id = :make_id, 
                    chassis_type_id = :chassis_type_id, fuel_type_id = :fuel_type_id, 
                    gearbox_type_id = :gearbox_type_id, color_id = :color_id, model = :model, 
                    model_year = :model_year, mileage = :mileage, description = :description 
                where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':vin', $data['vin']);
        $stmt->bindParam(':license_plate', $data['license_plate']);
        $stmt->bindParam(':make_id', $data['make_id']);
        $stmt->bindParam(':chassis_type_id', $data['chassis_type_id']);
        $stmt->bindParam(':fuel_type_id', $data['fuel_type_id']);
        $stmt->bindParam(':gearbox_type_id', $data['gearbox_type_id']);
        $stmt->bindParam(':color_id', $data['color_id']);
        $stmt->bindParam(':model', $data['model']);
        $stmt->bindParam(':model_year', $data['model_year']);
        $stmt->bindParam(':mileage', $data['mileage']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':id', $data['id']);
        $stmt->execute();
        return $this->find($id);
    }

    public function delete(int $id): bool
    {
        $sql = "delete from vehicles where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function all(): array
    {
        $sql = "SELECT * FROM vehicles";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newVehicles = [];
        foreach ($vehicles as $vehicle) {
            $images = $this->findImages($vehicle['id']);
            $accessories = $this->findAccessories($vehicle['id']);
            $newVehicles[] = new Vehicle(
                id: $vehicle['id'],
                vin: $vehicle['vin'],
                licensePlate: $vehicle['license_plate'],
                makeId: $vehicle['make_id'],
                chassisTypeId: $vehicle['chassis_type_id'],
                fuelTypeId: $vehicle['fuel_type_id'],
                gearboxTypeId: $vehicle['gearbox_type_id'],
                colorId: $vehicle['color_id'],
                model: $vehicle['model'],
                modelYear: $vehicle['model_year'],
                mileage: $vehicle['mileage'],
                description: $vehicle['description'],
                accessoriesIds: $accessories,
                imagesIds: $images
            );
        }
        return $newVehicles;
    }

    public function find(int $id): Vehicle
    {
        $sql = "SELECT * FROM vehicles where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
        $images = $this->findImages($id);
        $accessories = $this->findAccessories($id);
        return new Vehicle(
            id: $vehicle['id'],
            vin: $vehicle['vin'],
            licensePlate: $vehicle['license_plate'],
            makeId: $vehicle['make_id'],
            chassisTypeId: $vehicle['chassis_type_id'],
            fuelTypeId: $vehicle['fuel_type_id'],
            gearboxTypeId: $vehicle['gearbox_type_id'],
            colorId: $vehicle['color_id'],
            model: $vehicle['model'],
            modelYear: $vehicle['model_year'],
            mileage: $vehicle['mileage'],
            description: $vehicle['description'],
            accessoriesIds: $accessories,
            imagesIds: $images
        );
    }
    public function findImages($vehicleId): array
    {
        $sql = "SELECT * from images_vehicles where vehicle_id = :vehicleId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':vehicleId', $vehicleId);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newImages = [];
        foreach ($images as $image) {
            $newImages[] = $image['id'];
        }
        return $newImages;
    }

    public function findAccessories($vehicleId): array
    {
        $sql = "SELECT * from accessories_vehicles where vehicle_id = :vehicleId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':vehicleId', $vehicleId);
        $stmt->execute();
        $accessories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newAccessories = [];
        foreach ($accessories as $accessory) {
            $newAccessories[] = $accessory['id'];
        }
        return $newAccessories;
    }

    public function addAccessories($vehicleId, array $accessories)
    {
        foreach ($accessories as $accessoryId) {
            $sql = "INSERT INTO accessories_vehicles (vehicle_id, accessory_id) VALUES (:vehicle_id, :accessory_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':vehicle_id', $vehicleId);
            $stmt->bindParam(':accessory_id', $accessoryId);
            $stmt->execute();
        }
    }

    public function addImages(string $vehicleId, mixed $images)
    {
        foreach ($images as $imageId) {
            $sql = "INSERT INTO images_vehicles (vehicle_id, image_id) VALUES (:vehicle_id, :image_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':vehicle_id', $vehicleId);
            $stmt->bindParam(':image_id', $imageId);
            $stmt->execute();
        }
    }
}