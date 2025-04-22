<?php

namespace Moises\AutoCms\App\Repositories\Pdo;

use Moises\AutoCms\Core\Entities\User\User;
use Moises\AutoCms\Core\Repositories\UserRepository;

class PdoUserRepository extends PdoRepository implements UserRepository
{

    public function all(): array
    {
        $sql = 'SELECT * FROM `users`';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find(int $id): User
    {
        $sql = 'SELECT * FROM `users` WHERE `id` = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new User($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['password'], $user['token']);
    }
    public function create(array $data): User
    {
        $sql = "INSERT INTO `users` (first_name, last_name, email, password, token) 
                    VALUES (:first_name, :last_name, :email, :password, :token)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':token', $data['token']);
        $stmt->execute();
        return $this->find($this->pdo->lastInsertId());
    }

    public function update(int $id, array $data): User
    {
        $sql = "UPDATE `users` set first_name = :first_name, last_name = :last_name, email = :email, password = :password, token = :token";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':token', $data['token']);
        $stmt->execute();
        return $this->find($id);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `users` WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function findByToken(string $token): User
    {
        $token = str_replace('Bearer ', '', $token);;
        $sql = "SELECT * FROM `users` WHERE `token` = :token";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $this->find($user['id']);
    }
}