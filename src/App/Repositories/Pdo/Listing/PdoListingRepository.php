<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Listing;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Repositories\Listing\ListingRepository;
use PDO;

class PdoListingRepository extends PdoRepository implements ListingRepository
{

    public function create(array $data): array
    {
        $sql = "insert into listings (vehicle_id, price) values (:vehicle_id, :price)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':vehicle_id', $data['vehicle_id']);
        $stmt->bindParam(':price', $data['price']);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function update(int $id, array $data): array
    {
        $sql = "update listings set price = :price, vehicle_id = :vehicle_id where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':vehicle_id', $data['vehicle_id']);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function delete(int $id): array
    {
        $sql = "delete from listings where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function all(): array
    {
        $sql = "select * from listings inner join vehicles on vehicles.id = listings.vehicle_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function find(int $id): array
    {
        $sql = "select * from listings where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}