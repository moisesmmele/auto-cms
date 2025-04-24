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

    }
    public function show(int $id)
    {

    }
    public function update(int $id, array $data)
    {
        $data = json_decode($this->request->getContent(), true);
    }
    public function destroy(int $id)
    {

    }
}