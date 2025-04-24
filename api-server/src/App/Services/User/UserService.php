<?php

namespace Moises\AutoCms\App\Services\User;

use Moises\AutoCms\App\App;
use Moises\AutoCms\Core\Entities\User\User;
use Moises\AutoCms\Core\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;
    public function __construct()
    {
        $this->userRepository = App::container()->get(UserRepository::class);
    }

    public function generateNewToken(User $user)
    {
        $token = bin2hex(random_bytes(16));
        $user->token = $token;
        return $user;
    }

    public function newPassword(User $user, string $password)
    {
        $newPassword = password_hash($password, PASSWORD_DEFAULT);
        $user->setPassword($newPassword);
        return $user;
    }

    public function verifyPassword(User $user, string $password)
    {
        if (password_verify($password, $user->getPassword())) {
            return true;
        }
        return false;
    }
    public function verifyToken(string $token)
    {
        $user = $this->userRepository->findByToken($token);
        if (is_null($user)) {
            return false;
        };
        return $user;
    }

    public function getUserByEmail(string $email)
    {
        return $this->userRepository->findByEmail($email);
    }
    public function save(user $user)
    {
        $data = [
            'id' => $user->getId(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'token' => $user->getToken(),
            'password' => $user->getPassword(),
        ];

        $this->userRepository->update($user->id, $data);
    }

    public function findUserById($id)
    {
        return $this->userRepository->find($id);
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }
}