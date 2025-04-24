<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Listing;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Listing\Listing;
use Moises\AutoCms\Core\Repositories\Listing\ListingRepository;
use PDO;

class PdoListingRepository extends PdoRepository implements ListingRepository
{

    public function create(array $data): Listing
    {
        $sql = "insert into listings (vehicle_id, price) values (:vehicle_id, :price)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':vehicle_id', $data['vehicle_id']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function update(int $id, array $data): Listing
    {
        $sql = "update listings set price = :price, vehicle_id = :vehicle_id where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':vehicle_id', $data['vehicle_id']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->find($id);
    }

    public function delete(int $id): bool
    {
        $sql = "delete from listings where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            return true;
        };
        return false;
    }

    public function all(): array
    {
        $sql = "select * from listings";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newListings = [];
        foreach ($listings as $listing) {
            $newListings[] = $this->find($listing['id']);
        }
        return $newListings;
    }

    public function find(int $id): Listing
    {
        $sql = "select * from listings where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $listing = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Listing(id: $listing['id'], vehicleId: $listing['vehicle_id'], price: $listing['price']);
    }
}