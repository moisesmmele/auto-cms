<?php

namespace Moises\AutoCms\App\Controllers;

use Moises\AutoCms\App\App;

class Controller
{
    protected $request;
    protected $response;

    public function __construct()
    {
        $this->request = App::request();
        $this->response = App::response();
    }

    public function response()
    {
        return $this->response;
    }

    public function request()
    {
        return $this->request;
    }
}