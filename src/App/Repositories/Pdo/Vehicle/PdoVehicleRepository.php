<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Vehicle;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\VehicleRepository;
use PDO;

class PdoVehicleRepository extends PdoRepository implements VehicleRepository
{

    public function create(array $data): array
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
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function update(int $id, array $data): array
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
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function delete(int $id): array
    {
        $sql = "delete from vehicles where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function all(): array
    {
        $sql = "SELECT
                    v.id,
                    v.vin,
                    v.license_plate,
                    m.label AS make,
                    v.model,
                    v.model_year,
                    v.mileage,
                    v.description,
                    c.label AS color,
                    ct.label AS chassis_type,
                    ft.label AS fuel_type,
                    gt.label AS gearbox_type
                FROM vehicles v
                JOIN makes m ON v.make_id = m.id
                JOIN colors c ON v.color_id = c.id
                JOIN chassis_types ct ON v.chassis_type_id = ct.id
                JOIN fuel_types ft ON v.fuel_type_id = ft.id
                JOIN gearbox_types gt ON v.gearbox_type_id = gt.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array
    {
        $sql = "SELECT
                v.id,
                v.vin,
                v.license_plate,
                m.label AS make,
                v.model,
                v.model_year,
                v.mileage,
                v.description,
                c.label AS color,
                ct.label AS chassis_type,
                ft.label AS fuel_type,
                gt.label AS gearbox_type
            FROM vehicles v
            JOIN makes m ON v.make_id = m.id
            JOIN colors c ON v.color_id = c.id
            JOIN chassis_types ct ON v.chassis_type_id = ct.id
            JOIN fuel_types ft ON v.fuel_type_id = ft.id
            JOIN gearbox_types gt ON v.gearbox_type_id = gt.id
            WHERE v.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}