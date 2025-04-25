<?php

use Dotenv\Dotenv;
use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Container\Container;
use Moises\AutoCms\App\Controllers\Images\ImageController;
use Moises\AutoCms\App\Database\Database;
use Moises\AutoCms\App\Middleware\AuthMiddleware;
use Moises\AutoCms\App\Router\Router;
use Moises\AutoCms\App\Storage\Storage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#use Moises\AutoCms\App\Http\Request;
#use Moises\AutoCms\App\Http\Response;
CONST DIR = __DIR__ . "/../";

require_once DIR . '/vendor/autoload.php';
require_once DIR . 'cors.php';

Dotenv::createImmutable(dirname(__DIR__), '.env')->load();

App::setContainer(new Container());
App::container()->loadBindings();

App::setDatabase(new Database());
App::setStorage(Storage::createLocal());

App::setRouter(new Router());
App::router()->loadRoutes();

App::setRequest(Request::createFromGlobals());
App::setResponse(new Response());

error_log(App::request()->getContent());

App::router()->dispatch();