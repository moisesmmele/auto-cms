<?php

namespace Moises\AutoCms\App\Controllers\User;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Controllers\Controller;
use Moises\AutoCms\App\Services\User\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(){
        parent::__construct();
        $this->userService = App::container()->get(UserService::class);
    }
    public function index()
    {
        $users = $this->userService->getAllUsers();
        $response = [];
        foreach ($users as $user) {
            $response[] = [
                "id" => $user->getId(),
                "first_name" => $user->getFirstName(),
                "last_name" => $user->getLastName(),
                "email" => $user->getEmail(),
            ];
        }
        http_response_code(200);
        echo json_encode($response);
    }
    public function store()
    {
        $data = json_decode($this->request->getContent(), true);
        $user = $this->userService->createNewUser($data);
        $response[] = [
            "id" => $user->getId(),
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "email" => $user->getEmail(),
        ];
        http_response_code(200);
        echo json_encode($response);

    }
    public function show(int $id)
    {
        $user = $this->userService->findUserById($id);
        $response[] = [
            "id" => $user->getId(),
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "email" => $user->getEmail(),
        ];
        http_response_code(200);
        echo json_encode($response);
    }
    public function update(int $id)
    {
        $data = json_decode($this->request->getContent(), true);
        $user = $this->userService->findUserById($id);

        if(array_key_exists('first_name', $data)){
            $user->setFirstName($data['first_name']);
        }

        if(array_key_exists('last_name', $data)){
            $user->setLastName($data['last_name']);
        }

        if(array_key_exists('email', $data)){
            $user->setEmail($data['email']);
        }

        if (array_key_exists('password', $data)) {
            $user = $this->userService->newPassword($user, $data['password']);
        }

        $user = $this->userService->save($user);

        $response[] = [
            "id" => $user->getId(),
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "email" => $user->getEmail(),
        ];

        http_response_code(200);
        echo json_encode($response);
    }
    public function destroy(int $id)
    {
        $response = $this->userService->deleteUser($id);
        echo json_encode($response);
    }
}