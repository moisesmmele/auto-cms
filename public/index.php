<?php

use Moises\AutoCms\App\Http\Request;
use Moises\AutoCms\App\Http\Response;
use Moises\AutoCms\App\Router;

const ROOT_DIR = __DIR__ . "/..";
require_once ROOT_DIR . '/vendor/autoload.php';

$router = new Router();

$router->register('/test', [\Moises\AutoCms\App\Controllers\TestController::class, 'index']);

$request = new Request();
$response = new Response();

$router->dispatch($request, $response);