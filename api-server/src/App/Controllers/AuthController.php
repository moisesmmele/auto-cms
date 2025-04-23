<?php

namespace Moises\AutoCms\App\Controllers;

use Moises\AutoCms\App\Services\User\UserService;

class AuthController extends Controller
{
    public function login()
    {
        $service = new UserService();
        $data = json_decode($this->request->getContent(), true);
        //find user by email
        $user = $service->getUserByEmail($data['email']);
        if (is_null($user)) {
            http_response_code(401);
            echo "unauthorized";
        }
        //verify user password
        if (!$service->verifyPassword($user, $data['password'])){
            http_response_code(401);
            echo "unauthorized";
        };
        //generate new token
        $user = $service->generateNewToken($user);
        $service->save($user);
        //return client with new token, omit password
        $response = [
            'id' => $user->getId(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'token' => $user->getToken(),
        ];
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($response);

    }
    public function logout()
    {
        $service = new UserService();
        $data = json_decode($this->request->getContent(), true);
        $user = $service->findUserById($data['id']);
        $user->setToken('EXPIRED_TOKEN');
        $service->save($user);
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(['ok' => true]);
    }
}