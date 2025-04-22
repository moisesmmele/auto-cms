<?php

namespace Moises\AutoCms\App\Middleware;

use Closure;
use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Services\User\UserService;

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        $userService = new UserService();
        $token = App::request()->headers->get('Authorization');
        if (empty($token)) {
            http_response_code(401);
            echo "unauthorized";
        }
        $user = $userService->verifyToken($token);
        if (!$user) {
            http_response_code(401);
            echo "unauthorized";
        }
        return $next();
    }
}