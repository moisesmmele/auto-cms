<?php

namespace Moises\AutoCms\App\Controllers;

use Moises\AutoCms\App\App;

class TestController extends Controller
{
    public function index()
    {
        echo 'this is a test controller';
    }

    public function staticRoute()
    {

        echo "this is a static route controller";
    }

    public function dynamicRoute($id)
    {
        echo "this is a dynamic route controller with id $id";
    }

    public function testing()
    {
        var_dump(App::request()->getRequestUri());
    }
}