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
}