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
        error_log("authMiddleware@handle, token: $token");
        if (empty($token)) {
            http_response_code(401);
            echo "unauthorized";
        }
        $user = $userService->verifyToken($token);
        error_log("authMiddleware@handle, user->token: $user->token");

        if (!$user) {
            http_response_code(401);
            echo "unauthorized";
        }
        return $next();
    }
}