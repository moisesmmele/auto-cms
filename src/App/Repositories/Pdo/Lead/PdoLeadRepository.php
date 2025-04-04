<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Lead;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Repositories\Lead\LeadRepository;
use PDO;

class PdoLeadRepository extends PdoRepository implements LeadRepository
{

    public function create(array $data): array
    {
        $sql = "insert into leads (listing_id, name, email, phone, message) 
                    values (:listing_id, :name, :email, :phone, :message)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':listing_id', $data['listing_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':message', $data['message']);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function update(int $id, array $data): array
    {
        $sql = "update leads set listing_id = :listing_id, name = :name, 
                 email = :email, phone = :phone, message = :message where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':listing_id', $data['listing_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':message', $data['message']);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function delete(int $id): array
    {
        $sql = "delete from leads where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return ["result" => $result];
    }

    public function all(): array
    {
        $sql = "select * from leads inner join listings on listings.id = leads.listing_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array
    {
        $sql = "select * from leads where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}