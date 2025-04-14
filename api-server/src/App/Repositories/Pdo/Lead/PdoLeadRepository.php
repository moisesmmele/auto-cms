<?php

namespace Moises\AutoCms\App\Repositories\Pdo\Lead;

use Moises\AutoCms\App\Repositories\Pdo\PdoRepository;
use Moises\AutoCms\Core\Entities\Lead\Lead;
use Moises\AutoCms\Core\Repositories\Lead\LeadRepository;
use PDO;

class PdoLeadRepository extends PdoRepository implements LeadRepository
{

    public function create(array $data): Lead
    {
        $sql = "insert into leads (id, listing_id, name, email, phone, message) 
                    values (:id, :listing_id, :name, :email, :phone, :message)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':listing_id', $data['listing_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':message', $data['message']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function update(int $id, array $data): Lead
    {
        $sql = "update leads set id = :id, listing_id = :listing_id, name = :name, 
                 email = :email, phone = :phone, message = :message where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':listing_id', $data['listing_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':message', $data['message']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function delete(int $id): bool
    {
        $sql = "delete from leads where id = :id";
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
        $sql = "select * from leads inner join listings on listings.id = leads.listing_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $leads = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newLeads = [];
        foreach ($leads as $lead) {
            $newLeads[] = new Lead(
                id: $lead['id'],
                listingId: $lead['listing_id'],
                customerName: $lead['name'],
                email: $lead['email'],
                phone: $lead['phone'],
                message: $lead['message']);
        }
        return $newLeads;
    }

    public function find(int $id): Lead
    {
        $sql = "select * from leads where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $lead = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Lead(
            id: $lead['id'],
            listingId: $lead['listing_id'],
            customerName: $lead['name'],
            email: $lead['email'],
            phone: $lead['phone'],
            message: $lead['message']);
    }
}